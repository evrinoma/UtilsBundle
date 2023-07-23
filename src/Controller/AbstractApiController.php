<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle\Controller;

use Evrinoma\UtilsBundle\Serialize\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractApiController extends AbstractController
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        if ($this->serializer) {
            $json = $this->serializer->serialize($data);

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }

    protected function setSerializeGroup(string $name)
    {
        $this->serializer->setGroup($name);

        return $this;
    }

    protected function setSerializeCircularReferenceLimit(int $circularReferenceLimit)
    {
        $this->serializer->setCircularReferenceLimit($circularReferenceLimit);

        return $this;
    }
}
