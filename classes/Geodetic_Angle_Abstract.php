<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_Angle_Abstract implements Geodetic_XyzFormat_Interface
{
    protected $_xAngle;
    protected $_yAngle;
    protected $_zAngle;

    protected function setValues($xAngle,
                                 $yAngle,
                                 $zAngle,
                                 $uom)
    {
        $this->setX(
            ($xAngle instanceof Geodetic_Angle) ? $xAngle : new Geodetic_Angle($xAngle, $uom)
        );

        $this->setY(
            ($yAngle instanceof Geodetic_Angle) ? $yAngle : new Geodetic_Angle($yAngle, $uom)
        );

        $this->setZ(
            ($zAngle instanceof Geodetic_Angle) ? $zAngle : new Geodetic_Angle($zAngle, $uom)
        );
    }

    protected function setX($xAngle)
    {
        $this->_xAngle = $xAngle;
    }

    public function getX()
    {
        return $this->_xAngle;
    }

    protected function setY($yAngle)
    {
        $this->_yAngle = $yAngle;
    }

    public function getY()
    {
        return $this->_yAngle;
    }

    protected function setZ($zAngle)
    {
        $this->_zAngle = $zAngle;
    }

    public function getZ()
    {
        return $this->_zAngle;
    }

}
