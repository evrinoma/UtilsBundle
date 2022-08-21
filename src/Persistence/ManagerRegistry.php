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

use Evrinoma\UtilsBundle\Manager\EntityManagerInterface;
use Evrinoma\UtilsBundle\Mapping\MetadataManagerInterface;
use InvalidArgumentException;

class ManagerRegistry implements ManagerRegistryInterface
{
    protected array $managers;
    protected MetadataManagerInterface $metadataManager;

    /**
     * @param MetadataManagerInterface $metadataManager
     */
    public function __construct(MetadataManagerInterface $metadataManager)
    {
        $this->metadataManager = $metadataManager;
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

    protected function getMetaDataManager(): MetadataManagerInterface
    {
        return $this->metadataManager;
    }

    public function hydrateRowData(array $rows, string $entityClass): array
    {
        $entities = [];
        foreach ($rows as $row) {
            $entity = new $entityClass();
            foreach ($this->getMetaDataManager()->getMetadata($entityClass) as $name => $metaData) {
                if (\array_key_exists($name, $row)) {
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
            }
            $entities[] = $entity;
        }

        return $entities;
    }
}
