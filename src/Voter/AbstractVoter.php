<?php

namespace Evrinoma\UtilsBundle\Voter;


use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class AbstractVoter
 *
 * @package Evrinoma\UtilsBundle\Voter
 */
abstract class AbstractVoter
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
        return ($this->security->isGranted($roles) || $this->isSuperAdmin());
    }
//endregion Public

//region SECTION: Private
    private function isSuperAdmin(): bool
    {
        return $this->security->isGranted([RoleInterface::ROLE_SUPER_ADMIN]) ? true : false;
    }
//endregion Private
}