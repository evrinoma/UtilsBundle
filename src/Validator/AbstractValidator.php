<?php

namespace Evrinoma\UtilsBundle\Validator;

use Evrinoma\UtilsBundle\Constraint\Complex\ConstraintInterface;
use Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface as PropertyConstraintInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface as BasicValidatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractValidator implements BasicValidatorInterface
{
//region SECTION: Fields
    /**
     * @var string|null
     */
    protected static ?string $entityClass = null;
    /**
     * @var PropertyConstraintInterface[]
     */
    public array $propertyConstraints = [];
    /**
     * @var Constraint[]
     */
    public array $constraints = [];
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;
    /**
     * @var bool
     */
    private bool $metadataLoaded = false;
//endregion Fields

//region SECTION: Constructor
    /**
     * ContractorValidator constructor.
     *
     * @param string             $entityClass
     * @param ValidatorInterface $validator
     */
    protected function __construct(string $entityClass, ValidatorInterface $validator)
    {
        self::$entityClass = $entityClass;
        $this->validator   = $validator;
    }
//endregion Constructor

//region SECTION: Public
    public function addPropertyConstraint(PropertyConstraintInterface $constant): void
    {
        $this->propertyConstraints[$constant->getPropertyName()] = $constant;
    }

    public function addConstraint(ConstraintInterface $constant): void
    {
        foreach ($constant->getConstraints() as $constant) {
            $this->constraints[] = $constant;
        }
    }

    public function validate($value, $constraints = null, $groups = null): ConstraintViolationListInterface
    {
        $this->addConstrains();

        return $this->validator->validate($value, $constraints, $groups);
    }
//endregion Public

//region SECTION: Private
    /**
     * @return $this
     */
    private function addConstrains(): self
    {
        if (!$this->metadataLoaded) {
            $metadata = $this->validator->getMetadataFor(self::$entityClass);
            foreach ($this->constraints as $constraint) {
                $metadata->addConstraint($constraint);
            }
            foreach ($this->propertyConstraints as $propertyConstraint) {
                $metadata->addPropertyConstraints($propertyConstraint->getPropertyName(), $propertyConstraint->getConstraints());
            }
            $this->metadataLoaded = !$this->metadataLoaded;
        }

        return $this;
    }
//endregion Private
}