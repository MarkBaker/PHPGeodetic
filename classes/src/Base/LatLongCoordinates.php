<?php

namespace Geodetic\Base;

/**
 *
 * Interface for overloading constructor in classes that require x, y and z arguments
 *     with angle and height/elevation values
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class LatLongCoordinates implements XyzFormat
{
    /**
     * @var    Angle    The Latitude
     */
    protected $xLatitude;

    /**
     * @var    Angle    The Longitude
     */
    protected $yLongitude;

    /**
     * @var    Distance    The Height/Elevation
     */
    protected $zHeight;


    /**
     * Create an XYZ_Format interface object for Latitude/Longitude Coordinates from individual values
     *
     * @param     integer|float|Angle       $xLatitude     The X-Distance value
     * @param     integer|float|Angle       $yLongitude    The Y-Distance value
     * @param     string                    $latLongUom    Unit of measure for the two angle values
     *                                                          (if they are passed as integer or float)
     * @param     integer|float|Distance    $zHeight       The Z-Distance value
     * @param     string                    $heightUom     Unit of measure for the height value
     *                                                          (if it is passed as integer or float)
     * @throws    Exception
     */
    protected function setCoordinates(
        $xLatitude,
        $yLongitude,
        $latLongUom,
        $zHeight,
        $heightUom
    ) {
        $this->setX(
            ($xLatitude instanceof \Geodetic\Angle) ? $xLatitude : new \Geodetic\Angle($xLatitude, $latLongUom)
        );

        $this->setY(
            ($yLongitude instanceof \Geodetic\Angle) ? $yLongitude : new \Geodetic\Angle($yLongitude, $latLongUom)
        );

        $this->setZ(
            ($zHeight instanceof \Geodetic\Distance) ? $zHeight : new \Geodetic\Distance($zHeight, $heightUom)
        );
    }

    /**
     * Set the Latitude value
     *
     * @param   \Geodetic\Angle    $xLatitude    The Latitude value
     */
    protected function setX($xLatitude)
    {
        $this->xLatitude = $xLatitude;
    }

    /**
     * Get the Latitude value
     *
     * @return   \Geodetic\Angle    The Latitude value
     */
    public function getX()
    {
        return $this->xLatitude;
    }

    /**
     * Set the Longitude value
     *
     * @param   \Geodetic\Angle    $yLongitude    The Longitude value
     */
    protected function setY($yLongitude)
    {
        $this->yLongitude = $yLongitude;
    }

    /**
     * Get the Longitude value
     *
     * @return   \Geodetic\Angle    The Longitude value
     */
    public function getY()
    {
        return $this->yLongitude;
    }

    /**
     * Set the Height/Elevation value
     *
     * @param   \Geodetic\Distance    $zHeight    The Height/Elevation value
     */
    protected function setZ($zHeight)
    {
        $this->zHeight = $zHeight;
    }

    /**
     * Get the Height/Elevation value
     *
     * @return   \Geodetic\Distance    The Height/Elevation value
     */
    public function getZ()
    {
        return $this->zHeight;
    }
}
