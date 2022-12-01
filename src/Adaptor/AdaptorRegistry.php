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

namespace Evrinoma\UtilsBundle\Adaptor;

use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;

class AdaptorRegistry implements AdaptorRegistryInterface
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function transactional(callable $func)
    {
        if ($this->manager instanceof ManagerRegistry) {
            return $this->manager->getManager()->transactional($func);
        }
        if ($this->manager instanceof ManagerRegistryInterface) {
            return $this->manager->transactional($func);
        }

        return $func($this->manager);
    }

    public function transactionals(callable $func)
    {
        if ($this->manager instanceof ManagerRegistry) {
            $em = $this->manager->getManager();
            $connection = $em->getConnection();
            try {
                $connection->beginTransaction();

                $func($em);

                $connection->commit();
            } catch (\Exception $e) {
                $connection->rollBack();
                throw $e;
            }

            return null;
        }

        if ($this->manager instanceof ManagerRegistryInterface) {
            return $func($this->manager);
        }

        return $func($this->manager);
    }
}
