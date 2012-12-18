<?php

/**
 *  An Area Object.
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Area extends Geodetic_Measure_Abstract
{
    const SQUARE_METRES       = 'metres2';
    const SQUARE_KILOMETRES   = 'kilometres2';
    const SQUARE_CENTIMETRES  = 'centimetres2';
    const SQUARE_FEET         = 'feet2';
    const SQUARE_YARDS        = 'yards2';
    const SQUARE_MILES        = 'miles2';
    const ACRES               = 'acres';
    const HECTARES            = 'hectares';

    /**
     *  Unit of Measure conversion reference values
     *  This array, indexed by the UoM names, holds the conversion factor for each UoM translating to/from square metres
     *
     *  @access private
     *  @var    float[]
     */
    protected static $_conversions = array(
            self::SQUARE_METRES       => 1.0,
            self::SQUARE_KILOMETRES   => 0.000001,
            self::SQUARE_CENTIMETRES  => 10000,
            self::SQUARE_FEET         => 10.763910417,
            self::SQUARE_YARDS        => 1.1959900463,
            self::SQUARE_MILES        => 3.8610215855e-7,
            self::ACRES               => 0.00024710538147,
            self::HECTARES            => 0.0001,
        );


    /**
     *  The area
     *  This value will always be maintained internally in square metres
     *
     *  @access protected
     *  @var    float
     */
    protected $_area = 0.0;


    /**
     *  Create a new Area object
     *
     *  @param     integer|float    $area    The Area value in the specified unit
     *  @param     string           $uom     Unit of Measure (default is SQUARE_METRES)
     *  @throws    Geodetic_Exception
     */
    function __construct($area = NULL,
                         $uom = self::SQUARE_METRES)
    {
        if (!is_null($area))
            $this->setValue($area, $uom);
    }   // function __construct()


    /**
     *  Set the Area in the specified Unit of Measure
     *
     *  @param     integer|float    $area    The Area in the specified unit
     *  @param     string           $uom     Unit of Measure (default is SQUARE_METRES)
     *  @return    void
     *  @throws    Geodetic_Exception
     */
    public function setValue($area = 0.0,
                             $uom = self::SQUARE_METRES)
    {
        if (!is_numeric($area))
            throw new Geodetic_Exception('Area must be a numeric value');
        if (is_null($uom)) {
            $uom = self::SQUARE_METRES;
        } elseif (!in_array($uom, self::getUOMs())) {
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');
        }

        $this->_area = self::convertToSquareMetres($area, $uom);
    }

    /**
     *  Get the Area in the requested Unit of Measure
     *
     *  @param     string    $uom    Unit of Measure (default is SQUARE_METRES)
     *  @return    float             The Area value in the specified unit
     *  @throws    Geodetic_Exception
     */
    public function getValue($uom = self::SQUARE_METRES)
    {
        if (is_null($uom)) {
            $uom = self::SQUARE_METRES;
        } elseif (!in_array($uom, self::getUOMs())) {
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');
        }

        return self::convertFromSquareMetres($this->_area, $uom);
    }

    /**
     *  Convert a specified area and unit of measure to square metres
     *
     *  @param     integer|float    $area    Area measurement to convert in the specified unit
     *  @param     string           $uom     Unit of Measure to convert the area from
     *  @return    float            The converted area value
     *  @throws    Geodetic_Exception
     */
    public static function convertToSquareMetres($area = 0.0,
                                                 $uom = NULL)
    {
        if (!is_numeric($area))
            throw new Geodetic_Exception('Area must be a numeric value');
        $area = (float) $area;

        if (is_null($uom))
            throw new Geodetic_Exception('Unit of Measure must be specified');

        if (!isset(self::$_conversions[$uom]))
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');

        $factor = self::$_conversions[$uom];

        return $area / $factor;
    }   //  public static function convertToSquareMetres()

    /**
     *  Convert a specified area in square metres to the specified unit of measure
     *
     *  @param     integer|float    $area    Area measurement to convert
     *  @param     string           $uom     Unit of Measure to convert the area to
     *  @return    float            The converted area value
     *  @throws    Geodetic_Exception
     */
    public static function convertFromSquareMetres($area = 0.0,
                                                   $uom = NULL)
    {
        if (!is_numeric($area))
            throw new Geodetic_Exception('Area must be a numeric value');
        $area = (float) $area;

        if (is_null($uom))
            throw new Geodetic_Exception('Unit of Measure must be specified');

        if (!isset(self::$_conversions[$uom]))
            throw new Geodetic_Exception($uom . ' is not a recognised Unit of Measure');

        $factor = self::$_conversions[$uom];

        return $area * $factor;
    }   //  public static function convertFromSquareMetres()

    /**
     *  Convert a specified area and unit of measure to a different unit of measure
     *
     *  @param     integer|float    $area       Area measurement to convert in the specified from unit
     *  @param     string           $uomFrom    Unit of Measure to convert the area from
     *  @param     string           $uomTo      Unit of Measure to convert the area to
     *  @return    float            The converted area value
     *  @throws    Geodetic_Exception
     */
    public static function convertArea($area = 0.0,
                                       $uomFrom = NULL,
                                       $uomTo = NULL)
    {
        return self::convertFromSquareMetres(
            self::convertToSquareMetres(
                $area,
                $uomFrom
            ),
            $uomTo
        );
    }   //  public static function convertArea()

}
