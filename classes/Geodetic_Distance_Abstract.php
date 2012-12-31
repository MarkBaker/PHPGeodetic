<?php

/**
 *
 * Interface for overloading constructor in classes that require x, y and z arguments
 *     with distance values
 *
 * @package Geodetic
 * @subpackage Measures
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_Distance_Abstract implements Geodetic_XyzFormat_Interface
{
    /**
     * The X-distance
     *
     * @access protected
     * @var    Geodetic_Distance
     */
    protected $_xValue;

    /**
     * The Y-distance
     *
     * @access protected
     * @var    Geodetic_Distance
     */
    protected $_yValue;

    /**
     * The Z-distance
     *
     * @access protected
     * @var    Geodetic_Distance
     */
    protected $_zValue;

    /**
     * Set the three Distance values, as used for the Translation Vectors
     *
     * @param     Integer|Float|Geodetic_Distance    $xDistance    The X-Distance value
     * @param     Integer|Float|Geodetic_Distance    $yDistance    The Y-Distance value
     * @param     Integer|Float|Geodetic_Distance    $zDistance    The Z-Distance value
     * @param     string                             $uom          Unit of measure for all three Distance values
     *                                                                 (if they are passed as integer or float)
     */
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

    /**
     * Set the X-Distance value
     *
     * @param     Geodetic_Distance    $xValue    The Distance value
     */
    protected function setX($xValue)
    {
        $this->_xValue = $xValue;
    }

    /**
     * Get the X-Distance value
     *
     * @return     Geodetic_Distance    The Distance value
     */
    public function getX()
    {
        return $this->_xValue;
    }

    /**
     * Set the Y-Distance value
     *
     * @param     Geodetic_Distance    $yValue    The Distance value
     */
    protected function setY($yValue)
    {
        $this->_yValue = $yValue;
    }

    /**
     * Get the Y-Distance value
     *
     * @return     Geodetic_Distance    The Distance value
     */
    public function getY()
    {
        return $this->_yValue;
    }

    /**
     * Set the Z-Distance value
     *
     * @param     Geodetic_Distance    $zValue    The Distance value
     */
    protected function setZ($zValue)
    {
        $this->_zValue = $zValue;
    }

    /**
     * Get the Z-Distance value
     *
     * @return     Geodetic_Distance    The Distance value
     */
    public function getZ()
    {
        return $this->_zValue;
    }

}
