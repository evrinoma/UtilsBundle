<?php


namespace Evrinoma\UtilsBundle\Entity;


interface DateStartFinishInterface
{
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
     * @return $this
     */
    public function setDateStart(\DateTimeImmutable $dateStart): self;

    /**
     * @param \DateTimeImmutable $dateFinish
     *
     * @return $this
     */
    public function setDateFinish(\DateTimeImmutable $dateFinish): self;
}