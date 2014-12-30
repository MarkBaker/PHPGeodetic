<?php

namespace Geodetic;

/**
 *
 * Class that accepts an array of Angle values for a Rotation Matrix and creates a standardised interface
 * that can be passed to the Rotation Matrix constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class RotationMatrixArray extends Base\Angle
{
    /**
     * Create an XYZ-Format interface object for Rotation Matrix Angles from an array of values
     *
     * @param     (Integer|Float|Angle)[]    $angles    The array of X, Y and Z angle values
     * @param     string                              $uom       The unit of measure for these angle values
     *                                                               (if they are passed as integer or float)
     * @throws    Exception
     */
    public function __construct(
        array $angles = null,
        $uom = Angle::DEGREES
    ) {
        if (is_null($angles)) {
            throw new Exception('An array of angles must be passed');
        } elseif (count($angles) == 3) {
            list ($xAngle, $yAngle, $zAngle) = array_values($angles);
        } else {
            throw new Exception('Invalid number of angles in array');
        }

        $this->setValues($xAngle, $yAngle, $zAngle, $uom);
    }
}
