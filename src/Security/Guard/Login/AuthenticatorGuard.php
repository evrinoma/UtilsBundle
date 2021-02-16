<?php

namespace Evrinoma\UtilsBundle\Security\Guard\Login;

use Evrinoma\UtilsBundle\Security\Model\SecurityModelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticatorGuard extends AbstractGuardAuthenticator
{

//region SECTION: Fields
    /**
     * @var HttpUtils
     */
    private $httpUtils;

    /**
     * @var TokenStorageInterface|null
     */
    private $tokenStorage;

    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;
//endregion Fields

//region SECTION: Constructor


    /**
     * @param HttpUtils                 $httpUtils
     * @param TokenStorageInterface     $tokenStorage
     * @param CsrfTokenManagerInterface $csrfTokenManager
     * @param EncoderFactoryInterface   $encoderFactory
     */
    public function __construct(HttpUtils $httpUtils, TokenStorageInterface $tokenStorage, CsrfTokenManagerInterface $csrfTokenManager, EncoderFactoryInterface $encoderFactory)
    {
        $this->httpUtils        = $httpUtils;
        $this->tokenStorage     = $tokenStorage;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->encoderFactory   = $encoderFactory;
    }
//endregion Constructor


//region SECTION: Public
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request)
    {
        return ($request->request->has(SecurityModelInterface::USERNAME) && $request->request->has(SecurityModelInterface::PASSWORD));
    }

    /**
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return null;
    }

    /**
     * @param Request        $request
     * @param TokenInterface $token
     * @param string         $providerKey The provider (i.e. firewall) key
     *
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return ($this->httpUtils->checkRequestPath($request, '/'.SecurityModelInterface::LOGIN)) ? $this->httpUtils->createRedirectResponse($request, SecurityModelInterface::HOMEPAGE) : null;
    }

    /**
     * @param Request                      $request       The request that resulted in an AuthenticationException
     * @param AuthenticationException|null $authException The exception that started the authentication process
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return $this->httpUtils->createRedirectResponse($request, SecurityModelInterface::LOGIN);
    }

    /**
     * @param mixed         $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return ($user && $this->checkUser($user, $credentials->getPassword()));
    }

    /**
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }
//endregion Public

//region SECTION: Private
    private function checkUser($user, $password)
    {
        $encoder     = $this->encoderFactory->getEncoder($user);
        $encodedPass = $encoder->encodePassword($password, $user->getSalt());

        return $encodedPass === $user->getPassword();
    }
//endregion Private

//region SECTION: Getters/Setters
    /**
     * @param Request $request
     *
     * @return mixed|null
     */
    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationExtractor(SecurityModelInterface::USERNAME, SecurityModelInterface::PASSWORD, SecurityModelInterface::CSRF_TOKEN);

        $extractor->extract($request);

        if ($extractor->hasCsrfToken() && (false === $this->csrfTokenManager->isTokenValid(new CsrfToken(SecurityModelInterface::AUTHENTICATE, $extractor->getCsrfToken())))) {
            throw new InvalidCsrfTokenException('Invalid CSRF token.');
        }

        if ($this->tokenStorage->getToken()) {
            $extractor->setUserName($this->tokenStorage->getToken()->getUser()->getUserName());
        }

        return $extractor;
    }

    /**
     * @param mixed                 $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface|null
     * @throws AuthenticationException
     *
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials->getUserName());
    }
//endregion Getters/Setters
}