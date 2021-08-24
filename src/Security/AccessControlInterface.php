<?php


namespace Evrinoma\UtilsBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;

interface AccessControlInterface
{
//region SECTION: Getters/Setters
    public function getAuthorizedUser(): UserInterface;

    public function isAuthorize(): bool;
//endregion Getters/Setters
}