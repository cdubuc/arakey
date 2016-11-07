<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipments
 *
 * @ORM\Table(name="equipments")
 * @ORM\Entity
 */
class Equipments
{
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=50, nullable=false)
     */
    private $label;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Cars", mappedBy="equip")
     */
    private $carE;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Cars", mappedBy="option")
     */
    private $carO;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->carE = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->carO = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

