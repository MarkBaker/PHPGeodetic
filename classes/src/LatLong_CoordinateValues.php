<?php

namespace Geodetic;

/**
 *
 * Class that accepts a set of individual values for a Lat/Long object and creates a standardised interface
 * that can be passed to the Lat/Long constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class LatLong_CoordinateValues extends LatLong_Coordinates_Abstract
{
    /**
     * Create a new set of coordinates for a Latitude/Longitude object
     *
     * @param     integer|float    $xLatitude      Latitude value
     * @param     integer|float    $yLongitude     Longitude value
     * @param     string           $latLongUom     Unit of Measure for Latitude and Longitude values
     * @param     integer|float    $zHeight        Height value
     * @param     string           $heightUom      Unit of Measure for Height value
     * @throws    Exception
     */
    public function __construct(
        $xLatitude = null,
        $yLongitude = null,
        $latLongUom = Angle::DEGREES,
        $zHeight = null,
        $heightUom = Distance::METRES
    ) {
        $this->setCoordinates($xLatitude, $yLongitude, $latLongUom, $zHeight, $heightUom);
    }
}
