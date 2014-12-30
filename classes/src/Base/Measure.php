<?php

namespace Geodetic\Base;

/**
 *
 * Base methods common to all measurement classes
 *
 * @package Geodetic
 * @subpackage Measures
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Measure
{

    protected function setValueValidation($measureName, $defaultUom, $value = 0.0, $uom = null)
    {
        if (!is_numeric($value)) {
            throw new \Geodetic\Exception($measureName . ' must be a numeric value');
        } elseif (is_null($uom)) {
            return $defaultUom;
        } elseif (!in_array($uom, self::getUOMs())) {
            throw new \Geodetic\Exception($uom . ' is not a recognised Unit of Measure');
        }

        return $uom;
    }

    protected function getValueValidation($defaultUom, $uom = null)
    {
        if (is_null($uom)) {
            $uom = $defaultUom;
        } elseif (!in_array($uom, self::getUOMs())) {
            throw new \Geodetic\Exception($uom . ' is not a recognised Unit of Measure');
        }

        return $uom;
    }

    protected static function validateUnitConversion($measureName, $value = 0.0, $uom = null)
    {
        if (!is_numeric($value)) {
            throw new \Geodetic\Exception($measureName . ' must be a numeric value');
        } elseif (is_null($uom)) {
            throw new \Geodetic\Exception('Unit of Measure must be specified');
        } elseif (!isset(static::$conversions[$uom])) {
            throw new \Geodetic\Exception($uom . ' is not a recognised Unit of Measure');
        }

        return static::$conversions[$uom];
    }

    /**
     * Get a list of the supported Units of Measure
     *
     * @return    string[]    An array listing the supported Unit of Measure values
     */
    public static function getUOMs()
    {
        return array_keys(static::$conversions);
    }
}
