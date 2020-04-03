<?php

namespace Evrinoma\UtilsBundle\Controller;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractApiController
 *
 * @package Evrinoma\UtilsBundle\Controller
 */
abstract class AbstractApiController extends AbstractController
{
//region SECTION: Fields
    /**
     * @var Serializer
     */
    private $serializer;
    /**
     * @var SerializationContext
     */
    private $serializationContext;
//endregion Fields

//region SECTION: Constructor
    /**
     * AbstractApiController constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
//endregion Constructor

//region SECTION: Protected
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        if ($this->serializer) {

            $json = $this->serializer->serialize($data, 'json', $this->serializationContext);

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }

    /**
     * @param $name
     *
     * @return $this
     */
    protected function setSerializeGroup($name)
    {
        if ($name) {
            $this->serializationContext = SerializationContext::create()->setGroups($name);
        }

        return $this;
    }
//endregion Protected
}