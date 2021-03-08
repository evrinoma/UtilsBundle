<?php

namespace Evrinoma\UtilsBundle\Manager;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Evrinoma\DtoBundle\Adaptor\EntityAdaptorInterface;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;

/**
 * Class AbstractEntityManager
 *
 * @package Evrinoma\UtilsBundle\Manager
 */
abstract class AbstractEntityManager implements EntityInterface
{

//region SECTION: Fields
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
//endregion Fields

//region SECTION: Constructor
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
//endregion Constructor

//region SECTION: Protected
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
     * @param             $entity
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
//endregion Protected

//region SECTION: Public
    /**
     * @return self
     */
    public function removeEntitys()
    {
        foreach ($this->getData() as $entity) {
            $this->entityManager->remove($entity);
        }
        $this->entityManager->flush();

        return $this;
    }

    /**
     * @return self
     */
    public function lockEntitys()
    {
        /** @var ActiveTrait $entity */
        foreach ($this->getData() as $entity) {
            $entity->setActiveToDelete();
        }
        $this->entityManager->flush();

        return $this;
    }

    public function toModel()
    {
        return ['class' => $this->getClassModel(), 'model' => $this->getData()];
    }

    /**
     * @return mixed
     */
    public function hasSingleData()
    {
        return count($this->data) === 1;
    }
//endregion Public

//region SECTION: Private
    private function getClassModel()
    {
        return $this->classModel;
    }
//endregion Private

//region SECTION: Find Filters Repository
    public function getRepositoryClass()
    {
        return $this->repositoryClass;
    }
//endregion Find Filters Repository

//region SECTION: Getters/Setters
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

    public function setClassModel($class)
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
//endregion Getters/Setters

}