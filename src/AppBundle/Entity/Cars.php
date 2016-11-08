<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cars
 *
 * @ORM\Table(name="cars")
 * @ORM\Entity
 */
class Cars
{
    /**
     * @var string
     *
     * @ORM\Column(name="maker", type="string", length=30, nullable=false)
     */
    private $maker;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=30, nullable=false)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=12, scale=2, nullable=false)
     */
    private $price;

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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Equipments", inversedBy="carE")
     * @ORM\JoinTable(name="car_equipments",
     *   joinColumns={
     *     @ORM\JoinColumn(name="car_e_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="equip_id", referencedColumnName="id")
     *   }
     * )
     */
    private $equip;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Equipments", inversedBy="carO")
     * @ORM\JoinTable(name="car_options",
     *   joinColumns={
     *     @ORM\JoinColumn(name="car_o_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     *   }
     * )
     */
    private $option;

    /**
     * Constructor
     */
    public function __construct($sMaker, $sModel, $fPrice, $aEquip, $aOption)
    {
        $this->maker = $sMaker;
        $this->model = $sModel;
        $this->price = $fPrice;
        $this->equip = new \Doctrine\Common\Collections\ArrayCollection();
        $this->option = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($aEquip as $oEquip) {
            $this->equip->add($oEquip);
        }
        foreach ($aOption as $oOption) {
            $this->option->add($oOption);
        }
    }

    /**
     * Set maker
     *
     * @param string $maker
     *
     * @return Cars
     */
    public function setMaker($maker)
    {
        $this->maker = $maker;

        return $this;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Cars
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Cars
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
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
     * Add equip
     *
     * @param \AppBundle\Entity\Equipments $equip
     *
     * @return Cars
     */
    public function addEquip(\AppBundle\Entity\Equipments $equip)
    {
        $this->equip[] = $equip;

        return $this;
    }

    /**
     * Reset equip
     *
     * @return Cars
     */
    public function resetEquip()
    {
        $this->equip = array();

        return $this;
    }

    /**
     * Remove equip
     *
     * @param \AppBundle\Entity\Equipments $equip
     */
    public function removeEquip(\AppBundle\Entity\Equipments $equip)
    {
        $this->equip->removeElement($equip);
    }

    /**
     * Get equip
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquip()
    {
        return $this->equip;
    }

    /**
     * Add option
     *
     * @param \AppBundle\Entity\Equipments $option
     *
     * @return Cars
     */
    public function addOption(\AppBundle\Entity\Equipments $option)
    {
        $this->option[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param \AppBundle\Entity\Equipments $option
     */
    public function removeOption(\AppBundle\Entity\Equipments $option)
    {
        $this->option->removeElement($option);
    }

    /**
     * Reset optio
     *
     * @return Cars
     */
    public function resetOption()
    {
        $this->option = array();

        return $this;
    }

    /**
     * Get option
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Get maker
     *
     * @return string
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
}
