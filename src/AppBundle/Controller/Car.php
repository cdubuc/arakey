<?php
/**
 * Created by IntelliJ IDEA.
 * User: c.dubuc
 * Date: 06/11/2016
 * Time: 23:56
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Delete;
use AppBundle\Entity\Cars;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Cars
 * @package AppBundle\Controller
 * @RouteResource("car",pluralize=true)
 */
class Car extends FOSRestController
{
    private $oEM = null;

    /**
     * @Get("/api/getAllCars", name="AllCars", defaults={"_format"="json"})
     */
    function getAllCars() {
        // ToDo : write custom query or tune many to many association to avoid loops on get and loading useless data.
        $this->oEM = $this->getDoctrine()->getManager();
        $mRes = $this->oEM->getRepository('AppBundle:Cars')->findAll();
        if (true === empty($mRes)) {
            throw $this->createNotFoundException('Not Found');
        }
        return $mRes;
    }

    /**
     * @Get("/api/getCar/{iCarId}", name="getCar", defaults={"_format"="json"})
     */
    function getCar($iCarId) {
        $iCarId = intval($iCarId);
        if (0 >= $iCarId) {
            throw $this->createAccessDeniedException('Invalid Params');
        }
        $this->oEM = $this->getDoctrine()->getManager();
        return $this->oEM->getRepository('AppBundle:Cars')->find($iCarId);
    }

    /**
     * @Delete("/api/deleteCar/{iCarId}", name="deleteCar", defaults={"_format"="json"})
     */
    function deleteCar($iCarId) {
        $iCarId = intval($iCarId);
        if (0 >= $iCarId) {
            throw $this->createNotFoundException('Invalid Params');
        }
        $this->oEM = $this->getDoctrine()->getManager();
        $oCar = $this->oEM->getRepository('AppBundle:Cars')->find($iCarId);
        if (true === is_null($oCar)) {
            throw $this->createNotFoundException('Not Found');
        }
        $this->oEM->remove($oCar);
        $this->oEM->flush();
        $aData = array('OK');
        $aReturn['code'] = 200;
        $aReturn['status'] = 'OK';
        $aReturn['message'] = '';
        $aReturn['data'] = $aData;
        return $aReturn;
    }

    /**
     * @Post("/api/postCar", name="newCar", defaults={"_format"="json"})
     */
    function postCar() {
        $this->oEM = $this->getDoctrine()->getManager();
        $oRequest = Request::createFromGlobals();
        $oParams = json_decode($oRequest->getContent());
        try {
            if (false === empty($oParams)) {
                $aEquip = array();
                $aOptions = array();
                if (true === is_array($oParams->equip)) {
                    foreach ($oParams->equip as $iEquip) {
                        $aEquip[] = $this->oEM->getRepository('AppBundle:Equipments')->find($iEquip);
                    }
                }
                if (true === is_array($oParams->options)) {
                    foreach ($oParams->options as $iOption) {
                        $aOptions[] = $this->oEM->getRepository('AppBundle:Equipments')->find($iOption);
                    }
                }
                $this->entityNotExists(new Cars($oParams->maker, $oParams->model, $oParams->price, $aEquip, $aOptions));
                $this->oEM->flush();
                $aData = array('OK');
                $aReturn['code'] = 200;
                $aReturn['status'] = 'OK';
                $aReturn['message'] = '';
                $aReturn['data'] = $aData;
            } else {
                $aReturn['code'] = 503;
                $aReturn['status'] = 'NOK';
                $aReturn['message'] = 'Params Error.';
                $aReturn['data'] = '';
            }
        } catch (Exception $e) {
            $aReturn['code'] = 503;
            $aReturn['status'] = 'NOK';
            $aReturn['message'] = $e->getMessage();
            $aReturn['data'] = '';
        }
        return $aReturn;
    }

