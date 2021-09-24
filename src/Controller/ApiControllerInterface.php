<?php

namespace Evrinoma\UtilsBundle\Controller;

use Evrinoma\UtilsBundle\Rest\RestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

interface ApiControllerInterface
{
//region SECTION: Public

    public function postAction(): JsonResponse;

    public function putAction(): JsonResponse;

    public function deleteAction(): JsonResponse;

    public function criteriaAction(): JsonResponse;
//endregion Public

//region SECTION: Private
//endregion Private

//region SECTION: Getters/Setters
    public function getAction(): JsonResponse;

    public function setRestStatus(RestInterface $manager, \Exception $e): array;
//endregion Getters/Setters
}