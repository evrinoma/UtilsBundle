<?php


namespace Evrinoma\UtilsBundle\Entity;

/**
 * Trait CreateUpdateTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait CreateUpdateAtTrait
{
    /**
     * @var \DateTime
     * @Type("DateTime<'d-m-Y'>")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Type("DateTime<'d-m-Y'>")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;


    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}