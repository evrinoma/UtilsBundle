<?php


namespace Evrinoma\UtilsBundle\Manager;


interface BaseInterface
{
    public function hasSingleData();
    public function getData();
    public function setData($data);
}