<?php

/**
 *  A geodetic datum (plural datums, not data) is a reference from which measurements are made.
 *  In surveying and geodesy, a datum is a set of reference points on the Earth's surface against which
 *  position measurements are made and (often) an associated model of the shape of the Earth (reference ellipsoid)
 *  to define a geodetic coordinate system.
 *  Horizontal datums are used for describing a point on the Earth's surface, in latitude and longitude or another
 *  coordinate system.
 *
 *  Because the Earth is an imperfect ellipsoid, localised datums can give a more accurate representation of the
 *  area of coverage than the global WGS 84 datum. OSGB36, for example, is a better approximation to the geoid
 *  covering the British Isles than the global WGS 84 ellipsoid. However, as the benefits of a global system
 *  outweigh the greater accuracy, the global WGS 84 datum is becoming increasingly adopted.
 *
 *  -    Description modified from the Wikipedia article at http://en.wikipedia.org/wiki/Geodetic_datum
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Datum
{
    const OSGB          = 'OSGB36';
    const OSGB36        = 'OSGB36';
    const WGS1984       = 'WGS84';
    const WGS84         = 'WGS84';
    const IRELAND_1965  = 'IRELAND_1965';


    /**
     *  Values for all pre-defined Datums
     *
     *  @access private
     *  @var    mixed[]
     */
    private static $_geodeticDatums = array(
        self::OSGB36 => array(
            'name' => 'Ordnance Survey - Great Britain (1936)',
            'synonyms'            => 'OSGB',
            'defaultRegion'       => 'GB - Great Britain',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::AIRY_1830,
            'regions'             => array(
                'GB - Great Britain' => array(
                    'translationVectors' => array(
                        'x' => 446.448,     //  metres
                        'y' => -125.157,    //  metres
                        'z' => 542.06,      //  metres
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.1502,      //  arcseconds
                        'y' => 0.247,       //  arcseconds
                        'z' => 0.8421,      //  arcseconds
                   ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => -20.4894    //  ppm
                ),
            ),
        ),
        self::WGS84 => array(    //    Global GPS
            'name'                => 'WGS 1984',
            'synonyms'            => 'WGS1984',
            'defaultRegion'       => 'Global Definition',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::WGS_84,
            'regions'             => array(
                'Global Definition' => array(
                    'translationVectors' => array(
                        'x' => 0.0,     //  metres
                        'y' => 0.0,     //  metres
                        'z' => 0.0,     //  metres
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,    //  arcseconds
                        'y' => 0.0,    //  arcseconds
                        'z' => 0.0,    //  arcseconds
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
            ),
        ),
        self::IRELAND_1965 => array( //  Ireland 1965
            'name'                => 'Ireland 1965',
            'synonyms'            => '',
            'defaultRegion'       => 'Ireland',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::AIRY_MODIFIED,
            'regions'             => array(
                'Ireland' => array(
                    'translationVectors' => array(
                        'x' => 482.53,     //  metres
                        'y' => -130.596,     //  metres
                        'z' => 564.557,     //  metres
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => -1.042,    //  arcseconds
                        'y' => -0.214,    //  arcseconds
                        'z' => -0.631,    //  arcseconds
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 8.15    //  ppm
                ),
            ),
        ),
    );


    protected $_datumReference;
    protected $_datumName;
    protected $_regionName;

    protected $_ellipsoidName;
    protected $_ellipsoid;
    protected $_bursaWolfParameters;

    /**
     * Create a new Datum
     *
     * @param    $datum     The name of the datum to use for this ellipsoid
     * @param    $region    The name of a region within this datum to use for Helmert Transform Bursa-Wolf parameters
     * @throws   Geodetic_Exception
     */
    function __construct($datum = Geodetic_Datum::WGS84, $region = NULL)
    {
        if (!is_null($datum))
            $this->setDatum($datum, $region);
    }


    /**
     *    Get the internal reference name of this Datum object
     *
     *    @return   string    The reference name of this datum
     */
    public function getDatumReference()
    {
        return $this->_datumReference;
    }

    /**
     *    Get the descriptive name of this Datum object
     *
     *    @return   string    The name of this datum
     */
    public function getDatumName()
    {
        return $this->_datumName;
    }

    /**
     *    Get the Name of the Datum region
     *
     *    @return   string    The name of this datum region
     */
    public function getRegionName()
    {
        return $this->_regionName;
    }

    /**
     * Validate a Datum Name or synonym
     *
     * @param    string    $datum     The name of the datum to validate, or a synonym for that name
     * @return   string    The actual name used internally for the requested datum
     * @throws   Geodetic_Exception
     */
    private static function _isValidDatum($datum) {
        if (is_null($datum))
            throw new Geodetic_Exception('A Datum name must be specified');

        if (!isset(self::$_geodeticDatums[$datum])) {
            if (defined('self::'.$datum)) {
                $datum = constant('self::'.$datum);
                if (!isset(self::$_geodeticDatums[$datum])) {
                    throw new Geodetic_Exception('"'.$datum.'" is not a valid datum');
                }
            } else {
                throw new Geodetic_Exception('"'.$datum.'" is not a valid datum');
            }
        }

        return $datum;
    }

    /**
     * Set the Data for this Datum object
     *
     * @param    string    $datum     The name of the datum to use for this ellipsoid
     * @param    string    $region    The name of a region within this datum to use for Helmert Transform Bursa-Wolf parameters.
     *                                If no region is specified, the object will use a default set of values for the
     *                                    Helmert transform Bursa-Wolf parameters from the region defined in defaultRegion for
     *                                    the Datum.
     * @return   Geodetic_Datum
     * @throws   Geodetic_Exception
     */
    public function setDatum($datum = NULL,
                             $region = NULL)
    {
        $datum = self::_isValidDatum($datum);

        if (is_null($region))
            $region = self::$_geodeticDatums[$datum]['defaultRegion'];

        $this->_datumReference = $datum;
        $this->_datumName = self::$_geodeticDatums[$datum]['name'];
        $this->_ellipsoidName = self::$_geodeticDatums[$datum]['referenceEllipsoid'];
        $this->_ellipsoid = new Geodetic_ReferenceEllipsoid($this->_ellipsoidName);

        $this->setRegion($region);

        return $this;
    }

    /**
     * Set the Region for this Datum object to use for Helmert Transform Bursa-Wolf parameters
     *
     * @param    $region    The name of a region within the current datum to use for Helmert Transform Bursa-Wolf parameters.
     * @throws   Geodetic_Exception
     */
    public function setRegion($region = NULL)
    {
        if (is_null($region))
            throw new Geodetic_Exception('A Region name must be specified');

        $datum = $this->_datumReference;
        if (!isset(self::$_geodeticDatums[$datum]['regions'][$region]))
            throw new Geodetic_Exception('"'.$region.'" is not a valid region for this datum');

        $rotationMatrix = new Geodetic_RotationMatrix(
            new Geodetic_RotationMatrixArray(
                self::$_geodeticDatums[$datum]['regions'][$region]['rotationMatrix'],
                self::$_geodeticDatums[$datum]['regions'][$region]['rotationMatrixUOM']
            )
        );
        $translationVectors = new Geodetic_TranslationVectors(
            new Geodetic_TranslationVectorArray(
                self::$_geodeticDatums[$datum]['regions'][$region]['translationVectors'],
                self::$_geodeticDatums[$datum]['regions'][$region]['translationVectorsUOM']
            )
        );

        $this->_regionName = $region;
        $this->_bursaWolfParameters = new Geodetic_BursaWolfParameters(
            $rotationMatrix,
            $translationVectors,
            self::$_geodeticDatums[$datum]['regions'][$region]['scaleFactor']
        );

        return $this;
    }

    /**
     *    Get the name of the Reference Elipsoid used for this Datum
     *
     *    @return   string    The Name of the Reference Ellipsoid for this Datum
     */
    public function getReferenceEllipsoidName()
    {
        return $this->_ellipsoidName;
    }

    /**
     *    Get the Reference Elipsoid used for this Datum
     *
     *    @return   Geodetic_ReferenceEllipsoid    The Reference Ellipsoid for this Datum
     */
    public function getReferenceEllipsoid()
    {
        return $this->_ellipsoid;
    }

    /**
     *    Get the Bursa-Wolf Parameters used to transpose this Datum to WGS84
     *
     *    @return   Geodetic_BursaWolfParameters    The Bursa-Wolf Parameters used to transpose this Datum to WGS84
     */
    public function getBursaWolfParameters()
    {
        return $this->_bursaWolfParameters;
    }

    /**
     *    Get a list of the supported Datum names
     *
     *    @return   array of string        An array listing the supported Datum names
     */
    public static function getDatumNames()
    {
        return array_combine(
            array_keys(
                self::$_geodeticDatums
            ),
            array_map(
                function ($datum) {
                    return $datum['name'];
                },
                self::$_geodeticDatums
            )
        );
    }

    /**
     *    Get a list of the supported Region names for the specified Datum
     *
     *    @return   array of string        An array listing the supported Region names for the specified Datum
     */
    public static function getRegionNamesForDatum($datum = NULL)
    {
        $datum = self::_isValidDatum($datum);

        return array_unique(
            array_keys(self::$_geodeticDatums[$datum]['regions'])
        );
    }

}
