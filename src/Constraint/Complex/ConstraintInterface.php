<?php

namespace Evrinoma\UtilsBundle\Constraint\Complex;

use Symfony\Component\Validator\Constraint;

interface ConstraintInterface
{
    public function getConstraint(): Constraint;
}