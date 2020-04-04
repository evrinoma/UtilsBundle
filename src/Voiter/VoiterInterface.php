<?php


namespace Evrinoma\UtilsBundle\Voiter;


interface VoiterInterface
{
    public function checkPermission(array $roles): bool;
}