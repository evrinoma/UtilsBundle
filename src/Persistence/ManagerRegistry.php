<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle\Persistence;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Evrinoma\UtilsBundle\Exception\HydrateException;
use Evrinoma\UtilsBundle\Manager\EntityManagerInterface;
use Evrinoma\UtilsBundle\Mapping\MetadataManagerInterface;
use InvalidArgumentException;

class ManagerRegistry implements ManagerRegistryInterface
{
    protected array                    $cache = [];
    protected array                    $managers;
    protected MetadataManagerInterface $metadataManager;

    /**
     * @param MetadataManagerInterface $metadataManager
     */
    public function __construct(MetadataManagerInterface $metadataManager)
    {
        $this->metadataManager = $metadataManager;
    }

    protected function getMetaDataManager(): MetadataManagerInterface
    {
        return $this->metadataManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function registerEntityManager(EntityManagerInterface $entityManager): void
    {
        $entityClass = \get_class($entityManager);
        $this->managers[$entityClass] = $entityManager;
        $this->managers[$entityManager->getManagerName()] = &$this->managers[$entityClass];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getManager(string $entityClass): EntityManagerInterface
    {
        if (!isset($this->managers[$entityClass])) {
            throw new InvalidArgumentException(sprintf('Manager named "%s" does not exist.', $entityClass));
        }

        return $this->managers[$entityClass];
    }

    public function hydrateRowData(array $rows, string $entityClass): array
    {
        $entities = [];
        foreach ($rows as $row) {
            $entity = new $entityClass();
            $identity = $this->getMetaDataManager()->getIdentity($entityClass);
            $valueId = null;
            if (\array_key_exists($identity, $row)) {
                $valueId = $row[$identity];
            }
            if (\array_key_exists($entityClass, $this->cache) && \array_key_exists($valueId, $this->cache[$entityClass])) {
                return $this->cache[$entityClass][$valueId];
            }
            foreach ($this->getMetaDataManager()->getMetadata($entityClass) as $name => $metaData) {
                if (\array_key_exists($name, $row)) {
                    if ($metaData instanceof Column) {
                        $methodName = 'set'.ucfirst($name);
                        switch ($metaData->type) {
                            case 'string' :
                                $value = (string) $row[$name];
                                break;
                            case 'int':
                                $value = (int) $row[$name];
                                break;
                            case 'float':
                                $value = (float) $row[$name];
                                break;
                            default:
                                $value = $row[$name];
                        }
                        $entity->{$methodName}($value);
                    }
                    if ($metaData instanceof OneToMany) {
                        $mappedEntityClass = $this->getMetaDataManager()->getClassName($metaData->targetEntity);
                        if (\is_array($row[$name])) {
                            $methodName = 'set'.ucfirst($name);
                            $values = $this->hydrateRowData($row[$name], $mappedEntityClass);
                            $entity->{$methodName}($values);
                        } else {
                            throw new HydrateException();
                        }
                    }
                }
            }
            if (null !== $valueId) {
                $this->cache[$entityClass][$valueId] = $entity;
            }

            $entities[] = $entity;
        }

        return $entities;
    }
}
