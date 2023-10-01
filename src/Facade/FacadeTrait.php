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

namespace Evrinoma\UtilsBundle\Facade;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Adaptor\AdaptorRegistryInterface;
use Evrinoma\UtilsBundle\Handler\HandlerInterface;

trait FacadeTrait
{
    protected AdaptorRegistryInterface $adaptorRegistry;

    protected HandlerInterface  $handler;

    public function post(DtoInterface $dto, string &$group, array &$data): void
    {
        $this->preValidator->onPost($dto);

        $commandManager = $this->commandManager;

        $this->adaptorRegistry->transactional(
            function () use ($dto, $commandManager, &$data) {
                $data[] = $commandManager->post($dto);
            }
        );

        $this->handler->onPost($dto, $data, $group);
    }

    public function put(DtoInterface $dto, string &$group, array &$data): void
    {
        $this->preValidator->onPut($dto);

        $commandManager = $this->commandManager;

        $this->adaptorRegistry->transactional(
            function () use ($dto, $commandManager, &$data) {
                $data[] = $commandManager->put($dto);
            }
        );

        $this->handler->onPut($dto, $data, $group);
    }

    public function delete(DtoInterface $dto, string &$group, array &$data): void
    {
        $this->preValidator->onDelete($dto);

        $commandManager = $this->commandManager;

        $this->adaptorRegistry->transactional(
            function () use ($dto, $commandManager, &$data) {
                $commandManager->delete($dto);
                $data = ['OK'];
            }
        );
    }

    public function criteria(DtoInterface $dto, string &$group, array &$data): void
    {
        $data = $this->queryManager->criteria($dto);
        $this->handler->onCriteria($dto, $data, $group);
    }

    public function get(DtoInterface $dto, string &$group, array &$data): void
    {
        $data[] = $this->queryManager->get($dto);
        $this->handler->onGet($dto, $data, $group);
    }
}
