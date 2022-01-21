<?php


namespace Evrinoma\UtilsBundle\Entity;


interface DateStartFinishInterface
{
//region SECTION: Public
    /**
     * @return bool
     */
    public function hasDateStart(): bool;

    /**
     * @return bool
     */
    public function hasDateFinish(): bool;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return \DateTimeImmutable
     */
    public function getDateStart(): \DateTimeImmutable;

    /**
     * @return \DateTimeImmutable
     */
    public function getDateFinish(): \DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $dateStart
     *
     * @return self
     */
    public function setDateStart(\DateTimeImmutable $dateStart): self;

    /**
     * @param \DateTimeImmutable $dateFinish
     *
     * @return self
     */
    public function setDateFinish(\DateTimeImmutable $dateFinish): self;
//endregion Getters/Setters
}