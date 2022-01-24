<?php

namespace Evrinoma\UtilsBundle\Constraint\Complex;

use Symfony\Component\Validator\ConstraintValidatorInterface;

interface ConstraintInterface
{
    public function getConstraint(): ConstraintValidatorInterface;
}