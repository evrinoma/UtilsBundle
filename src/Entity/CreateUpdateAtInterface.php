<?php


namespace Evrinoma\UtilsBundle\Entity;


interface CreateUpdateAtInterface
{
    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime;

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt): self;

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt): self;
}