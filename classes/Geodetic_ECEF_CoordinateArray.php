<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_ECEF_CoordinateArray extends Geodetic_Distance_Abstract
{
    public function __construct(array $coordinates = NULL,
                                $uom = Geodetic_Distance::METRES)
    {
        if (is_null($coordinates))
            throw new Geodetic_Exception('An array of distance coordinates must be passed');
        if (count($coordinates) == 3) {
            list ($xCoordinate, $yCoordinate, $zCoordinate) = array_values($coordinates);
        } else {
            throw new Geodetic_Exception('Invalid number of vector coordinates in array');
        }

        $this->setValues($xCoordinate, $yCoordinate, $zCoordinate, $uom);
    }

}
