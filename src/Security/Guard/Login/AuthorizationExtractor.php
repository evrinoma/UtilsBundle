<?php


namespace Evrinoma\UtilsBundle\Security\Guard\Login;

use Evrinoma\UtilsBundle\Security\Guard\ExtractorInterface;
use Symfony\Component\HttpFoundation\Request;

final class AuthorizationExtractor implements ExtractorInterface
{
//region SECTION: Fields
    private $username;
    private $password;
    private $csrfToken;
    /**
     * @var ?string
     */
    private $csrfTokenKey;
    /**
     * @var ?string
     */
    private $passwordKey;
    /**
     * @var ?string
     */
    private $usernameKey;
//endregion Fields

//region SECTION: Constructor
    /**
     * AuthorizationExtractor constructor.
     *
     * @param $usernameKey
     * @param $passwordKey
     * @param $csrfTokenKey
     */
    public function __construct($usernameKey, $passwordKey, $csrfTokenKey)
    {
        $this->usernameKey  = $usernameKey;
        $this->passwordKey  = $passwordKey;
        $this->csrfTokenKey = $csrfTokenKey;
    }
//endregion Constructor

//region SECTION: Public
    public function extract(Request $request): void
    {
        if ($request->request->has($this->usernameKey)) {
            $this->setUserName(trim($request->request->get($this->usernameKey)));
        }
        if ($request->request->has($this->passwordKey)) {
            $this->setPassword($request->request->get($this->passwordKey));
        }
        if ($request->request->has($this->csrfTokenKey)) {
            $this->setCsrfToken($request->request->get($this->csrfTokenKey));
        }
    }

    /**
     * @return bool
     */
    public function hasCsrfToken(): bool
    {
        return null !== $this->csrfToken;
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getCsrfToken(): ?string
    {
        return $this->csrfToken;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUserName(string $username): AuthorizationExtractor
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): AuthorizationExtractor
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $csrfToken
     *
     * @return $this
     */
    public function setCsrfToken(string $csrfToken): AuthorizationExtractor
    {
        $this->csrfToken = $csrfToken;

        return $this;
    }
//endregion Getters/Setters
}