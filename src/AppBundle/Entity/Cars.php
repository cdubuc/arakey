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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Equipments")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Equipments")
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

    public function getMaker() {
        return $this->maker;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPrice() {
        return $this->price;
    }
}

