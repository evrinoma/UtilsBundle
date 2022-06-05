<?php

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
