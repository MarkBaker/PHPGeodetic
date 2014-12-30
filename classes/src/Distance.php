<?php

namespace Geodetic;

/**
 * A Distance Object.
 *
 * @package Geodetic
 * @subpackage Measures
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Distance extends Base\Measure
{
    const METHOD_HAVERSINE = 'h';
    const METHOD_VINCENTY  = 'v';

    const METRES          = 'm';      //    metre (SI base unit)
    const KILOMETRES      = 'km';     //    1000 metres (SI unit)
    const MILES           = 'mi';     //    mile (International)
    const NAUTICAL_MILES  = 'nmi';    //    nautical mile (International)
    const YARDS           = 'yds';    //    yard (International)
    const FEET            = 'ft';     //    foot (International)
    const INCHES          = 'in';     //    inch (International)
    const AU              = 'AU';     //    Astronomical Unit

    /**
     * Unit of Measure conversion reference values
     * This array, indexed by the UoM names, holds the conversion factor for each UoM translating to/from metres
     *
     * @access private
     * @var    float[]
     */
    protected static $conversions = array(
        self::METRES          => 1.0,
        self::KILOMETRES      => 1000.0,
        self::MILES           => 1609.344,
        self::NAUTICAL_MILES  => 1852.0,
        self::YARDS           => 0.9144,
        self::FEET            => 0.3048,
        self::INCHES          => 0.0254,
        self::AU              => 149597871464
    );


    /**
     * The distance
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var    float
     */
    protected $distance = 0.0;


    /**
     * Create a new Distance object
     *
     * @param     integer|float    $distance    The Distance value in the specified unit
     * @param     string           $uom         Unit of Measure (default is METRES)
     * @throws    Exception
     */
    public function __construct($distance = null, $uom = self::METRES)
    {
        if (!is_null($distance)) {
            $this->setValue($distance, $uom);
        }
    }


    /**
     * Set the Distance value in the specified Unit of Measure
     *
     * @param     integer|float    $distance    The Distance value in the specified unit
     * @param     string           $uom         Unit of Measure (default is METRES)
     * @return    void
     * @throws    Exception
     */
    public function setValue($distance = 0.0, $uom = self::METRES)
    {
        $uom = $this->setValueValidation('Distance', self::METRES, $distance, $uom);
        $this->distance = self::convertToMeters($distance, $uom);
    }

    /**
     * Get the Distance value in the requested Unit of Measure
     *
     * @param     string    $uom    Unit of Measure (default is METRES)
     * @return    float             The Distance value in the specified unit
     * @throws    Exception
     */
    public function getValue($uom = self::METRES)
    {
        $uom = $this->getValueValidation(self::METRES, $uom);
        return self::convertFromMeters($this->distance, $uom);
    }

    /**
     * Reverse the sign of the Distance
     *
     * @return    void
     */
    public function invertValue()
    {
        $this->distance = 0 - $this->distance;
    }

    /**
     * Convert a specified distance and unit of measure to meters
     *
     * @param     integer|float    $distance    Distance measurement to convert
     * @param     string           $uom         Unit of Measure to convert the distance from
     * @throws    Exception
     */
    public static function convertToMeters(
        $distance = 0.0,
        $uom = null
    ) {
        $factor = self::validateUnitConversion('Distance', $distance, $uom);

        $distance = (float) $distance;
        return $distance * $factor;
    }

    /**
     * Convert a specified distance in meters to the specified unit of measure
     *
     * @param     integer|float    $distance    Distance measurement to convert
     * @param     string           $uom         Unit of Measure to convert the distance to
     * @throws    Exception
     */
    public static function convertFromMeters(
        $distance = 0.0,
        $uom = null
    ) {
        $factor = self::validateUnitConversion('Distance', $distance, $uom);

        $distance = (float) $distance;
        return $distance / $factor;
    }

    /**
     * Convert a specified distance and unit of measure to a different unit of measure
     *
     * @param     integer|float    $distance    Distance measurement to convert
     * @param     string           $uomFrom     Unit of Measure to convert the distance from
     * @param     string           $uomTo       Unit of Measure to convert the distance to
     * @throws    Exception
     */
    public static function convertDistance(
        $distance = 0.0,
        $uomFrom = null,
        $uomTo = null
    ) {
        return self::convertFromMeters(
            self::convertToMeters(
                $distance,
                $uomFrom
            ),
            $uomTo
        );
    }
}
