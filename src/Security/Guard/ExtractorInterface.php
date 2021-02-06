<?php


namespace Evrinoma\UtilsBundle\Security\Guard;


use Symfony\Component\HttpFoundation\Request;

interface ExtractorInterface
{
//region SECTION: Public
    /**
     * @param Request $request
     *
     * @return string|false
     */
    public function extract(Request $request):void;
//endregion Public
}