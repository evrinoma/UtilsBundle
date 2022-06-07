<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Evrinoma\UtilsBundle\Model\ActiveModel;

trait ActiveTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=255, nullable=false)
     */
    protected $active = ActiveModel::ACTIVE;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return ActiveModel::ACTIVE === $this->active;
    }

    /**
     * @VirtualProperty
     *
     * @return bool
     */
    public function isBlocked(): bool
    {
        return ActiveModel::BLOCKED === $this->active;
    }

    /**
     * @VirtualProperty
     *
     * @return bool
     */
    public function isDeleted(): bool
    {
        return ActiveModel::DELETED === $this->active;
    }

    /**
     * @VirtualProperty
     *
     * @return bool
     */
    public function isModerated(): bool
    {
        return ActiveModel::MODERATED === $this->active;
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
            case ActiveModel::MODERATED:
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
