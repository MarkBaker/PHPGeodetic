<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_LatLong_Coordinates_Abstract implements Geodetic_XyzFormat_Interface
{
    protected $_xLatitude;
    protected $_yLongitude;
    protected $_zHeight;

    protected function setCoordinates($xLatitude,
                                      $yLongitude,
                                      $latLongUom,
                                      $zHeight,
                                      $heightUom)
    {
        $this->setX(
            ($xLatitude instanceof Geodetic_Angle) ? $xLatitude : new Geodetic_Angle($xLatitude, $latLongUom)
        );

        $this->setY(
            ($yLongitude instanceof Geodetic_Angle) ? $yLongitude : new Geodetic_Angle($yLongitude, $latLongUom)
        );

        $this->setZ(
            ($zHeight instanceof Geodetic_Distance) ? $zHeight : new Geodetic_Distance($zHeight, $heightUom)
        );
    }

    protected function setX($xLatitude)
    {
        $this->_xLatitude = $xLatitude;
    }

    public function getX()
    {
        return $this->_xLatitude;
    }

    protected function setY($yLongitude)
    {
        $this->_yLongitude = $yLongitude;
    }

    public function getY()
    {
        return $this->_yLongitude;
    }

    protected function setZ($zHeight)
    {
        $this->_zHeight = $zHeight;
    }

    public function getZ()
    {
        return $this->_zHeight;
    }

}
