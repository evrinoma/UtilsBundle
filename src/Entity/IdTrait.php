<?php

namespace Evrinoma\UtilsBundle\Entity;

trait IdTrait
{


    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}