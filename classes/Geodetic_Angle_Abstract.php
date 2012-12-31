<?php

/**
 *
 * Interface for overloading constructor in classes that require x, y and z arguments
 *     with angle values
 *
 * @package Geodetic
 * @subpackage Measures
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_Angle_Abstract implements Geodetic_XyzFormat_Interface
{
    /**
     * The X-angle
     *
     * @access protected
     * @var    Geodetic_Angle
     */
    protected $_xAngle;

    /**
     * The Y-angle
     *
     * @access protected
     * @var    Geodetic_Angle
     */
    protected $_yAngle;

    /**
     * The Z-angle
     *
     * @access protected
     * @var    Geodetic_Angle
     */
    protected $_zAngle;

    /**
     * Set the three Angle values, as used for the Rotation Matrix
     *
     * @param    integer|float|Geodetic_Angle    $xAngle    The X-Angle value
     * @param    integer|float|Geodetic_Angle    $yAngle    The Y-Angle value
     * @param    integer|float|Geodetic_Angle    $zAngle    The Z-Angle value
     * @param    string                          $uom       Unit of measure for all Angle values
     *                                                          (if they are passed as integer or float)
     */
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

    /**
     * Set the X-Angle value
     *
     * @param     Geodetic_Angle    $xAngle    The Angle value
     */
    protected function setX(Geodetic_Angle $xAngle)
    {
        $this->_xAngle = $xAngle;
    }

    /**
     * Get the X-Angle value
     *
     * @return     Geodetic_Angle    The Angle value
     */
    public function getX()
    {
        return $this->_xAngle;
    }

    /**
     * Set the Y-Angle value
     *
     * @param     Geodetic_Angle    $yAngle    The Angle value
     */
    protected function setY(Geodetic_Angle $yAngle)
    {
        $this->_yAngle = $yAngle;
    }

    /**
     * Get the Y-Angle value
     *
     * @return     Geodetic_Angle    The Angle value
     */
    public function getY()
    {
        return $this->_yAngle;
    }

    /**
     * Set the Z-Angle value
     *
     * @param     Geodetic_Angle    $zAngle    The Angle value
     */
    protected function setZ(Geodetic_Angle $zAngle)
    {
        $this->_zAngle = $zAngle;
    }

    /**
     * Get the Z-Angle value
     *
     * @return     Geodetic_Angle    The Angle value
     */
    public function getZ()
    {
        return $this->_zAngle;
    }

}
