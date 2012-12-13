<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_LatLong_CoordinateValues extends Geodetic_LatLong_Coordinates_Abstract
{
    /**
     *  Create a new set of coordinates for a Latitude/Longitude object
     *
     *  @param     integer|float    $latitude      Latitude value
     *  @param     integer|float    $longitude     Longitude value
     *  @param     string           $latLongUom    Unit of Measure for Latitude and Longitude values
     *  @param     integer|float    $height        Height value
     *  @param     string           $heightUom     Unit of Measure for Height value
     *  @throws    Geodetic_Exception
     */
    public function __construct($xLatitude = NULL,
                                $yLongitude = NULL,
                                $latLongUom = Geodetic_Angle::DEGREES,
                                $zHeight = NULL,
                                $heightUom = Geodetic_Distance::METRES)
    {
        $this->setCoordinates($xLatitude, $yLongitude, $latLongUom, $zHeight, $heightUom);
    }

}
