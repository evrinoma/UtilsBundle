<?php

namespace Evrinoma\UtilsBundle\Manager;


interface EntityInterface extends BaseInterface
{
    public function removeEntitys();
    public function lockEntitys();
    public function toModel();
    public function getRepositoryClass();
    public function getCount($criteria = null);
    public function setClassModel($class);
}