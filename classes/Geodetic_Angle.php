<?php

/**
 *  An Angle Object.
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Angle extends Geodetic_Measure_Abstract
{
    const DEGREES     = 'degrees';
    const MINUTES     = 'minutes';
    const ARCMINUTES  = 'arcminutes';
    const SECONDS     = 'seconds';
    const ARCSECONDS  = 'arcseconds';
    const RADIANS     = 'radians';
    const GRADIANS    = 'gradians';

    /**
     *  Unit of Measure conversion reference values
     *  This array, indexed by the UoM names, holds the conversion factor for each UoM translating to/from degrees
     *
     *  @access private
     *  @var    float[]
     */
    protected static $_conversions = array(
            self::DEGREES     => 1.0,
            self::MINUTES     => 60.0,
            self::ARCMINUTES  => 60.0,
            self::SECONDS     => 3600.0,
            self::ARCSECONDS  => 3600.0,
            self::RADIANS     => 0.01745329251994329576923690768489,
            self::GRADIANS    => 0.9,
        );


    /**
     *  The angle
     *  This value will always be maintained internally in degrees (°)
     *
     *  @access protected
     *  @var    float
     */
    protected $_angle = 0.0;


    /**
     *  Create a new Angle object
     *
     *  @param     integer|float    $angle    The Angle value in the specified unit
     *  @param     string           $uom      Unit of Measure (default is DEGREES)
     *  @throws    Geodetic_Exception
     */
    function __construct($angle = NULL,
                         $uom = self::DEGREES)
    {
        if (!is_null($angle))
            $this->setValue($angle, $uom);
    }   // function __construct()


    /**
     *  Set the Angle in the specified Unit of Measure
     *
     *  @param     integer|float    $angle    The Angle in the specified unit
     *  @param     string           $uom      Unit of Measure (default is DEGREES)
     *  @return    void
     *  @throws    Geodetic_Exception
     */
    public function setValue($angle = 0.0,
                             $uom = self::DEGREES)
    {
        if (!is_numeric($angle))
            throw new Geodetic_Exception('Angle must be a numeric value');
        if (is_null($uom)) {
            $uom = self::DEGREES;
        } elseif (!in_array($uom, self::getUOMs())) {
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');
        }

        $this->_angle = self::convertToDegrees($angle, $uom);
    }

    /**
     *  Reverse the sign of the Angle
     *
     *  @return    void
     */
    public function invertValue()
    {
        $this->_angle = 0 - $this->_angle;
    }

    /**
     *  Get the Angle in the requested Unit of Measure
     *
     *  @param     string    $uom    Unit of Measure (default is DEGREES)
     *  @return    float             The Angle value in the specified unit
     *  @throws    Geodetic_Exception
     */
    public function getValue($uom = self::DEGREES)
    {
        if (is_null($uom)) {
            $uom = self::DEGREES;
        } elseif (!in_array($uom, self::getUOMs())) {
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');
        }

        return self::convertFromDegrees($this->_angle, $uom);
    }

    /**
     *  Return the angle as a string formatted as decimal degrees and minutes (to a specified number of decimals)
     *
     *  @param     integer    $decimals    Number of decimals for the minutes display
     *  @return    string                  The Angle value formatted as a degrees/minutes string
     *  @throws    Geodetic_Exception
     */
    public function toDM($decimals = 3)
    {
        if (is_null($decimals))
            $decimals = 3;
        if (!is_numeric($decimals))
            throw new Geodetic_Exception('Decimals argument must be a numeric value');

        $degrees = intval($this->_angle);
        $minutes = abs($this->_angle - $degrees) * 60;

        $mask = "%d°%02.{$decimals}f'";
        return sprintf($mask, $degrees, $minutes);
    }

    /**
     *  Return the angle as a string formatted as decimal degrees, minutes and seconds (to a specified number of decimals)
     *
     *  @param     integer    $decimals    Number of decimals for the seconds display
     *  @return    string                  The Angle value formatted as a degrees/minutes/seconds string
     *  @throws    Geodetic_Exception
     */
    public function toDMS($decimals = 3)
    {
        if (is_null($decimals))
            $decimals = 3;
        if (!is_numeric($decimals))
            throw new Geodetic_Exception('Decimals argument must be a numeric value');

        $degrees = intval($this->_angle);
        $tempMS = abs($this->_angle - $degrees) * 3600;
        $minutes = floor($tempMS / 60);
        $seconds = $tempMS - ($minutes * 60);

        $mask = "%d°%02d'%02.{$decimals}f\"";
        return sprintf($mask, $degrees, $minutes, $seconds);
    }

    /**
     *  Convert a specified angle and unit of measure to degrees
     *
     *  @param     integer|float    $angle    Angle measurement to convert in the specified unit
     *  @param     string           $uom      Unit of Measure to convert the angle from
     *  @return    float            The converted angle value
     *  @throws    Geodetic_Exception
     */
    public static function convertToDegrees($angle = 0.0,
                                            $uom = NULL)
    {
        if (!is_numeric($angle))
            throw new Geodetic_Exception('Angle must be a numeric value');
        $angle = (float) $angle;

        if (is_null($uom))
            throw new Geodetic_Exception('Unit of Measure must be specified');

        if (!isset(self::$_conversions[$uom]))
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');

        $factor = self::$_conversions[$uom];

        return $angle / $factor;
    }   //  public static function convertToDegrees()

    /**
     *  Convert a specified angle in degrees to the specified unit of measure
     *
     *  @param     integer|float    $angle    Angle measurement to convert
     *  @param     string           $uom      Unit of Measure to convert the angle to
     *  @return    float            The converted angle value
     *  @throws    Geodetic_Exception
     */
    public static function convertFromDegrees($angle = 0.0,
                                              $uom = NULL)
    {
        if (!is_numeric($angle))
            throw new Geodetic_Exception('Angle must be a numeric value');
        $angle = (float) $angle;

        if (is_null($uom))
            throw new Geodetic_Exception('Unit of Measure must be specified');

        if (!isset(self::$_conversions[$uom]))
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');

        $factor = self::$_conversions[$uom];

        return $angle * $factor;
    }   //  public static function convertFromDegrees()

    /**
     *  Convert a specified angle and unit of measure to a different unit of measure
     *
     *  @param     integer|float    $angle      Angle measurement to convert in the specified from unit
     *  @param     string           $uomFrom    Unit of Measure to convert the angle from
     *  @param     string           $uomTo      Unit of Measure to convert the angle to
     *  @return    float            The converted angle value
     *  @throws    Geodetic_Exception
     */
    public static function convertAngle($angle = 0.0,
                                        $uomFrom = NULL,
                                        $uomTo = NULL)
    {
        return self::convertFromDegrees(
            self::convertToDegrees(
                $angle,
                $uomFrom
            ),
            $uomTo
        );
    }   //  public static function convertAngle()

}
