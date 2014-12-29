<?php

namespace Geodetic\ECEF;

/**
 *
 * Class that accepts a set of individual Distance values for an ECEF object and creates a standardised interface
 * that can be passed to the ECEF constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class CoordinateValues extends \Geodetic\Base\Distance
{
    /**
     * Create an XYZ_Format interface object for ECEF Distance Coordinates from individual values
     *
     * @param     integer|float|Distance    $xCoordinate    The X-Distance value
     * @param     integer|float|Distance    $yCoordinate    The Y-Distance value
     * @param     integer|float|Distance    $zCoordinate    The Z-Distance value
     * @param     string                    $uom            Unit of measure for all three Distance values
     *                                                           (if they are passed as integer or float)
     * @throws    \Geodetic\Exception
     */
    public function __construct(
        $xCoordinate = null,
        $yCoordinate = null,
        $zCoordinate = null,
        $uom = \Geodetic\Distance::METRES
    ) {
        $this->setValues($xCoordinate, $yCoordinate, $zCoordinate, $uom);
    }
}
