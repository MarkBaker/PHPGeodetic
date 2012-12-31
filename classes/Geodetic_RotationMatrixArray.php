<?php

/**
 *
 * Class that accepts an array of Angle values for a Rotation Matrix and creates a standardised interface
 * that can be passed to the Rotation Matrix constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_RotationMatrixArray extends Geodetic_Angle_Abstract
{
    /**
     * Create an XYZ-Format interface object for Rotation Matrix Angles from an array of values
     *
     * @param     (Integer|Float|Geodetic_Angle)[]    $angles    The array of X, Y and Z angle values
     * @param     string                              $uom       The unit of measure for these angle values
     *                                                               (if they are passed as integer or float)
     * @throws    Geodetic_Exception
     */
    public function __construct(array $angles = NULL,
                                $uom = Geodetic_Angle::DEGREES)
    {
        if (is_null($angles))
            throw new Geodetic_Exception('An array of angles must be passed');
        if (count($angles) == 3) {
            list ($xAngle, $yAngle, $zAngle) = array_values($angles);
        } else {
            throw new Geodetic_Exception('Invalid number of angles in array');
        }

        $this->setValues($xAngle, $yAngle, $zAngle, $uom);
    }

}
