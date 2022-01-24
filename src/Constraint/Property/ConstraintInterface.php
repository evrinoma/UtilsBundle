<?php

namespace Evrinoma\UtilsBundle\Constraint\Property;

interface ConstraintInterface
{
    public function getConstraints(): array;

    public function getPropertyName(): string;
}