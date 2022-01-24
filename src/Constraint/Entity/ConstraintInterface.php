<?php

namespace Evrinoma\UtilsBundle\Constraint\Entity;

use Symfony\Component\Validator\Constraint;

interface ConstraintInterface
{
    public function getConstraint(): Constraint;
}