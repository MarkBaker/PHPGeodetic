<?php

namespace Geodetic;

/**
 *
 * Class that accepts a set of individual Angle values for a Rotation Matrix and creates a standardised interface
 * that can be passed to the Rotation Matrix constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class RotationMatrixValues extends Base\Angle
{
    /**
     * Create an XYZ_Format interface object for Rotation Matrix Angles from individual values
     *
     * @param     Integer|Float|Angle    $xAngle    The X-Angle value
     * @param     Integer|Float|Angle    $yAngle    The Y-Angle value
     * @param     Integer|Float|Angle    $zAngle    The Z-Angle value
     * @param     string                          $uom       Unit of measure for all three Angle values
     *                                                           (if they are passed as integer or float)
     * @throws    Exception
     */
    public function __construct(
        $xAngle = null,
        $yAngle = null,
        $zAngle = null,
        $uom = Angle::DEGREES
    ) {
        $this->setValues($xAngle, $yAngle, $zAngle, $uom);
    }
}
