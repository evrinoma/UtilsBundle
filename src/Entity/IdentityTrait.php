<?php

namespace Evrinoma\UtilsBundle\Entity;

use Evrinoma\ContractBundle\Model\Define\AbstractType;

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