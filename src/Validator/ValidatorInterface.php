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

namespace Evrinoma\UtilsBundle\Validator;

use Evrinoma\UtilsBundle\Constraint\Complex\ConstraintInterface;
use Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface as PropertyConstraintInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function validate($value, $constraints = null, $groups = null): ConstraintViolationListInterface;

    public function addPropertyConstraint(PropertyConstraintInterface $constant): void;

    public function addConstraint(ConstraintInterface $constant): void;
}
