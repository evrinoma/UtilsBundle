<?php

namespace Evrinoma\UtilsBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Trait ActiveTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait ActiveTrait
{

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=255, nullable=false)
     */
    protected $active = ActiveModel::ACTIVE;



    /**
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active === ActiveModel::ACTIVE;
    }

    /**
     * @VirtualProperty
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->active === ActiveModel::BLOCKED;
    }

    /**
     * @VirtualProperty
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->active === ActiveModel::DELETED;
    }

    /**
     * @VirtualProperty
     * @return bool
     */
    public function isModerated(): bool
    {
        return $this->active === ActiveModel::MODERATED;
    }



    /**
     * @return string
     */
    public function getActive(): string
    {
        return $this->active;
    }

    /**
     * @return Criteria
     */
    public static function getCriteria(): Criteria
    {
        $criteria = new Criteria();
        $criteria->where(
            $criteria->expr()->eq('active', ActiveModel::ACTIVE)
        );

        return $criteria;
    }

    /**
     * @param string $active
     *
     * @return ActiveInterface
     */
    public function setActive(string $active = ActiveModel::ACTIVE): ActiveInterface
    {
        switch ($active) {
            case ActiveModel::ACTIVE:
                $this->setActiveToActive();
                break;
            case ActiveModel::BLOCKED:
                $this->setActiveToBlocked();
                break;
            case ActiveModel::DELETED:
                $this->setActiveToDelete();
                break;
            case ActiveModel::MODERATED :
                $this->setActiveToModerated();
                break;
        }

        return $this;
    }

    /**
     * @return ActiveInterface
     */
    public function setActiveToModerated(): ActiveInterface
    {
        $this->active = ActiveModel::MODERATED;

        return $this;
    }

    /**
     * @return ActiveInterface
     */
    public function setActiveToDelete(): ActiveInterface
    {
        $this->active = ActiveModel::DELETED;

        return $this;
    }

    /**
     * @return ActiveInterface
     */
    public function setActiveToActive(): ActiveInterface
    {
        $this->active = ActiveModel::ACTIVE;

        return $this;
    }

    /**
     * @return ActiveInterface
     */
    public function setActiveToBlocked(): ActiveInterface
    {
        $this->active = ActiveModel::BLOCKED;

        return $this;
    }

}