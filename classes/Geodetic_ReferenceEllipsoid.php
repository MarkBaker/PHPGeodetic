<?php

/**
 *  In geodesy, a reference ellipsoid is a mathematically-defined surface that approximates the geoid, the
 *  truer figure of the Earth. Because of their relative simplicity, reference ellipsoids are used as a
 *  preferred surface on which geodetic network computations are performed and point coordinates such as
 *  latitude, longitude, and elevation are defined.
 *
 *  The shape of an ellipsoid is determined by the shape parameters of that ellipse which generates the
 *  ellipsoid when it is rotated about its minor axis. The semi-major axis of the ellipse (a) is identified as
 *  the equatorial radius of the ellipsoid: the semi-minor axis of the ellipse (b) is identified with the
 *  polar distances (from the centre). These two lengths completely specify the shape of the ellipsoid but in
 *  practice geodesy publications classify reference ellipsoids by giving the semi-major axis and the inverse
 *  flattening (1/f). The flattening (f) is simply a measure of how much the symmetry axis is compressed
 *  relative to the equatorial radius.
 *
 *  Traditional reference ellipsoids are defined regionally and therefore non-geocentric.
 *
 *  -    http://en.wikipedia.org/wiki/Reference_ellipsoid
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_ReferenceEllipsoid
{
    const AIRY_1830                   = 'AIRY_1830';
    const AIRY_MODIFIED               = 'AIRY_MODIFIED';
    const MODIFIED_AIRY               = 'AIRY_MODIFIED';
    const AUSTRALIAN_1965             = 'AUSTRALIAN_1965';
    const BESSEL_1841                 = 'BESSEL_1841';
    const BESSEL_NAMIBIA_1841         = 'BESSEL_NAMIBIA_1841';
    const CLARKE_1866                 = 'CLARKE_1866';
    const CLARKE_1880                 = 'CLARKE_1880';
    const EVEREST_INDIA_1830          = 'EVEREST_INDIA_1830';
    const EVEREST_MALAYSIA_SINGAPORE  = 'EVEREST_MALAYSIA_SINGAPORE';
    const EVEREST_MALAYSIA_1969       = 'EVEREST_MALAYSIA_1969';
    const EVEREST_PAKISTAN            = 'EVEREST_PAKISTAN';
    const EVEREST_SABAH_SARAWAK       = 'EVEREST_SABAH_SARAWAK';
    const FISHER_1960                 = 'FISHER_1960';
    const FISHER_1968                 = 'FISHER_1968';
    const FISCHER_MODIFIED_1960       = 'FISCHER_MODIFIED_1960';
    const MODIFIED_FISCHER_1960       = 'FISCHER_MODIFIED_1960';
    const GRS_1980                    = 'GRS_80';
    const GRS_80                      = 'GRS_80';
    const HAYFORD_1909                = 'HAYFORD_1909';
    const HELMERT_1906                = 'HELMERT_1906';
    const HOUGH_1906                  = 'HOUGH_1906';
    const INDONESIAN_1974             = 'INDONESIAN_1974';
    const INTERNATIONAL_1924          = 'INTERNATIONAL_1924';
    const KRASOVSKY_1940              = 'KRASOVSKY_1940';
    const SGS_1985                    = 'SGS_1985';
    const SGS_85                      = 'SGS_1985';
    const SOUTH_AMERICAN_1969         = 'SOUTH_AMERICAN_1969';
    const WGS_1960                    = 'WGS_60';
    const WGS_60                      = 'WGS_60';
    const WGS_1966                    = 'WGS_66';
    const WGS_66                      = 'WGS_66';
    const WGS_1972                    = 'WGS_72';
    const WGS_72                      = 'WGS_72';
    const WGS_1984                    = 'WGS_84';
    const WGS_84                      = 'WGS_84';
    const IERS_1989                   = 'IERS_1989';
    const IERS_2003                   = 'IERS_2003';


    /**
     *  Values for all pre-defined Reference Ellipsoids
     *
     *  @access private
     *  @var    mixed[]
     */
    private static $_ellipsoidData = array(
        self::AIRY_1830 => array(
            'name'               => 'Airy (1830)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377563.396,
            'semiMinorAxis'      => 6356256.909,
            'inverseFlattening'  => 299.32496126649505
        ),
        self::AIRY_MODIFIED => array(
            'name'               => 'Airy Modified (1849)',
            'synonyms'           => 'MODIFIED_AIRY',
            'semiMajorAxis'      => 6377340.189,
            'semiMinorAxis'      => 6356034.448,
            'inverseFlattening'  => 299.32496546352854
        ),
        self::AUSTRALIAN_1965 => array(
            'name'               => 'Australian National (1965)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378160.0,
            'semiMinorAxis'      => 6356774.719,
            'inverseFlattening'  => 298.249997276158
        ),
        self::BESSEL_1841 => array(
            'name'               => 'Bessel (1841)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377397.155,
            'semiMinorAxis'      => 6356078.963,
            'inverseFlattening'  => 299.15281535132334
        ),
        self::BESSEL_NAMIBIA_1841 => array(
            'name'               => 'Bessel - Namibia (1841)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377483.865,
            'semiMinorAxis'      => 6356165.383,
            'inverseFlattening'  => 299.152813272542
        ),
        self::CLARKE_1866 => array(
            'name'               => 'Clarke (1866)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378206.4,
            'semiMinorAxis'      => 6356583.8,
            'inverseFlattening'  => 294.9786982138982
        ),
        self::CLARKE_1880 => array(
            'name'               => 'Clarke (1880)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378249.145,
            'semiMinorAxis'      => 6356514.87,
            'inverseFlattening'  => 293.4650060791153
        ),
        self::EVEREST_INDIA_1830 => array(
            'name'               => 'Everest - India (1830)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377276.345,
            'semiMinorAxis'      => 6356075.413,
            'inverseFlattening'  => 300.8016980102568
        ),
        self::EVEREST_MALAYSIA_SINGAPORE => array(
            'name'               => 'Everest - Malaysia and Singapore (1964)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377304.063,
            'semiMinorAxis'      => 6356103.039,
            'inverseFlattening'  => 300.8017000971244
        ),
        self::EVEREST_MALAYSIA_1969 => array(
            'name'               => 'Everest - Malaysia (1969)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377295.664,
            'semiMinorAxis'      => 6356094.668,
            'inverseFlattening'  => 300.8017012030905
        ),
        self::EVEREST_PAKISTAN => array(
            'name'               => 'Everest - Pakistan',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377309.613,
            'semiMinorAxis'      => 6356109.571,
            'inverseFlattening'  => 300.81589522323446
        ),
        self::EVEREST_SABAH_SARAWAK => array(
            'name'               => 'Everest - Sabah Sarawak',
            'synonyms'           => '',
            'semiMajorAxis'      => 6377298.556,
            'semiMinorAxis'      => 6356097.550,
            'inverseFlattening'  => 300.801700
        ),
        self::FISHER_1960 => array(
            'name'               => 'Fisher (1960)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378155.0,
            'semiMinorAxis'      => 6356773.32,
            'inverseFlattening'  => 298.2999932652668
        ),
        self::FISCHER_MODIFIED_1960 => array(
            'name'               => 'Fischer Modified (1960)',
            'synonyms'           => 'MODIFIED_FISCHER_1960',
            'semiMajorAxis'      => 6378155.000,
            'semiMinorAxis'      => 6356773.320,
            'inverseFlattening'  => 298.300000
        ),
        self::FISHER_1968 => array(
            'name'               => 'Fisher (1968)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378150.000,
            'semiMinorAxis'      => 6356768.337,
            'inverseFlattening'  => 298.300000
        ),
        self::GRS_80 => array(
            'name'               => 'Geodetic Reference System (1980)',
            'synonyms'           => 'GRS_1980',
            'semiMajorAxis'      => 6378137.0,
            'semiMinorAxis'      => 6356752.3141,
            'inverseFlattening'  => 298.2572215381486
        ),
        self::HAYFORD_1909 => array(
            'name'               => 'Hayford (1909)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378388.0,
            'semiMinorAxis'      => 6356911.946,
            'inverseFlattening'  => 296.9999982305938
        ),
        self::HELMERT_1906 => array(
            'name'               => 'Helmert (1906)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378200.0,
            'semiMinorAxis'      => 6356818.17,
            'inverseFlattening'  => 298.3000051913226
        ),
        self::HOUGH_1906 => array(
            'name'               => 'Hough (1906)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378270.0,
            'semiMinorAxis'      => 6356794.343,
            'inverseFlattening'  => 296.99999399320365
        ),
        self::INDONESIAN_1974 => array(
            'name'               => 'Indonesian (1974)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378160.0,
            'semiMinorAxis'      => 6356774.504,
            'inverseFlattening'  => 298.2469988070381
        ),
        self::INTERNATIONAL_1924 => array(
            'name'               => 'International (1924)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378388.0,
            'semiMinorAxis'      => 6356911.946,
            'inverseFlattening'  => 296.9999982305938
        ),
        self::KRASOVSKY_1940 => array(
            'name'               => 'Krasovsky (1940)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378245.0,
            'semiMinorAxis'      => 6356863.019,
            'inverseFlattening'  => 298.30000316622187
        ),
        self::SGS_1985          => array(
            'name'               => 'Soviet Geodetic System (1985)',
            'synonyms'           => 'SGS_85',
            'semiMajorAxis'      => 6378136.000,
            'semiMinorAxis'      => 6356751.302,
            'inverseFlattening'  => 298.257000
        ),
        self::SOUTH_AMERICAN_1969 => array(
            'name'               => 'South American (1969)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378160.0,
            'semiMinorAxis'      => 6356774.719,
            'inverseFlattening'  => 298.249997276158
        ),
        self::WGS_60 => array(
            'name'               => 'World Geodetic System (1960)',
            'synonyms'           => 'WGS_1960',
            'semiMajorAxis'      => 6378165.000,
            'semiMinorAxis'      => 6356783.287,
            'inverseFlattening'  => 298.300000
        ),
        self::WGS_66 => array(
            'name'               => 'World Geodetic System (1966)',
            'synonyms'           => 'WGS_1966',
            'semiMajorAxis'      => 6378145.000,
            'semiMinorAxis'      => 6356759.769,
            'inverseFlattening'  => 298.250000
        ),
        self::WGS_72 => array(
            'name'               => 'World Geodetic System (1972)',
            'synonyms'           => 'WGS_1972',
            'semiMajorAxis'      => 6378135.0,
            'semiMinorAxis'      => 6356750.52,
            'inverseFlattening'  => 298.2599997755319
        ),
        self::WGS_84 => array(
            'name'               => 'World Geodetic System (1984)',
            'synonyms'           => 'WGS_1984',
            'semiMajorAxis'      => 6378137.0,
            'semiMinorAxis'      => 6356752.3142,
            'inverseFlattening'  => 298.2572229328697
        ),
        self::IERS_1989 => array(
            'name'               => 'International Earth Rotation and Reference Systems Service (1989)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378136,
            'semiMinorAxis'      => 6356751.302,
            'inverseFlattening'  => 298.257
        ),
        self::IERS_2003 => array(
            'name'               => 'International Earth Rotation and Reference Systems Service (2003)',
            'synonyms'           => '',
            'semiMajorAxis'      => 6378136.6,
            'semiMinorAxis'      => 6356751.9,
            'inverseFlattening'  => 298.25642
        ),
    );


    protected $_dirty = TRUE;

    protected $_ellipsoidReference;
    protected $_ellipsoidName;

    protected $_semiMajorAxis;

    protected $_semiMinorAxis;
    protected $_inverseFlattening;

    protected $_firstEccentricitySquared;
    protected $_secondEccentricitySquared;


    private static function _sinSquared($xValue) {
        return sin($xValue) * sin($xValue);
    }

    /**
     *  Calculate the secondary properties for this Reference Ellipsoid object
     *  We calculate the Semi-Minor (Polar) Axis if it han't been provided,
     *      using the Semi-Major (Equatorial) Axis and the Inverse Flattening values
     *  We calculate the Inverse Flattening if it han't been provided,
     *      using the Semi-Major (Equatorial) and the Semi-Minor (Polar) Axis values
     *  We also calculate the First and Second Eccentricity Squared values
     *
     *  @access    private
     *  @return    void
     *  @throws    Geodetic_Exception
     */
    private function _calculateDerivedParameters()
    {
        if ($this->_semiMajorAxis->getValue() === 0.0)
            throw new Geodetic_Exception('Semi-Major (Equatorial) Axis is not set');

        if ($this->_semiMinorAxis->getValue() === 0.0) {
            if ($this->_inverseFlattening === 0.0) {
                throw new Geodetic_Exception('Neither Semi-Minor (Polar) Axis nor Inverse Flattening is set');
            }
            $this->_semiMinorAxis->setValue($this->_semiMajorAxis->getValue() * (1 - (1 / $this->_inverseFlattening)));
        } elseif ($this->_inverseFlattening === 0.0) {
            $this->_inverseFlattening = $this->_semiMajorAxis->getValue() /
                                        ($this->_semiMajorAxis->getValue() - $this->_semiMinorAxis->getValue());
        }

        $this->_firstEccentricitySquared = (($this->_semiMajorAxis->getValue() * $this->_semiMajorAxis->getValue()) -
                                            ($this->_semiMinorAxis->getValue() * $this->_semiMinorAxis->getValue())) /
                                           ($this->_semiMajorAxis->getValue() * $this->_semiMajorAxis->getValue());
        $this->_secondEccentricitySquared = (($this->_semiMajorAxis->getValue() * $this->_semiMajorAxis->getValue()) -
                                             ($this->_semiMinorAxis->getValue() * $this->_semiMinorAxis->getValue())) /
                                            ($this->_semiMinorAxis->getValue() * $this->_semiMinorAxis->getValue());

        $this->_dirty = FALSE;
    }   //  private function _calculateDerivedParameters()


    /**
     *  Create a new Reference Ellipsoid object
     *
     *  @param     string    $ellipsoid    The name of the ellipsoid to use
     *  @return    void
     *  @throws    Geodetic_Exception
     */
    function __construct($ellipsoid = Geodetic_ReferenceEllipsoid::WGS_1984)
    {
        if (!is_null($ellipsoid))
            $this->setEllipsoid($ellipsoid);
    }   // function __construct()


    /**
     *  Get the internal reference name of the Reference Ellipsoid used for this object
     *
     *  @return    string    The name of this ellipsoid
     */
    public function getEllipsoidReference()
    {
        return $this->_ellipsoidReference;
    }   //  getEllipsoidName()

    /**
     *  Get the descriptive name of the Reference Ellipsoid used for this object
     *
     *  @return    string    The name of this ellipsoid
     */
    public function getEllipsoidName()
    {
        return $this->_ellipsoidName;
    }   //  getEllipsoidName()

    /**
     * Validate an Ellipsoid Name or synonym
     *
     * @param    string    $ellipsoid    The name of the ellipsoid to validate, or a synonym for that name
     * @return   string    The actual name used internally for the requested ellipsoid
     * @throws   Geodetic_Exception
     */
    private static function _isValidEllipsoid($ellipsoid) {
        if (is_null($ellipsoid))
            throw new Geodetic_Exception('An Ellipsoid name must be specified');

        if (!isset(self::$_ellipsoidData[$ellipsoid])) {
            if (defined('self::'.$ellipsoid)) {
                $ellipsoid = constant('self::'.$ellipsoid);
                if (!isset(self::$_ellipsoidData[$ellipsoid])) {
                    throw new Geodetic_Exception('"'.$ellipsoid.'" is not a valid ellipsoid');
                }
            } else {
                throw new Geodetic_Exception('"'.$ellipsoid.'" is not a valid ellipsoid');
            }
        }

        return $ellipsoid;
    }

    /**
     *  Set the Data for this Reference Ellipsoid object
     *
     *  @param     string    $ellipsoidName    The name of the ellipsoid to use
     *  @return    Geodetic_ReferenceEllipsoid
     *  @throws    Geodetic_Exception
     */
    public function setEllipsoid($ellipsoidName = NULL)
    {
        $ellipsoidName = self::_isValidEllipsoid($ellipsoidName);

        $this->_semiMajorAxis = new Geodetic_Distance();
        $this->_semiMinorAxis = new Geodetic_Distance();
        $this->_ellipsoidReference = $ellipsoidName;
        $this->_ellipsoidName = self::$_ellipsoidData[$ellipsoidName]['name'];

        //    All pre-configured Ellipsoid dimensions are already defined in meters,
        //        so we don't need to do any UOM conversions here
        $this->_semiMajorAxis->setValue(self::$_ellipsoidData[$ellipsoidName]['semiMajorAxis']);
        $this->_semiMinorAxis->setValue(
            isset(self::$_ellipsoidData[$ellipsoidName]['semiMinorAxis']) ?
                self::$_ellipsoidData[$ellipsoidName]['semiMinorAxis'] :
                0.0
            );
        $this->_inverseFlattening = isset(self::$_ellipsoidData[$ellipsoidName]['inverseFlattening']) ?
            self::$_ellipsoidData[$ellipsoidName]['inverseFlattening'] :
            0.0;

        $this->_calculateDerivedParameters();

        return $this;
    }   //  public function setEllipsoid()

    /**
     *  Set the Semi-Major (Equatorial) Axis for this Reference Ellipsoid object
     *
     *  @param     integer|float    $semiMajorAxis    Length of the Semi-Major (Equatorial) Axis
     *                                                    to use for this ellipsoid
     *  @param     string           $uom              Unit of Measure for this axis length
     *  @throws    Geodetic_Exception
     */
    public function setSemiMajorAxis($semiMajorAxis = NULL,
                                     $uom = Geodetic_Distance::METRES)
    {
        if (is_null($semiMajorAxis))
            throw new Geodetic_Exception('Missing Semi-Major (Equatorial) Axis value');

        if (!is_numeric($semiMajorAxis))
            throw new Geodetic_Exception('Semi-Major (Equatorial) Axis is not a numeric value');

        $this->_semiMajorAxis->setValue($semiMajorAxis, $uom);
        $this->_dirty = TRUE;

        return $this;
    }

    /**
     *  Get the Semi-Major (Equatorial) Axis for this Reference Ellipsoid object
     *
     *  @param     string    $uom    Unit of Measure for the returned value
     *  @return    float     Length of the Semi-Major (Equatorial) Axis for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getSemiMajorAxis($uom = Geodetic_Distance::METRES)
    {
        return $this->_semiMajorAxis->getValue($uom);
    }

    /**
     *  Set the Semi-Minor (Polar) Axis for this Reference Ellipsoid object
     *  This will nullify the Inverse Flattening,
     *      and force a recalculation from the Semi-Major (Equatorial) axis and the Semi-Minor (Polar) Axis
     *
     *  @param     integer|float    $semiMinorAxis   Length of the Semi-Minor (Polar) Axis
     *                                                   to use for this ellipsoid
     *  @param     string           $uom             Unit of Measure for this axis length
     *  @throws    Geodetic_Exception
     */
    public function setSemiMinorAxis($semiMinorAxis = NULL,
                                     $uom = Geodetic_Distance::METRES)
    {
        if (is_null($semiMinorAxis))
            throw new Geodetic_Exception('Missing Semi-Minor (Polar) Axis value');

        if (!is_numeric($semiMinorAxis))
            throw new Geodetic_Exception('Semi-Minor (Polar) Axis is not a numeric value');

        $this->_semiMinorAxis->setValue($semiMinorAxis, $uom);
        $this->_inverseFlattening = NULL;
        $this->_dirty = TRUE;

        return $this;
    }

    /**
     *  Get the Semi-Minor (Polar) Axis for this Reference Ellipsoid object
     *
     *  @param     string    $uom    Unit of Measure for the returned value
     *  @return    float     Length of the Semi-Minor (Polar) Axis for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getSemiMinorAxis($uom = Geodetic_Distance::METRES)
    {
        return $this->_semiMinorAxis->getValue($uom);
    }

    /**
     *  Set the Inverse Flattening for this Reference Ellipsoid object
     *  This will nullify the Semi-Minor (Polar) Axis,
     *      and force a recalculation from the Semi-Major (Equatorial) axis and the specified flattening
     *
     *  @param     integer|float    $inverseFlattening    Inverse Flattening to use for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function setInverseFlattening($inverseFlattening = NULL)
    {
        if (is_null($inverseFlattening))
            throw new Geodetic_Exception('Missing Inverse Flattening value');

        if (!is_numeric($inverseFlattening))
            throw new Geodetic_Exception('Inverse Flattening is not a numeric value');

        $this->_inverseFlattening = (float) $inverseFlattening;
        $this->_semiMinorAxis->setValue();
        $this->_dirty = TRUE;

        return $this;
    }

    /**
     *  Get the Inverse Flattening for this Reference Ellipsoid object
     *
     *  @return    float    Inverse Flattening for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getInverseFlattening()
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return $this->_inverseFlattening;
    }

    /**
     *  Set the Flattening for this Reference Ellipsoid object
     *  This will nullify the Semi-Minor (Polar) Axis,
     *      and force a recalculation from the Semi-Major (Equatorial) axis and the specified flattening
     *
     *  @param     integer|float    $flattening    Flattening to use for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function setFlattening($flattening = NULL)
    {
        if (is_null($flattening))
            throw new Geodetic_Exception('Missing Flattening value');

        if (!is_numeric($flattening))
            throw new Geodetic_Exception('Flattening is not a numeric value');

        $this->_inverseFlattening = (float) 1 / $flattening;
        $this->_semiMinorAxis->setValue();
        $this->_dirty = TRUE;

        return $this;
    }

    /**
     *  Get the Flattening for this Reference Ellipsoid object
     *
     *  @return    float    Flattening for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getFlattening()
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return 1 / $this->_inverseFlattening;
    }

    /**
     *  Get the First Eccentricity for this Reference Ellipsoid object
     *
     *  @return    float    First Eccentricity for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getFirstEccentricity()
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return sqrt($this->_firstEccentricitySquared);
    }

    /**
     *  Get the First Eccentricity Squared for this Reference Ellipsoid object
     *
     *  @return    float    First Eccentricity Squared for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getFirstEccentricitySquared()
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return $this->_firstEccentricitySquared;
    }

    /**
     *  Get the Second Eccentricity for this Reference Ellipsoid object
     *
     *  @return    float    Second Eccentricity for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getSecondEccentricity()
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return sqrt($this->_secondEccentricitySquared);
    }

    /**
     *  Get the Second Eccentricity Squared for this Reference Ellipsoid object
     *
     *  @return    float    Second Eccentricity Squared for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getSecondEccentricitySquared()
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return $this->_secondEccentricitySquared;
    }

    /**
     *  Get the Mean Radius this Reference Ellipsoid object
     *
     *  @param     string    $uom    Unit of Measure for the returned value
     *  @return    float     Mean Radius for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getMeanRadius($uom = Geodetic_Distance::METRES)
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return Geodetic_Distance::convertFromMeters(
            (2 * $this->_semiMajorAxis->getValue() + $this->_semiMinorAxis->getValue()) / 3,
            $uom
        );
    }

    /**
     *  Get the Authalic Radius this Reference Ellipsoid object
     *
     *  The authalic ("equal area") radius is the radius of a hypothetical perfect sphere which has the same surface area
     *      as the reference ellipsoid.
     *
     *  @param     string    $uom    Unit of Measure for the returned value
     *  @return    float     Authalic Radius for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getAuthalicRadius($uom = Geodetic_Distance::METRES)
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        $semiMajorSquared = $this->_semiMajorAxis->getValue() * $this->_semiMajorAxis->getValue();
        $semiMinorSquared = $this->_semiMinorAxis->getValue() * $this->_semiMinorAxis->getValue();

        return Geodetic_Distance::convertFromMeters(
            sqrt(
                ($semiMajorSquared +
                 (($this->_semiMajorAxis->getValue() * $semiMinorSquared) / sqrt($semiMajorSquared - $semiMinorSquared)) *
                 log(
                    ($this->_semiMajorAxis->getValue() + sqrt($semiMajorSquared - $semiMinorSquared)) /
                     $this->_semiMinorAxis->getValue()
                 )
                ) / 2
            ),
            $uom
        );
    }

    /**
     *  Get the Volumetric Radius this Reference Ellipsoid object
     *
     *  This is the radius of a sphere of equal volume to the ellipsoid
     *
     *  @param     string    $uom    Unit of Measure for the returned value
     *  @return    float     Volumetric Radius for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getVolumetricRadius($uom = Geodetic_Distance::METRES)
    {
        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        return Geodetic_Distance::convertFromMeters(
            pow(
                $this->_semiMajorAxis->getValue() * $this->_semiMajorAxis->getValue() *
                    $this->_semiMinorAxis->getValue(),
                1/3
            ),
            $uom
        );
    }

    /**
     *  Get the Radius of Curvature along the Meridian at a specified latitude
     *      for this Reference Ellipsoid object
     *
     *  The formula used here is from http://www.epsg.org/guides/docs/G7-2.pdf
     *
     *  @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature,
     *                                               positive when to the north of the equator, negative when to the south
     *  @param     string           $degRad      Indicating whether the Angle of Latitude is being specified
     *                                               in degrees or radians
     *  @param     string           $uom         Unit of Measure for the returned value
     *  @return    float            The Radius of Curvature along the Meridian
     *                                  at the specified latitude for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getRadiusOfCurvatureMeridian($latitude = NULL,
                                                 $degrad = Geodetic_Angle::DEGREES,
                                                 $uom = Geodetic_Distance::METRES)
    {
        $latitude = Geodetic_LatLong::validateLatitude($latitude, $degrad);

        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        $radius = ($this->_semiMajorAxis->getValue() * (1 - $this->_firstEccentricitySquared)) /
                  pow(1 - $this->_firstEccentricitySquared * self::_sinSquared($latitude), 1.5);

        return Geodetic_Distance::convertFromMeters($radius, $uom);
    }

    /**
     *  Get the Radius of Curvature along the Prime Vertical at a specified latitude
     *      for this Reference Ellipsoid object
     *
     *  The formula used here is from http://www.epsg.org/guides/docs/G7-2.pdf
     *
     *  @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature,
     *                                               positive when to the north of the equator, negative when to the south
     *  @param     string           $degRad      Indicating whether the Angle of Latitude is being specified
     *                                               in degrees or radians
     *  @param     string           $uom         Unit of Measure for the returned value
     *  @return    float            The Radius of Curvature along the Prime Vertical at the specified latitude
     *                                  for this ellipsoid
     *  @throws    Geodetic_Exception
     */
    public function getRadiusOfCurvaturePrimeVertical($latitude = NULL,
                                                      $degrad = Geodetic_Angle::DEGREES,
                                                      $uom = Geodetic_Distance::METRES)
    {
        $latitude = Geodetic_LatLong::validateLatitude($latitude, $degrad);

        if ($this->_dirty)
            $this->_calculateDerivedParameters();

        $radius = $this->_semiMajorAxis->getValue() /
                   pow(1 - $this->_firstEccentricitySquared * self::_sinSquared($latitude), 0.5);

        return Geodetic_Distance::convertFromMeters($radius, $uom);
    }

    /**
     *  Get a list of the supported Reference Ellipsoid names
     *
     *  @return    string[]    An array listing the permitted Reference Ellipsoid names
     *                         The array value is the descriptive name that can be passed to the constructor,
     *                             or to the setEllipsoid() method, while the key is an internal constant value
     *                             for that ellipsoid.
     */
    public static function getEllipsoidNames()
    {
        return array_combine(
            array_keys(
                self::$_ellipsoidData
            ),
            array_map(
                function ($ellipsoidData) {
                    return $ellipsoidData['name'];
                },
                self::$_ellipsoidData
            )
        );
    }

}
