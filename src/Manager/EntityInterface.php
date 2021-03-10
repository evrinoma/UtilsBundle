<?php

namespace Evrinoma\UtilsBundle\Manager;


interface EntityInterface extends BaseInterface
{
    public function removeEntitys():EntityInterface;
    public function lockEntities():EntityInterface;
    public function toModel():array;
    public function getRepositoryClass():string;
    public function getCount($criteria = null);
    public function setClassModel($class):EntityInterface;
}