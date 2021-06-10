<?php


namespace Evrinoma\UtilsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * Trait CreateUpdateTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait CreateUpdateAtTrait
{
    /**
     * @var \DateTimeImmutable
     * @Type("DateTimeImmutable<'d-m-Y'>")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected \DateTimeImmutable $createdAt;

    /**
     * @var \DateTimeImmutable|null
     * @Type("DateTimeImmutable<'d-m-Y'>")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected \DateTimeImmutable $updatedAt;


    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}