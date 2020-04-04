<?php

namespace Evrinoma\UtilsBundle\Voiter;


use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class AbstractVoiter
 *
 * @package Evrinoma\UtilsBundle\Voiter
 */
abstract class AbstractVoiter
{
//region SECTION: Fields
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $security;
//endregion Fields

//region SECTION: Constructor
    /**
     * VoiterManager constructor.
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