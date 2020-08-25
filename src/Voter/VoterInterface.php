<?php


namespace Evrinoma\UtilsBundle\Voter;


interface VoterInterface
{
    public function checkPermission(array $roles): bool;
}