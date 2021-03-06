<?php


namespace Evrinoma\UtilsBundle\Security\AccessControlSystem;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessControl implements AccessControlInterface
{
    /**
     * @var Security
     */
    private $security;

//region SECTION: Constructor
    /**
     * AccessControl constructor.
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
//endregion Constructor

//region SECTION: Getters/Setters
    public function getAuthorizedUser(): UserInterface
    {
        return $this->security->getUser();
    }
//endregion Getters/Setters
}