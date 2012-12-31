<?php

/**
 *
 * Class that accepts a set of individual Angle values for a Rotation Matrix and creates a standardised interface
 * that can be passed to the Rotation Matrix constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_RotationMatrixValues extends Geodetic_Angle_Abstract
{
    /**
     * Create an XYZ_Format interface object for Rotation Matrix Angles from individual values
     *
     * @param     Integer|Float|Geodetic_Angle    $xAngle    The X-Angle value
     * @param     Integer|Float|Geodetic_Angle    $yAngle    The Y-Angle value
     * @param     Integer|Float|Geodetic_Angle    $zAngle    The Z-Angle value
     * @param     string                          $uom       Unit of measure for all three Angle values
     *                                                           (if they are passed as integer or float)
     * @throws    Geodetic_Exception
     */
    public function __construct($xAngle = NULL,
                                $yAngle = NULL,
                                $zAngle = NULL,
                                $uom = Geodetic_Angle::DEGREES)
    {
        $this->setValues($xAngle, $yAngle, $zAngle, $uom);
    }

}
