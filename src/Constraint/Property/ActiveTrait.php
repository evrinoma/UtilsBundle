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

namespace Evrinoma\UtilsBundle\Constraint\Property;

use Evrinoma\UtilsBundle\Model\ActiveModel;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;

trait ActiveTrait
{
    public function getConstraints(): array
    {
        return [
            new NotBlank(),
            new Choice([ActiveModel::ACTIVE, ActiveModel::DELETED, ActiveModel::BLOCKED, ActiveModel::MODERATED]),
        ];
    }

    public function getPropertyName(): string
    {
        return 'active';
    }
}
