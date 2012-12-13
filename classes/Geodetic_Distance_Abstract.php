<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_Distance_Abstract implements Geodetic_XyzFormat_Interface
{
    protected $_xValue;
    protected $_yValue;
    protected $_zValue;

    protected function setValues($xDistance,
                                 $yDistance,
                                 $zDistance,
                                 $uom)
    {
        $this->setX(
            ($xDistance instanceof Geodetic_Distance) ? $xDistance : new Geodetic_Distance($xDistance, $uom)
        );

        $this->setY(
            ($yDistance instanceof Geodetic_Distance) ? $yDistance : new Geodetic_Distance($yDistance, $uom)
        );

        $this->setZ(
            ($zDistance instanceof Geodetic_Distance) ? $zDistance : new Geodetic_Distance($zDistance, $uom)
        );
    }

    protected function setX($xValue)
    {
        $this->_xValue = $xValue;
    }

    public function getX()
    {
        return $this->_xValue;
    }

    protected function setY($yValue)
    {
        $this->_yValue = $yValue;
    }

    public function getY()
    {
        return $this->_yValue;
    }

    protected function setZ($zValue)
    {
        $this->_zValue = $zValue;
    }

    public function getZ()
    {
        return $this->_zValue;
    }

}
