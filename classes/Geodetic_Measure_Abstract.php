<?php

/**
 *
 * Base methods common to all measurement classes
 *
 * @package Geodetic
 * @subpackage Measures
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_Measure_Abstract
{

    /**
     * Get a list of the supported Units of Measure
     *
     * @return    string[]    An array listing the supported Angle Unit of Measure values
     */
    public static function getUOMs()
    {
        return array_keys(static::$_conversions);
    }   //  getValueUOMs()

}
