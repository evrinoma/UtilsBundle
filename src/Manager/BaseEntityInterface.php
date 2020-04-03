<?php

namespace Evrinoma\UtilsBundle\Manager;


interface BaseEntityInterface
{
    public function removeEntitys();
    public function lockEntitys();
    public function toModel();
    public function hasSingleData();
    public function getRepositoryClass();
    public function getData();
    public function getCount($criteria = null);
    public function setClassModel($class);
    public function setData($data);
}