<?php

namespace Evrinoma\UtilsBundle\Constraint\Entity;

interface ConstraintInterface
{
    public function getConstraints(): array;

    public function getName(): string;
}