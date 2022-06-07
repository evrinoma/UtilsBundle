<?php

namespace Evrinoma\UtilsBundle\Entity;



trait DateStartFinishTrait
{

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="dateStart", type="date_immutable", nullable=true)
     */
    protected $dateStart;
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="dateFinish", type="date_immutable", nullable=true)
     */
    protected $dateFinish;



    /**
     * @return bool
     */
    public function hasDateStart(): bool
    {
        return $this->dateStart !== null;
    }

    /**
     * @return bool
     */
    public function hasDateFinish(): bool
    {
        return $this->dateFinish !== null;
    }



    /**
     * @return \DateTimeImmutable
     */
    public function getDateStart(): \DateTimeImmutable
    {
        return $this->dateStart;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateFinish(): \DateTimeImmutable
    {
        return $this->dateFinish;
    }

    /**
     * @param \DateTimeImmutable $dateStart
     *
     * @return self
     */
    public function setDateStart(\DateTimeImmutable $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $dateFinish
     *
     * @return self
     */
    public function setDateFinish(\DateTimeImmutable $dateFinish): self
    {
        $this->dateFinish = $dateFinish;

        return $this;
    }



}