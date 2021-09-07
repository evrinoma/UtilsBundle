<?php


namespace Evrinoma\UtilsBundle\Security\AccessControlSystem;

use Symfony\Component\Security\Core\User\UserInterface;

interface AccessControlInterface
{
//region SECTION: Getters/Setters
    public function getAuthorizedUser(): UserInterface;
//endregion Getters/Setters
}