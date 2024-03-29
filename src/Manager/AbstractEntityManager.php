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

namespace Evrinoma\UtilsBundle\Manager;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Evrinoma\DtoBundle\Adaptor\EntityAdaptorInterface;
use Evrinoma\UtilsBundle\Entity\ActiveInterface;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;

/**
 * @deprecated
 */
abstract class AbstractEntityManager implements EntityInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $repositoryClass;

    /**
     * @var mixed
     */
    protected $data = [];

    /**
     * @var string
     */
    private $classModel;

    /**
     * AbstractEntity constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        if ($this->repositoryClass) {
            $this->repository = $this->entityManager->getRepository($this->repositoryClass);
        }
    }

    /**
     * @return Criteria
     */
    protected function getCriteria()
    {
        return ActiveTrait::getCriteria();
    }

    /**
     * @param $className
     *
     * @return self
     */
    protected function getRepositoryAll($className)
    {
        /** @var EntityRepository $repository */
        $repository = $this->entityManager->getRepository($className);
        $this->setData($repository->findAll());

        return $this;
    }

    /**
     * @param string $entity
     *
     * @return object|null
     */
    protected function find(string $entity)
    {
        if (!$entity) {
            return null;
        }

        return $this->repository->find($entity);
    }

    /**
     * @param EntityAdaptorInterface $dto
     * @param                        $entity
     *
     * @return mixed
     */
    protected function save(EntityAdaptorInterface $dto, $entity)
    {
        $dto->fillEntity($entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @return EntityInterface
     */
    public function removeEntitys(): EntityInterface
    {
        foreach ($this->getData() as $entity) {
            $this->entityManager->remove($entity);
        }

        return $this;
    }

    /**
     * @return EntityInterface
     */
    public function lockEntities(): EntityInterface
    {
        /** @var ActiveInterface $entity */
        foreach ($this->getData() as $entity) {
            $entity->setActiveToDelete();
        }

        return $this;
    }

    public function toModel(): array
    {
        return ['class' => $this->getClassModel(), 'model' => $this->getData()];
    }

    /**
     * @return mixed
     */
    public function hasSingleData()
    {
        return 1 === \count($this->data);
    }

    private function getClassModel()
    {
        return $this->classModel;
    }

    public function getRepositoryClass(): string
    {
        return $this->repositoryClass;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getCount($criteria = null)
    {
        return $this->repository->matching((!$criteria) ? $this->getCriteria() : $criteria)->count();
    }

    public function setClassModel($class): EntityInterface
    {
        $this->classModel = $class;

        return $this;
    }

    /**
     * @param mixed $data
     *
     * @return AbstractEntityManager
     */
    public function setData($data)
    {
        $this->data = $data ?? [];

        return $this;
    }
}
