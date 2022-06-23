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

use Evrinoma\UtilsBundle\Rest\RestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

interface ApiStatusControllerInterface
{
    public function setRestStatus(RestInterface $manager, \Exception $e): array;
}
