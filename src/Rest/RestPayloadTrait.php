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

namespace Evrinoma\UtilsBundle\Rest;

use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\MessageModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use Evrinoma\UtilsBundle\Model\Rest\TypeModel;
use Symfony\Component\HttpFoundation\Response;

trait RestPayloadTrait
{
    use TypeTrait;

    public function getRestPayload(string $message, array $data, array $error): array
    {
        if (!$this->hasRestType()) {
            switch ($this->getRestStatus()) {
                case Response::HTTP_OK:
                case Response::HTTP_CREATED :
                case Response::HTTP_ACCEPTED:
                    $this->setTypeToInfo();
                    break;
                default:
                    $this->setTypeToError();
            }
        }

        return [
                TypeModel::TYPE => $this->toRestTypeString(),
                MessageModel::MESSAGE => $message,
                PayloadModel::PAYLOAD => $data,
                ErrorModel::ERROR =>$error,
            ];
    }

    public function hasRestType(): bool
    {
        return null !== $this->type;
    }

    public function getRestType(): int
    {
        return $this->type;
    }

    public function toRestTypeString(): string
    {
        return TypeModel::toString($this->getRestType());
    }
}
