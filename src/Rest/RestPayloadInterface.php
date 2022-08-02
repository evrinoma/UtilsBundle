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

interface RestPayloadInterface extends TypeInterface
{
    public function hasRestType(): bool;

    public function getRestType(): int;

    public function toRestTypeString(): string;

    public function getRestPayload(string $message, array $data): array;
}
