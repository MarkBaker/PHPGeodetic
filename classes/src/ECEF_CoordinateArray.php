<?php

namespace Geodetic;

/**
 *
 * Class that accepts an array of Distance values for an ECEF object and creates a standardised interface
 * that can be passed to the ECEF constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class ECEF_CoordinateArray extends Distance_Abstract
{
    /**
     * Create an XYZ-Format interface object for ECEF Distance Coordinates from an array of values
     *
     * @param     (Integer|Float|Distance)[]    $coordinates    The array of X, Y and Z distance values
     * @param     string                                 $uom            The unit of measure for these distance values
     *                                                                       (if they are passed as integer or float)
     * @throws    Exception
     */
    public function __construct(
        array $coordinates = null,
        $uom = Distance::METRES
    ) {
        if (is_null($coordinates)) {
            throw new Exception('An array of distance coordinates must be passed');
        } elseif (count($coordinates) == 3) {
            list ($xCoordinate, $yCoordinate, $zCoordinate) = array_values($coordinates);
        } else {
            throw new Exception('Invalid number of vector coordinates in array');
        }

        $this->setValues($xCoordinate, $yCoordinate, $zCoordinate, $uom);
    }
}
