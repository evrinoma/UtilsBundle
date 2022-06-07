<?php

namespace Evrinoma\UtilsBundle\Manager;

/**
 * @deprecated
 */
abstract class AbstractBaseManager implements BaseInterface
{


    /**
     * @var mixed
     */
    protected $data = [];




    /**
     * @return mixed
     */
    public function hasSingleData()
    {
        return count($this->data) === 1;
    }



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


}