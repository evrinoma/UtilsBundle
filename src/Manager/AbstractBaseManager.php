<?php

namespace Evrinoma\UtilsBundle\Manager;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;

/**
 * Class AbstractBaseManager
 *
 * @package Evrinoma\UtilsBundle\Manager
 */
abstract class AbstractBaseManager implements BaseInterface
{

//region SECTION: Fields
    /**
     * @var mixed
     */
    protected $data = [];

//endregion Fields

//region SECTION: Public
    /**
     * @return mixed
     */
    public function hasSingleData()
    {
        return count($this->data) === 1;
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
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