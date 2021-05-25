<?php


namespace Evrinoma\UtilsBundle\Entity;


interface DateStartFinishInterface
{
    /**
     * @return \DateTime
     */
    public function getDateStart(): \DateTime;

    /**
     * @return \DateTime
     */
    public function getDateFinish(): \DateTime;

    /**
     * @param \DateTime $dateStart
     *
     * @return $this
     */
    public function setDateStart(\DateTime $dateStart): self;

    /**
     * @param \DateTime $dateFinish
     *
     * @return $this
     */
    public function setDateFinish(\DateTime $dateFinish): self;
}