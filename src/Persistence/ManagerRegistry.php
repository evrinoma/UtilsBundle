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

namespace Evrinoma\UtilsBundle\Persistence;

use Evrinoma\FetchBundle\Handler\HandlerInterface;
use Evrinoma\FetchBundle\Manager\FetchManagerInterface;

class ManagerRegistry implements ManagerRegistryInterface
{
    private FetchManagerInterface $manager;

    /**
     * @param FetchManagerInterface $manager
     */
    public function __construct(FetchManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getManager(string $handlerName, string $descriptionName): HandlerInterface
    {
        return $this->manager->getHandler($handlerName, $descriptionName);
    }
}
