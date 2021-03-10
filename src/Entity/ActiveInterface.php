<?php


namespace Evrinoma\UtilsBundle\Entity;


use Doctrine\Common\Collections\Criteria;
use Evrinoma\UtilsBundle\Model\ActiveModel;

interface ActiveInterface
{
//region SECTION: Public
    /**
     * @return bool
     */
    public function isBlocked(): bool;

    /**
     * @return bool
     */
    public function isDeleted(): bool;
//endregion Public

//region SECTION: Getters/Setters
    public static function getCriteria(): Criteria;
//endregion Public

    /**
     * @return string
     */
    public function getActive(): string;

    /**
     * @return $this
     */
    public function setActiveToBlocked(): ActiveInterface;

    /**
     * @param string $active
     *
     * @return ActiveInterface
     */
    public function setActive(string $active = ActiveModel::ACTIVE): ActiveInterface;

    /**
     * @return ActiveInterface
     */
    public function setActiveToDelete(): ActiveInterface;

    /**
     * @return ActiveInterface
     */
    public function setActiveToActive(): ActiveInterface;
}