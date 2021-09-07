<?php


namespace Evrinoma\UtilsBundle\Voter;


interface VoterInterface
{
//region SECTION: Public
    public function checkPermission(array $roles): bool;
//endregion Public
}