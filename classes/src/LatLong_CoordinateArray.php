<?php

namespace Geodetic;

/**
 *
 * Class that accepts an array of values for a Lat/Long object and creates a standardised interface
 * that can be passed to the Lat/Long constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class LatLong_CoordinateArray extends LatLong_Coordinates_Abstract
{
    /**
     * Create a new set of coordinates for a Latitude/Longitude object
     *
     * @param     integer[]|float[]    $latLongCoordinates    Latitude value
     * @param     string               $latLongUom            Unit of Measure for Latitude and Longitude values
     * @param     integer|float        $zHeight               Height value
     * @param     string               $heightUom             Unit of Measure for Height value
     * @throws    Exception
     */
    public function __construct(
        array $latLongCoordinates = null,
        $latLongUom = Angle::DEGREES,
        $zHeight = null,
        $heightUom = Distance::METRES
    ) {
        if (is_null($latLongCoordinates)) {
            throw new Exception('An array of Latitude/Longitude coordinates must be passed');
        } elseif (count($latLongCoordinates) == 2) {
            list ($xLatitude, $yLongitude) = array_values($latLongCoordinates);
        } else {
            throw new Exception('Invalid number of coordinates in array');
        }

        $this->setCoordinates($xLatitude, $yLongitude, $latLongUom, $zHeight, $heightUom);
    }
}
