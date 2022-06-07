<?php

namespace Evrinoma\UtilsBundle\Controller;

use Evrinoma\UtilsBundle\Rest\RestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

interface ApiControllerInterface
{


    public function postAction(): JsonResponse;

    public function putAction(): JsonResponse;

    public function deleteAction(): JsonResponse;

    public function criteriaAction(): JsonResponse;






    public function getAction(): JsonResponse;

    public function setRestStatus(RestInterface $manager, \Exception $e): array;

}