<?php

namespace Evrinoma\UtilsBundle\Command\Adaptor;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\Console\Input\InputInterface;

interface CommandInterface
{
    public function argumentDefinition(): array;

    public function helpMessage(): string;

    public function action(DtoInterface $dto): void;

    public function questioners(InputInterface $input): array;

    public function argumentToDto(InputInterface $input): DtoInterface;
}
