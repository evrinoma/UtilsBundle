<?php

namespace Evrinoma\UtilsBundle\Constraint\Entity;

use Symfony\Component\Validator\ConstraintValidatorInterface;

interface ConstraintInterface
{
    public function getConstraint(): ConstraintValidatorInterface;
}