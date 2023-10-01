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

use Evrinoma\UtilsBundle\Rest\RestPayloadInterface;
use Evrinoma\UtilsBundle\Rest\RestPayloadTrait;
use Evrinoma\UtilsBundle\Rest\RestStatusControllerTrait;
use Evrinoma\UtilsBundle\Rest\RestStatusInterface;
use Evrinoma\UtilsBundle\Rest\RestStatusTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractWrappedApiController extends AbstractApiController implements RestStatusControllerInterface, RestStatusInterface, RestPayloadInterface
{
    use RestPayloadTrait;
    use RestStatusControllerTrait;
    use RestStatusTrait;

    protected function jsonResponse(string $message, array $data, array $error, array $headers = []): JsonResponse
    {
        return $this->json($this->getRestPayload($message, $data, $error), $this->getRestStatus(), $headers);
    }
}
