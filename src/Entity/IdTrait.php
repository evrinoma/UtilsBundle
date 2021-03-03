<?php

namespace Evrinoma\UtilsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IdTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait IdTrait
{
//region SECTION: Fields

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
//endregion Fields

//region SECTION: Public
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
//endregion Getters/Setters
}