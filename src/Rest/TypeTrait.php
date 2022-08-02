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

use Evrinoma\UtilsBundle\Model\Rest\TypeModel;

trait TypeTrait
{
    private ?int $type = null;

    public function setTypeToInfo(): void
    {
        $this->type = TypeModel::INFO;
    }

    public function setTypeToError(): void
    {
        $this->type = TypeModel::ERROR;
    }

    public function setTypeToNotice(): void
    {
        $this->type = TypeModel::NOTICE;
    }

    public function setTypeToDebug(): void
    {
        $this->type = TypeModel::DEBUG;
    }
}
