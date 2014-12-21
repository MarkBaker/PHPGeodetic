<?php

namespace Geodetic;

/**
 *
 * Interface for overloading constructor in classes that require x, y and z arguments
 *     with angle and height/elevation values
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class LatLong_Coordinates_Abstract implements XyzFormat_Interface
{
    /**
     * @var    Angle    The Latitude
     */
    protected $_xLatitude;

    /**
     * @var    Angle    The Longitude
     */
    protected $_yLongitude;

    /**
     * @var    Distance    The Height/Elevation
     */
    protected $_zHeight;


    /**
     * Create an XYZ_Format interface object for Latitude/Longitude Coordinates from individual values
     *
     * @param     integer|float|Angle       $xLatitude     The X-Distance value
     * @param     integer|float|Angle       $yLongitude    The Y-Distance value
     * @param     string                             $latLongUom    Unit of measure for the two angle values
     *                                                                   (if they are passed as integer or float)
     * @param     integer|float|Distance    $zHeight       The Z-Distance value
     * @param     string                             $heightUom     Unit of measure for the height value
     *                                                                   (if it is passed as integer or float)
     * @throws    Exception
     */
    protected function setCoordinates($xLatitude,
                                      $yLongitude,
                                      $latLongUom,
                                      $zHeight,
                                      $heightUom)
    {
        $this->setX(
            ($xLatitude instanceof Angle) ? $xLatitude : new Angle($xLatitude, $latLongUom)
        );

        $this->setY(
            ($yLongitude instanceof Angle) ? $yLongitude : new Angle($yLongitude, $latLongUom)
        );

        $this->setZ(
            ($zHeight instanceof Distance) ? $zHeight : new Distance($zHeight, $heightUom)
        );
    }

    /**
     * Set the Latitude value
     *
     * @param     Angle    $xLatitude    The Latitude value
     */
    protected function setX($xLatitude)
    {
        $this->_xLatitude = $xLatitude;
    }

    /**
     * Get the Latitude value
     *
     * @return     Angle    The Latitude value
     */
    public function getX()
    {
        return $this->_xLatitude;
    }

    /**
     * Set the Longitude value
     *
     * @param     Angle    $yLongitude    The Longitude value
     */
    protected function setY($yLongitude)
    {
        $this->_yLongitude = $yLongitude;
    }

    /**
     * Get the Longitude value
     *
     * @return     Angle    The Longitude value
     */
    public function getY()
    {
        return $this->_yLongitude;
    }

    /**
     * Set the Height/Elevation value
     *
     * @param     Distance    $zHeight    The Height/Elevation value
     */
    protected function setZ($zHeight)
    {
        $this->_zHeight = $zHeight;
    }

    /**
     * Get the Height/Elevation value
     *
     * @return     Distance    The Height/Elevation value
     */
    public function getZ()
    {
        return $this->_zHeight;
    }

}
