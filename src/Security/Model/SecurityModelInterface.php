<?php


namespace Evrinoma\UtilsBundle\Security\Model;


interface SecurityModelInterface
{
//region SECTION: Fields
    public const AUTHENTICATE = 'authenticate';

    public const CSRF_TOKEN = '_csrf_token';
    public const USERNAME   = '_username';
    public const PASSWORD   = '_password';

    public const BEARER = 'BEARER';

    public const HOMEPAGE    = 'core_home';
    public const LOGIN_CHECK = 'login_check';
    public const LOGIN       = 'login';

    public const FIREWALL_SESSION_KEY = 'main';
//endregion Fields
}