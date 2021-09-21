<?php

namespace Evrinoma\UtilsBundle\Validator;

use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    public function validate($value, $constraints = null, $groups = null):ConstraintViolationListInterface;
    public function addConstraint(ConstraintInterface $constant):void;
}