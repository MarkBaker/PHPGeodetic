<?php

namespace Geodetic\Base;

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
abstract class Angle implements XyzFormat
{
    /**
     * The X-angle
     *
     * @access protected
     * @var    Angle
     */
    protected $xAngle;

    /**
     * The Y-angle
     *
     * @access protected
     * @var    Angle
     */
    protected $yAngle;

    /**
     * The Z-angle
     *
     * @access protected
     * @var    Angle
     */
    protected $zAngle;

    /**
     * Set the three Angle values, as used for the Rotation Matrix
     *
     * @param    integer|float|Angle    $xAngle    The X-Angle value
     * @param    integer|float|Angle    $yAngle    The Y-Angle value
     * @param    integer|float|Angle    $zAngle    The Z-Angle value
     * @param    string                 $uom       Unit of measure for all Angle values
     *                                                  (if they are passed as integer or float)
     */
    protected function setValues($xAngle, $yAngle, $zAngle, $uom)
    {
        $this->setX(
            ($xAngle instanceof \Geodetic\Angle) ? $xAngle : new \Geodetic\Angle($xAngle, $uom)
        );

        $this->setY(
            ($yAngle instanceof \Geodetic\Angle) ? $yAngle : new \Geodetic\Angle($yAngle, $uom)
        );

        $this->setZ(
            ($zAngle instanceof \Geodetic\Angle) ? $zAngle : new \Geodetic\Angle($zAngle, $uom)
        );
    }

    /**
     * Set the X-Angle value
     *
     * @param     \Geodetic\Angle    $xAngle    The Angle value
     */
    protected function setX(\Geodetic\Angle $xAngle)
    {
        $this->xAngle = $xAngle;
    }

    /**
     * Get the X-Angle value
     *
     * @return     \Geodetic\Angle    The Angle value
     */
    public function getX()
    {
        return $this->xAngle;
    }

    /**
     * Set the Y-Angle value
     *
     * @param     \Geodetic\Angle    $yAngle    The Angle value
     */
    protected function setY(\Geodetic\Angle $yAngle)
    {
        $this->yAngle = $yAngle;
    }

    /**
     * Get the Y-Angle value
     *
     * @return     \Geodetic\Angle    The Angle value
     */
    public function getY()
    {
        return $this->yAngle;
    }

    /**
     * Set the Z-Angle value
     *
     * @param     \Geodetic\Angle    $zAngle    The Angle value
     */
    protected function setZ(\Geodetic\Angle $zAngle)
    {
        $this->zAngle = $zAngle;
    }

    /**
     * Get the Z-Angle value
     *
     * @return     \Geodetic\Angle    The Angle value
     */
    public function getZ()
    {
        return $this->zAngle;
    }
}
