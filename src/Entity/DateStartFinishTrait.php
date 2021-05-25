<?php

namespace Evrinoma\UtilsBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


trait DateStartFinishTrait
{
//region SECTION: Fields
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="date", nullable=true)
     */
    private $dateStart;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinish", type="date", nullable=true)
     */
    private $dateFinish;
//endregion Fields

//region SECTION: Getters/Setters
    /**
     * @return \DateTime
     */
    public function getDateStart(): \DateTime
    {
        return $this->dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateFinish(): \DateTime
    {
        return $this->dateFinish;
    }

    /**
     * @param \DateTime $dateStart
     *
     * @return $this
     */
    public function setDateStart(\DateTime $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @param \DateTime $dateFinish
     *
     * @return $this
     */
    public function setDateFinish(\DateTime $dateFinish): self
    {
        $this->dateFinish = $dateFinish;

        return $this;
    }
//endregion Getters/Setters


}