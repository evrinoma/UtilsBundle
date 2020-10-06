<?php

namespace Evrinoma\UtilsBundle\Voter;


use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class AbstractVoter
 *
 * @package Evrinoma\UtilsBundle\Voter
 */
abstract class AbstractVoter implements VoterInterface
{
//region SECTION: Fields
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $security;
//endregion Fields

//region SECTION: Constructor
    /**
     * VoterManager constructor.
     *
     * @param AuthorizationCheckerInterface $security
     */
    public function __construct(AuthorizationCheckerInterface $security)
    {
        $this->security = $security;
    }

//region SECTION: Public

    /**
     * @param array $roles
     *
     * @return bool
     */
    public function checkPermission(array $roles): bool
    {
        return ($this->isGranted($roles) || ($this->isSuperAdmin() && $this->isDevAdmin($roles)));
    }
//endregion Public

//region SECTION: Private
    private function isGranted($roles): bool
    {
        foreach ($roles as $role) {
            if ($this->security->isGranted($role)) {
                return true;
            }
        }

        return false;
    }

    private function isSuperAdmin(): bool
    {
        return $this->security->isGranted(RoleInterface::ROLE_SUPER_ADMIN) ? true : false;
    }

    private function isDevAdmin(array $roles): bool
    {
        return !in_array(RoleInterface::ROLE_DEV_USER, $roles);
    }
//endregion Private
}