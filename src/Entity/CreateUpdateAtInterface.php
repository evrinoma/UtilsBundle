<?php


namespace Evrinoma\UtilsBundle\Entity;


interface CreateUpdateAtInterface
{
    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): self;

    /**
     * @param \DateTimeImmutable $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self;
}