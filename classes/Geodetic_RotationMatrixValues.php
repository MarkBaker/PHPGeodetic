<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_RotationMatrixValues extends Geodetic_Angle_Abstract
{
    public function __construct($xAngle = NULL,
                                $yAngle = NULL,
                                $zAngle = NULL,
                                $uom = Geodetic_Angle::DEGREES)
    {
        $this->setValues($xAngle, $yAngle, $zAngle, $uom);
    }

}
