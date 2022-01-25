<?php

namespace Evrinoma\UtilsBundle\Constraint\Complex;

use Symfony\Component\Validator\Constraint;

abstract class AbstractConstraint extends Constraint
{
    public function getTargets()
    {
        return static::CLASS_CONSTRAINT;
    }
}