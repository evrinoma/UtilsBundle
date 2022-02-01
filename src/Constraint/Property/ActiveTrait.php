<?php

namespace Evrinoma\UtilsBundle\Constraint\Property;

use Evrinoma\UtilsBundle\Model\ActiveModel;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;

trait ActiveTrait
{
//region SECTION: Getters/Setters
    public function getConstraints(): array
    {
        return [
            new NotBlank(),
            new Choice([ActiveModel::ACTIVE, ActiveModel::DELETED, ActiveModel::BLOCKED, ActiveModel::MODERATED]),
        ];
    }

    public function getPropertyName(): string
    {
        return 'active';
    }
//endregion Getters/Setters
}