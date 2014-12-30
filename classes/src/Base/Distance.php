<?php

namespace Geodetic\Base;

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
abstract class Distance implements XyzFormat
{
    /**
     * The X-distance
     *
     * @access protected
     * @var    Distance
     */
    protected $xAngle;

    /**
     * The Y-distance
     *
     * @access protected
     * @var    Distance
     */
    protected $yAngle;

    /**
     * The Z-distance
     *
     * @access protected
     * @var    Distance
     */
    protected $zAngle;

    /**
     * Set the three Distance values, as used for the Translation Vectors
     *
     * @param     Integer|Float|Distance    $xDistance    The X-Distance value
     * @param     Integer|Float|Distance    $yDistance    The Y-Distance value
     * @param     Integer|Float|Distance    $zDistance    The Z-Distance value
     * @param     string                             $uom          Unit of measure for all three Distance values
     *                                                                 (if they are passed as integer or float)
     */
    protected function setValues($xDistance, $yDistance, $zDistance, $uom)
    {
        $this->setX(
            ($xDistance instanceof \Geodetic\Distance) ? $xDistance : new \Geodetic\Distance($xDistance, $uom)
        );

        $this->setY(
            ($yDistance instanceof \Geodetic\Distance) ? $yDistance : new \Geodetic\Distance($yDistance, $uom)
        );

        $this->setZ(
            ($zDistance instanceof \Geodetic\Distance) ? $zDistance : new \Geodetic\Distance($zDistance, $uom)
        );
    }

    /**
     * Set the X-Distance value
     *
     * @param     \Geodetic\Distance    $xValue    The Distance value
     */
    protected function setX($xValue)
    {
        $this->xAngle = $xValue;
    }

    /**
     * Get the X-Distance value
     *
     * @return     \Geodetic\Distance    The Distance value
     */
    public function getX()
    {
        return $this->xAngle;
    }

    /**
     * Set the Y-Distance value
     *
     * @param     \Geodetic\Distance    $yValue    The Distance value
     */
    protected function setY($yValue)
    {
        $this->yAngle = $yValue;
    }

    /**
     * Get the Y-Distance value
     *
     * @return     \Geodetic\Distance    The Distance value
     */
    public function getY()
    {
        return $this->yAngle;
    }

    /**
     * Set the Z-Distance value
     *
     * @param     \Geodetic\Distance    $zValue    The Distance value
     */
    protected function setZ($zValue)
    {
        $this->zAngle = $zValue;
    }

    /**
     * Get the Z-Distance value
     *
     * @return     \Geodetic\Distance    The Distance value
     */
    public function getZ()
    {
        return $this->zAngle;
    }
}
