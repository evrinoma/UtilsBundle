<?php

namespace Evrinoma\UtilsBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface as PropertyConstraintInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function validate($value, $constraints = null, $groups = null): ConstraintViolationListInterface;

    public function addPropertyConstraint(PropertyConstraintInterface $constant): void;

    public function addConstraint(Constraint $constant): void;
}
