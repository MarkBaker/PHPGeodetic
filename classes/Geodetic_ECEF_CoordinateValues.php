<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_ECEF_CoordinateValues extends Geodetic_Distance_Abstract
{
    public function __construct($xCoordinate = NULL,
                                $yCoordinate = NULL,
                                $zCoordinate = NULL,
                                $uom = Geodetic_Distance::METRES)
    {
        $this->setValues($xCoordinate, $yCoordinate, $zCoordinate, $uom);
    }

}
