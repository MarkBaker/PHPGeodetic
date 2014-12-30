<?php

namespace Geodetic;

/**
 * An Area Object.
 *
 * @package Geodetic
 * @subpackage Measures
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Area extends Base\Measure
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
     * Unit of Measure conversion reference values
     * This array, indexed by the UoM names, holds the conversion factor for each UoM translating to/from square metres
     *
     * @access private
     * @var    float[]
     */
    protected static $conversions = array(
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
     * The area
     * This value will always be maintained internally in square metres
     *
     * @access protected
     * @var    float
     */
    protected $area = 0.0;


    /**
     * Create a new Area object
     *
     * @param     integer|float    $area    The Area value in the specified unit
     * @param     string           $uom     Unit of Measure (default is SQUARE_METRES)
     * @throws    \Geodetic\Exception
     */
    public function __construct($area = null, $uom = self::SQUARE_METRES)
    {
        if (!is_null($area)) {
            $this->setValue($area, $uom);
        }
    }


    /**
     * Set the Area in the specified Unit of Measure
     *
     * @param     integer|float    $area    The Area in the specified unit
     * @param     string           $uom     Unit of Measure (default is SQUARE_METRES)
     * @return    void
     * @throws    \Geodetic\Exception
     */
    public function setValue($area = 0.0, $uom = self::SQUARE_METRES)
    {
        $uom = $this->setValueValidation('Area', self::SQUARE_METRES, $area, $uom);
        $this->area = self::convertToSquareMetres($area, $uom);
    }

    /**
     * Get the Area in the requested Unit of Measure
     *
     * @param     string    $uom    Unit of Measure (default is SQUARE_METRES)
     * @return    float             The Area value in the specified unit
     * @throws    \Geodetic\Exception
     */
    public function getValue($uom = self::SQUARE_METRES)
    {
        $uom = $this->getValueValidation(self::SQUARE_METRES, $uom);
        return self::convertFromSquareMetres($this->area, $uom);
    }

    /**
     * Convert a specified area and unit of measure to square metres
     *
     * @param     integer|float    $area    Area measurement to convert in the specified unit
     * @param     string           $uom     Unit of Measure to convert the area from
     * @return    float            The converted area value
     * @throws    \Geodetic\Exception
     */
    public static function convertToSquareMetres(
        $area = 0.0,
        $uom = null
    ) {
        $factor = self::validateUnitConversion('Area', $area, $uom);

        $area = (float) $area;
        return $area / $factor;
    }

    /**
     * Convert a specified area in square metres to the specified unit of measure
     *
     * @param     integer|float    $area    Area measurement to convert
     * @param     string           $uom     Unit of Measure to convert the area to
     * @return    float            The converted area value
     * @throws    \Geodetic\Exception
     */
    public static function convertFromSquareMetres(
        $area = 0.0,
        $uom = null
    ) {
        $factor = self::validateUnitConversion('Area', $area, $uom);

        $area = (float) $area;
        return $area * $factor;
    }

    /**
     * Convert a specified area and unit of measure to a different unit of measure
     *
     * @param     integer|float    $area       Area measurement to convert in the specified from unit
     * @param     string           $uomFrom    Unit of Measure to convert the area from
     * @param     string           $uomTo      Unit of Measure to convert the area to
     * @return    float            The converted area value
     * @throws    \Geodetic\Exception
     */
    public static function convertArea(
        $area = 0.0,
        $uomFrom = null,
        $uomTo = null
    ) {
        return self::convertFromSquareMetres(
            self::convertToSquareMetres(
                $area,
                $uomFrom
            ),
            $uomTo
        );
    }
}
