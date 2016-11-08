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


    /**
     * Set label
     *
     * @param string $label
     *
     * @return Equipments
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add carE
     *
     * @param \AppBundle\Entity\Cars $carE
     *
     * @return Equipments
     */
    public function addCarE(\AppBundle\Entity\Cars $carE)
    {
        $this->carE[] = $carE;

        return $this;
    }

    /**
     * Remove carE
     *
     * @param \AppBundle\Entity\Cars $carE
     */
    public function removeCarE(\AppBundle\Entity\Cars $carE)
    {
        $this->carE->removeElement($carE);
    }

    /**
     * Get carE
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarE()
    {
        return $this->carE;
    }

    /**
     * Add carO
     *
     * @param \AppBundle\Entity\Cars $carO
     *
     * @return Equipments
     */
    public function addCarO(\AppBundle\Entity\Cars $carO)
    {
        $this->carO[] = $carO;

        return $this;
    }

    /**
     * Remove carO
     *
     * @param \AppBundle\Entity\Cars $carO
     */
    public function removeCarO(\AppBundle\Entity\Cars $carO)
    {
        $this->carO->removeElement($carO);
    }

    /**
     * Get carO
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarO()
    {
        return $this->carO;
    }
}
