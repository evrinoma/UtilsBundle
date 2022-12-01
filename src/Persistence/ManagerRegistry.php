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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Evrinoma\UtilsBundle\Exception\HydrateException;
use Evrinoma\UtilsBundle\Manager\EntityManagerInterface;
use Evrinoma\UtilsBundle\Mapping\MetadataManagerInterface;
use InvalidArgumentException;

class ManagerRegistry implements ManagerRegistryInterface
{
    protected array                    $cache = [];
    protected array                    $proxy = [];
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
        $metaDataManager = $this->getMetaDataManager();
        foreach ($rows as $row) {
            $entity = new $entityClass();
            $identity = $metaDataManager->getIdentity($entityClass);
            $valueId = null;
            if (\array_key_exists($identity, $row)) {
                $valueId = $row[$identity];
            }
            if (\array_key_exists($entityClass, $this->cache) && \array_key_exists($valueId, $this->cache[$entityClass])) {
                return [$this->getCache($entityClass, $valueId)];
            }
            foreach ($metaDataManager->getMetadata($entityClass) as $name => $metaData) {
                $annotation = $metaDataManager->findMetadata($entityClass, $name, JoinColumn::class);
                if (null !== $annotation && \array_key_exists($annotation->name, $row) && null !== $row[$annotation->name]) {
                    $row[$name] = &$row[$annotation->name];
                }
                if (\array_key_exists($name, $row)) {
                    if ($metaData instanceof Column) {
                        $methodName = 'set'.ucfirst($name);
                        switch ($metaData->type) {
                            case 'text' :
                            case 'string' :
                                $value = (string) $row[$name];
                                break;
                            case 'integer':
                            case 'int':
                                $value = (int) $row[$name];
                                break;
                            case 'float':
                                $value = (float) $row[$name];
                                break;
                            case 'datetime_immutable':
                                $value = new \DateTimeImmutable($row[$name]);
                                break;
                            default:
                                $value = $row[$name];
                        }
                        $entity->{$methodName}($value);
                    }
                    if ($metaData instanceof OneToMany) {
                        $mappedEntityClass = $metaDataManager->getClassName($metaData->targetEntity);
                        if (\is_array($row[$name])) {
                            $methodName = 'set'.ucfirst($name);
                            $values = $this->hydrateRowData($row[$name], $mappedEntityClass);
                            $entity->{$methodName}($values);
                        } else {
                            throw new HydrateException();
                        }
                    }
                    if ($metaData instanceof ManyToOne) {
                        $mappedEntityClass = $metaDataManager->getClassName($metaData->targetEntity);
                        if (\is_array($row[$name])) {
                            $methodName = 'set'.ucfirst($name);
                            $values = $this->hydrateRowData([$row[$name]], $mappedEntityClass);
                            if (0 === \count($values) || \count($values) > 1) {
                                throw new HydrateException();
                            }
                            $entity->{$methodName}($values[0]);
                        } else {
                            throw new HydrateException();
                        }
                    }
                    if ($metaData instanceof ManyToMany) {
                        $mappedEntityClass = $metaDataManager->getClassName($metaData->targetEntity);
                        if (\is_array($row[$name])) {
                            $methodName = 'set'.ucfirst($name);
                            $values = $this->hydrateRowData($row[$name], $mappedEntityClass);
                            $entity->{$methodName}(new ArrayCollection($values));
                        } else {
                            throw new HydrateException();
                        }
                    }
                }
            }
            $this->setCache($entityClass, $valueId, $entity);

            $entities[] = $this->getCache($entityClass, $valueId);
        }

        return $entities;
    }

    private function &getCache(string $entityClass, $id)
    {
        return $this->cache[$entityClass][$id];
    }

    private function setCache(string $entityClass, $id, $value): void
    {
        if (null !== $id) {
            $this->cache[$entityClass][$id] = $value;
            $this->setProxy($entityClass, $id, $value);
        }
    }

    public function &getReference(string $entityClass, $id)
    {
        if (!\array_key_exists($id, $this->cache)) {
            $entity = new $entityClass();
            if (method_exists($entity, 'setId')) {
                $reflectionMethod = new \ReflectionMethod($entityClass, 'setId');
                $params = $reflectionMethod->getParameters();
                if (1 === \count($params)) {
                    $type = $params[0]->getType();
                    settype($id, $type->getName());
                } else {
                    throw new ORMException();
                }
                $entity->setId($id);
                $this->setProxy($entityClass, $id, $entity);
            } else {
                throw new ORMException();
            }
        }

        return $this->getProxy($entityClass, $id);
    }

    private function &getProxy(string $entityClass, $id)
    {
        return $this->proxy[$entityClass][$id];
    }

    private function setProxy(string $entityClass, $id, $value): void
    {
        if (null !== $id) {
            $this->proxy[$entityClass][$id] = $value;
        }
    }

    public function transactional(callable $func)
    {
        return $func($this);
    }

    public function flush(): void
    {
    }
}
