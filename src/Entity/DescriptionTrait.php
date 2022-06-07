<?php

namespace Evrinoma\UtilsBundle\Entity;


trait DescriptionTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    protected string $description;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {

        $this->description = $description;

        return $this;
    }
}