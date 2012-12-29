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
    const ED50_ED77     = 'ED50_ED77';
    const WGS1972       = 'WGS72';
    const WGS72         = 'WGS72';
    const WGS1972BE     = 'WGS72BE';
    const WGS72BE       = 'WGS72BE';
    const NAD27         = 'NAD27';
    const AGD66         = 'AGD66';
    const AGD84         = 'AGD84';


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
            'epsg_id'             => '4277',
            'esri_name'           => 'D_OSGB_1936',
            'defaultRegion'       => 'GB - Great Britain',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::AIRY_1830,
            'regions'             => array(
                'GB - Great Britain' => array(
                    'translationVectors' => array(
                        'x' => 446.448,
                        'y' => -125.157,
                        'z' => 542.06,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.1502,
                        'y' => 0.247,
                        'z' => 0.8421,
                   ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => -20.4894    //  ppm
                ),
            ),
        ),
        self::WGS84 => array(    //    Global GPS
            'name'                => 'WGS 1984',
            'synonyms'            => 'WGS1984',
            'epsg_id'             => '4326',
            'esri_name'           => 'D_WGS_1984',
            'defaultRegion'       => 'Global Definition',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::WGS_84,
            'regions'             => array(
                'Global Definition' => array(
                    'translationVectors' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
            ),
        ),
        self::IRELAND_1965 => array(
            'name'                => 'Ireland 1965',
            'synonyms'            => '',
            'defaultRegion'       => 'Ireland',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::AIRY_MODIFIED,
            'regions'             => array(
                'Ireland' => array(
                    'translationVectors' => array(
                        'x' => 482.53,
                        'y' => -130.596,
                        'z' => 564.557,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => -1.042,
                        'y' => -0.214,
                        'z' => -0.631,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 8.15    //  ppm
                ),
            ),
        ),
        self::AGD66 => array(
            'name'                => 'Australian Geodetic Datum 1966',
            'synonyms'            => '',
            'epsg_id'             => '4202',
            'esri_name'           => 'D_Australian_1966',
            'defaultRegion'       => 'Australia',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::AUSTRALIAN_1965,
            'regions'             => array(
                'Australia' => array(
                    'translationVectors' => array(
                        'x' => -117.81,
                        'y' => -51.54,
                        'z' => 137.78,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => -0.303,
                        'y' => -0.446,
                        'z' => -0.234,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::RADIANS,
                    'scaleFactor' => -0.29    //  ppm
                ),
            ),
        ),
        self::AGD84 => array(
            'name'                => 'Australian Geodetic Datum 1984',
            'synonyms'            => '',
            'epsg_id'             => '4203',
            'esri_name'           => 'D_Australian_1984',
            'defaultRegion'       => 'Australia',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::AUSTRALIAN_1965,
            'regions'             => array(
                'Australia' => array(
                    'translationVectors' => array(
                        'x' => -117.76,
                        'y' => -51.51,
                        'z' => 139.06,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => -0.292,
                        'y' => -0.443,
                        'z' => -0.277,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::RADIANS,
                    'scaleFactor' => -0.191    //  ppm
                ),
            ),
        ),
        self::ED50_ED77 => array(
            'name'                => 'European 1950',
            'synonyms'            => '',
            'epsg_id'             => '4154',
            'esri_name'           => 'D_European_1950_ED77',
            'defaultRegion'       => 'Europe',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::INTERNATIONAL_1924,
            'regions'             => array(
                'Europe' => array(
                    'translationVectors' => array(
                        'x' => -110.33,
                        'y' => -97.73,
                        'z' => -119.85,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.342,
                        'y' => 1.163,
                        'z' => 0.272,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::RADIANS,
                    'scaleFactor' => 0.063    //  ppm
                ),
            ),
        ),
        self::WGS72 => array(
            'name'                => 'WGS 1972',
            'synonyms'            => 'WGS1972',
            'epsg_id'             => '4322',
            'esri_name'           => 'D_WGS_1972',
            'defaultRegion'       => 'Europe',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::WGS_72,
            'regions'             => array(
                'Europe' => array(
                    'translationVectors' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 4.5,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.554,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.219    //  ppm
                ),
            ),
        ),
        self::WGS72BE => array(
            'name'                => 'WGS 1972 BE',
            'synonyms'            => 'WGS1972BE',
            'epsg_id'             => '4324',
            'esri_name'           => 'D_WGS_1972_BE',
            'defaultRegion'       => 'Global',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::WGS_72,
            'regions'             => array(
                'Global' => array(
                    'translationVectors' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 1.9,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.814,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => -0.38    //  ppm
                ),
            ),
        ),
        self::NAD27 => array(
            'name'                => 'NAD27',
            'synonyms'            => '',
            'epsg_id'             => '4267',
            'esri_name'           => 'D_North_American_1927',
            'defaultRegion'       => 'North America',
            'referenceEllipsoid'  => Geodetic_ReferenceEllipsoid::CLARKE_1866,
            'regions'             => array(
                'North America' => array(
                    'translationVectors' => array(
                        'x' => -8.0,
                        'y' => 160.0,
                        'z' => 176.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Aleutian Islands' => array(
                    'translationVectors' => array(
                        'x' => -2.0,
                        'y' => 0.0,
                        'z' => 4.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Aleutian Islands - East' => array(
                    'translationVectors' => array(
                        'x' => -2.0,
                        'y' => 152.0,
                        'z' => 149.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Aleutian Islands - West' => array(
                    'translationVectors' => array(
                        'x' => -2.0,
                        'y' => 204.0,
                        'z' => 105.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Bahamas' => array(
                    'translationVectors' => array(
                        'x' => -4.0,
                        'y' => 154.0,
                        'z' => 178.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canada' => array(
                    'translationVectors' => array(
                        'x' => -10.0,
                        'y' => 158.0,
                        'z' => 187.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canada - Alberta and British Columbia' => array(
                    'translationVectors' => array(
                        'x' => -7.0,
                        'y' => 162.0,
                        'z' => 188.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canada - East' => array(
                    'translationVectors' => array(
                        'x' => -22.0,
                        'y' => 160.0,
                        'z' => 190.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canada - Manitoba / Ontario' => array(
                    'translationVectors' => array(
                        'x' => -9.0,
                        'y' => 157.0,
                        'z' => 184.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canada - NW Territories and Saskatchewan' => array(
                    'translationVectors' => array(
                        'x' => 4.0,
                        'y' => 159.0,
                        'z' => 188.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canada - Yukon' => array(
                    'translationVectors' => array(
                        'x' => -7.0,
                        'y' => 139.0,
                        'z' => 181.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Canal Zone' => array(
                    'translationVectors' => array(
                        'x' => 0.0,
                        'y' => 125.0,
                        'z' => 201.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
                ),
                'Carribbean' => array(
                    'translationVectors' => array(
                        'x' => -3.0,
                        'y' => 143.0,
                        'z' => 183.0,
                    ),
                    'translationVectorsUOM' => Geodetic_Distance::METRES,
                    'rotationMatrix' => array(
                        'x' => 0.0,
                        'y' => 0.0,
                        'z' => 0.0,
                    ),
                    'rotationMatrixUOM' => Geodetic_Angle::ARCSECONDS,
                    'scaleFactor' => 0.0    //  ppm
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
