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

namespace Evrinoma\UtilsBundle\Command;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\Console\Input\InputInterface;

interface BridgeInterface
{
    public function argumentDefinition(): array;

    public function helpMessage(): string;

    public function action(DtoInterface $dto): void;

    public function questioners(InputInterface $input): array;

    public function argumentToDto(InputInterface $input): DtoInterface;
}
