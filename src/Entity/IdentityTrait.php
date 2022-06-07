<?php

namespace Evrinoma\UtilsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\ContractBundle\Model\Define\AbstractType;

/**
 * Trait IdentityTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait IdentityTrait
{

    /**
     * @var string
     *
     * @ORM\Column(name="identity", type="string", length=255, nullable=false)
     */
    protected string $identity;



    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @param string $identity
     *
     * @return self
     */
    public function setIdentity(string $identity): self
    {
        $this->identity = $identity;

        return $this;
    }

}