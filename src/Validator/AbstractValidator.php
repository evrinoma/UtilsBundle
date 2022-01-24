<?php

namespace Evrinoma\UtilsBundle\Validator;

use Evrinoma\UtilsBundle\Constraint\Entity\ConstraintInterface;
use Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface as PropertyConstraintInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface as BasicValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
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
     * @var ConstraintInterface[]
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
     * @param string $entityClass
     */
    protected function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
        $this->validator   = Validation::createValidatorBuilder()->getValidator();
    }
//endregion Constructor

//region SECTION: Public
    public function addPropertyConstraint(PropertyConstraintInterface $constant): void
    {
        $this->propertyConstraints[$constant->getPropertyName()] = $constant;
    }

    public function addConstraint(ConstraintInterface $constant): void
    {
        $this->constraints[$constant->getName()] = $constant;
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
            foreach ($this->propertyConstraints as $propertyConstraint) {
                $metadata->addPropertyConstraints($propertyConstraint->getPropertyName(), $propertyConstraint->getConstraints());
            }
            foreach ($this->constraints as $constraint) {
                $metadata->addConstraint($constraint->getConstraint());
            }
            $this->metadataLoaded = !$this->metadataLoaded;
        }

        return $this;
    }
//endregion Private
}