<?php

namespace Evrinoma\UtilsBundle\Constraint;

interface ConstraintInterface
{
    public function getConstraints(): array;
    public function getPropertyName():string;
}