    /**
     * @Put("/api/putCar", name="updateCar", defaults={"_format"="json"})
     */
    function putCar() {
        $this->oEM = $this->getDoctrine()->getManager();
        $oRequest = Request::createFromGlobals();
        $oParams = json_decode($oRequest->getContent());
        try {
            if (false === empty($oParams)) {
                if (false === isset($oParams->id) || 0 >= intval($oParams->id)) {
                    throw $this->createNotFoundException('Not Found');
                }
                $iCarId = $oParams->id;
                $oCar = $this->oEM->getRepository('AppBundle:Cars')->find($iCarId);
                if (true === is_null($oCar)) {
                    throw $this->createNotFoundException('Not Found');
                }
                $oCar->resetEquip();
                $oCar->resetOption();
                if (true === isset($oParams->equip) && true === is_array($oParams->equip)) {
                    foreach ($oParams->equip as $iEquip) {
                        $oCar->addEquip($this->oEM->getRepository('AppBundle:Equipments')->find($iEquip));
                    }
                }
                if (true === isset($oParams->options) && true === is_array($oParams->options)) {
                    foreach ($oParams->options as $iOption) {
                        $oCar->addOption($this->oEM->getRepository('AppBundle:Equipments')->find($iOption));
                    }
                }
                if (true === isset($oParams->maker)) {
                    $oCar->setMaker($oParams->maker);
                } else {
                    $oCar->setMaker(null);
                }
                if (true === isset($oParams->model)) {
                    $oCar->setModel($oParams->model);
                } else {
                    $oCar->setModel(null);
                }
                if (true === isset($oParams->price)) {
                    $oCar->setPrice($oParams->price);
                } else {
                    $oCar->setPrice(null);
                }
                $this->oEM->flush();
                $aData = array('OK');
                $aReturn['code'] = 200;
                $aReturn['status'] = 'OK';
                $aReturn['message'] = '';
                $aReturn['data'] = $aData;
            } else {
                $aReturn['code'] = 503;
                $aReturn['status'] = 'NOK';
                $aReturn['message'] = 'Params Error.';
                $aReturn['data'] = '';
            }
        } catch (Exception $e) {
            $aReturn['code'] = 503;
            $aReturn['status'] = 'NOK';
            $aReturn['message'] = $e->getMessage();
            $aReturn['data'] = '';
        }
        return $aReturn;
    }

    /**
     * @Patch("/api/patchCar", name="patchCar", defaults={"_format"="json"})
     */
    function patchCar() {
        $this->oEM = $this->getDoctrine()->getManager();
        $oRequest = Request::createFromGlobals();
        $oParams = json_decode($oRequest->getContent());
        try {
            if (false === empty($oParams)) {
                if (false === isset($oParams->id) || 0 >= intval($oParams->id)) {
                    throw $this->createNotFoundException('Not Found');
                }
                $iCarId = $oParams->id;
                $oCar = $this->oEM->getRepository('AppBundle:Cars')->find($iCarId);
                if (true === is_null($oCar)) {
                    throw $this->createNotFoundException('Not Found');
                }
                if (true === isset($oParams->equip) && true === is_array($oParams->equip)) {
                    $oCar->resetEquip();
                    foreach ($oParams->equip as $iEquip) {
                        $oCar->addEquip($this->oEM->getRepository('AppBundle:Equipments')->find($iEquip));
                    }
                }
                if (true === isset($oParams->options) && true === is_array($oParams->options)) {
                    $oCar->resetOption();
                    foreach ($oParams->options as $iOption) {
                        $oCar->addOption($this->oEM->getRepository('AppBundle:Equipments')->find($iOption));
                    }
                }
                if (true === isset($oParams->maker)) {
                    $oCar->setMaker($oParams->maker);
                }
                if (true === isset($oParams->model)) {
                    $oCar->setModel($oParams->model);
                }
                if (true === isset($oParams->price)) {
                    $oCar->setPrice($oParams->price);
                }
                $this->oEM->flush();
                $aData = array('OK');
                $aReturn['code'] = 200;
                $aReturn['status'] = 'OK';
                $aReturn['message'] = '';
                $aReturn['data'] = $aData;
            } else {
                $aReturn['code'] = 503;
                $aReturn['status'] = 'NOK';
                $aReturn['message'] = 'Params Error.';
                $aReturn['data'] = '';
            }
        } catch (Exception $e) {
            $aReturn['code'] = 503;
            $aReturn['status'] = 'NOK';
            $aReturn['message'] = $e->getMessage();
            $aReturn['data'] = '';
        }
        return $aReturn;
    }

    /**
     * Check for duplicate
     * @param Cars $oCars
     * @return bool
     * @throws \Exception
     */
    public function entityNotExists(Cars $oCars)
    {
        try {
            $aFindAssociation = $this->oEM->getRepository('AppBundle:Cars')->findOneBy(
                array(
                    'maker' => $oCars->getMaker(),
                    'model' => $oCars->getModel(),
                    'price' => $oCars->getPrice()
                )
            );
        } catch (Exception $e) {
            throw $e;
        }

        if (count($aFindAssociation) > 0) {
            return FALSE;
        } else {
            return $this->oEM->persist($oCars);
        }
    }
}