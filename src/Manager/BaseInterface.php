<?php


namespace Evrinoma\UtilsBundle\Manager;

/**
 * @deprecated
 */
interface BaseInterface
{
    public function hasSingleData();
    public function getData();
    public function setData($data);
}