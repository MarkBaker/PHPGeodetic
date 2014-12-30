<?php

namespace Geodetic;

/**
 *  In geodesy, a reference ellipsoid is a mathematically-defined surface that approximates the geoid, the
 *      truer figure of the Earth. Because of their relative simplicity, reference ellipsoids are used as a
 *      preferred surface on which geodetic network computations are performed and point coordinates such as
 *      latitude, longitude, and elevation are defined.
 *
 *  The shape of an ellipsoid is determined by the shape parameters of that ellipse which generates the
 *      ellipsoid when it is rotated about its minor axis. The semi-major axis of the ellipse (a) is identified
 *      as the equatorial radius of the ellipsoid: the semi-minor axis of the ellipse (b) is identified with the
 *      polar distances (from the centre). These two lengths completely specify the shape of the ellipsoid but in
 *      practice geodesy publications classify reference ellipsoids by giving the semi-major axis and the inverse
 *      flattening (1/f). The flattening (f) is simply a measure of how much the symmetry axis is compressed
 *      relative to the equatorial radius.
 *
 *  Traditional reference ellipsoids are defined regionally and therefore non-geocentric.
 *
 *      -    http://en.wikipedia.org/wiki/Reference_ellipsoid
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class ReferenceEllipsoid
{
    const AIRY_1830                         = 'AIRY_1830';
    const AIRY_MODIFIED                     = 'AIRY_MODIFIED';
    const AIRY_MODIFIED_1849                = 'AIRY_MODIFIED_1849';
    const MODIFIED_AIRY                     = 'AIRY_MODIFIED';
    const ANS                               = 'AUSTRALIAN_1965';
    const ATS_1977                          = 'ATS_1977';
    const AUSTRALIAN_1965                   = 'AUSTRALIAN_1965';
    const AUSTRALIAN_NATIONAL_SPHEROID      = 'AUSTRALIAN_1965';
    const AUTHALIC_SPHERE                   = 'AUTHALIC_SPHERE';
    const AVERAGE_TERRESTRIAL_SYSTEM_1977   = 'ATS_1977';
    const BESSEL_1841                       = 'BESSEL_1841';
    const BESSEL_MODIFIED                   = 'BESSEL_MODIFIED';
    const MODIFIED_BESSEL                   = 'BESSEL_MODIFIED';
    const BESSEL_1841_NAMIBIA               = 'BESSEL_1841_NAMIBIA';
    const BESSEL_NAMIBIA_GLM                = 'BESSEL_NAMIBIA_GLM';
    const CGCS_2000                         = 'CGCS_2000';
    const CLARKE_1858                       = 'CLARKE_1858';
    const CLARKE_1866                       = 'CLARKE_1866';
    const CLARKE_1866_AUTHALIC_SPHERE       = 'CLARKE_1866_AUTHALIC_SPHERE';
    const CLARKE_1866_MICHIGAN              = 'CLARKE_1866_MICHIGAN';
    const CLARKE_1880                       = 'CLARKE_1880';
    const CLARKE_MODIFIED_1880              = 'CLARKE_1880_RGS';
    const CLARKE_1880_MODIFIED_SOUTH_AFRICA = 'CLARKE_1880_ARC';
    const CLARKE_1880_ARC                   = 'CLARKE_1880_ARC';
    const CLARKE_1880_BENOIT                = 'CLARKE_1880_BENOIT';
    const CLARKE_1880_CAPE                  = 'CLARKE_1880_ARC';
    const CLARKE_1880_IGN                   = 'CLARKE_1880_IGN';
    const CLARKE_1880_INTERNATIONAL_FOOT    = 'CLARKE_1880_INTERNATIONAL_FOOT';
    const CLARKE_1880_RGS                   = 'CLARKE_1880_RGS';
    const CLARKE_1880_SGA_1922              = 'CLARKE_1880_SGA_1922';
    const DANISH_1876                       = 'DANISH_1876';
    const EVEREST_1830                      = 'EVEREST_1830';
    const EVEREST_MODIFIED                  = 'EVEREST_MODIFIED';
    const EVEREST_1830_ADJUSTMENT_1937      = 'EVEREST_1830_ADJUSTMENT_1937';
    const EVEREST_1830_ADJUSTMENT_1962      = 'EVEREST_1830_ADJUSTMENT_1962';
    const EVEREST_1830_ADJUSTMENT_1967      = 'EVEREST_1830_ADJUSTMENT_1967';
    const EVEREST_1830_ADJUSTMENT_1975      = 'EVEREST_1830_ADJUSTMENT_1975';
    const EVEREST_1830_RSO_1969             = 'EVEREST_1830_RSO_1969';
    const FISHER_1960                       = 'FISHER_1960';
    const FISHER_1968                       = 'FISHER_1968';
    const FISCHER_MODIFIED                  = 'FISCHER_MODIFIED';
    const MODIFIED_FISCHER                  = 'FISCHER_MODIFIED';
    const GEM_10C                           = 'GEM_10C';
    const GRS_1967                          = 'GRS_67';
    const GRS_67                            = 'GRS_67';
    const GRS_MODIFIED_1967                 = 'GRS_MODIFIED_67';
    const GRS_MODIFIED_67                   = 'GRS_MODIFIED_67';
    const GRS_1967_MODIFIED                 = 'GRS_MODIFIED_67';
    const GRS_67_MODIFIED                   = 'GRS_MODIFIED_67';
    const GRS_1980                          = 'GRS_80';
    const GRS_80                            = 'GRS_80';
    const HAYFORD_1909                      = 'INTERNATIONAL_1924';
    const HD_1909                           = 'CGCS_2000';
    const HELMERT_1906                      = 'HELMERT_1906';
    const HOUGH_1906                        = 'HOUGH_1906';
    const HUGHES_1980                       = 'HUGHES_1980';
    const IAG_1975                          = 'IAG_1975';
    const INDONESIAN_1974                   = 'INDONESIAN_1974';
    const INTERNATIONAL_1924                = 'INTERNATIONAL_1924';
    const INTERNATIONAL_1924_AUTHALIC       = 'INTERNATIONAL_1924_AUTHALIC';
    const INTERNATIONAL_1967                = 'GRS_1967';
    const INTERNATIONAL_1979                = 'GRS_1980';
    const KRASSOWSKY_1940                   = 'KRASSOWSKY_1940';
    const MCCAW_1924                        = 'WAR_OFFICE';
    const NWL_9D                            = 'NWL_9D';
    const NWL_10D                           = 'WGS_72';
    const OSU_86F                           = 'OSU_86F';
    const OSU_91A                           = 'OSU_91A';
    const PLESSIS_1817                      = 'PLESSIS_1817';
    const POPULAR_VISUALISATION_SPHERE      = 'POPULAR_VISUALISATION_SPHERE';
    const PZ_90                             = 'PZ_90';
    const STRUVE_1860                       = 'STRUVE_1860';
    const WAR_OFFICE                        = 'WAR_OFFICE';
    const WGS_1960                          = 'WGS_60';
    const WGS_60                            = 'WGS_60';
    const WGS_1966                          = 'WGS_66';
    const WGS_66                            = 'WGS_66';
    const WGS_1972                          = 'WGS_72';
    const WGS_72                            = 'WGS_72';
    const WGS_1984                          = 'WGS_84';
    const WGS_84                            = 'WGS_84';
    const IERS_1989                         = 'IERS_1989';
    const IERS_2003                         = 'IERS_2003';


    /**
     * Values for all pre-defined Reference Ellipsoids
     *
     * @access private
     * @var    mixed[]
     */
    private static $ellipsoidData = array(
        self::AIRY_1830 => array(
            'name'               => 'Airy (1830)',
            'synonyms'           => '',
            'epsg_id'            => '7001',
            'semiMajorAxis'      => 6377563.396,
            'inverseFlattening'  => 299.3249646
        ),
        self::AIRY_MODIFIED => array(
            'name'               => 'Airy Modified (1849)',
            'synonyms'           => 'MODIFIED_AIRY,AIRY_MODIFIED_1849',
            'epsg_id'            => '7002',
            'semiMajorAxis'      => 6377340.189,
            'inverseFlattening'  => 299.3249646
        ),
        self::ATS_1977 => array(
            'name'               => 'Average Terrestrial System (1977)',
            'synonyms'           => 'AVERAGE_TERRESTRIAL_SYSTEM_1977',
            'epsg_id'            => '7041',
            'semiMajorAxis'      => 6378135.0,
            'inverseFlattening'  => 298.257
        ),
        self::AUSTRALIAN_1965 => array(
            'name'               => 'Australian National Spheroid (1965)',
            'synonyms'           => 'ANS,AUSTRALIAN_NATIONAL_SPHEROID',
            'epsg_id'            => '7003',
            'semiMajorAxis'      => 6378160.0,
            'inverseFlattening'  => 298.25
        ),
        self::AUTHALIC_SPHERE => array(
            'name'               => 'Authalic Sphere',
            'synonyms'           => '',
            'epsg_id'            => '7035',
            'semiMajorAxis'      => 6371000.0,
            'semiMinorAxis'      => 6371000.0
        ),
        self::BESSEL_1841 => array(
            'name'               => 'Bessel (1841)',
            'synonyms'           => '',
            'epsg_id'            => '7004',
            'semiMajorAxis'      => 6377397.155,
            'inverseFlattening'  => 299.1528128
        ),
        self::BESSEL_MODIFIED => array(
            'name'               => 'Bessel Modified',
            'synonyms'           => 'MODIFIED_BESSEL',
            'epsg_id'            => '7005',
            'semiMajorAxis'      => 6377492.018,
            'inverseFlattening'  => 299.1528128
        ),
        self::BESSEL_1841_NAMIBIA => array(
            'name'               => 'Bessel (1841) - Namibia',
            'synonyms'           => '',
            'epsg_id'            => '7006',
            'semiMajorAxis'      => 6377483.865,
            'inverseFlattening'  => 299.1528128
        ),
        self::BESSEL_NAMIBIA_GLM => array(
            'name'               => 'Bessel - Namibia GLM',
            'synonyms'           => '',
            'epsg_id'            => '7046',
            'semiMajorAxis'      => 6377483.865280419,
            'inverseFlattening'  => 299.1528128
        ),
        self::CGCS_2000 => array(
            'name'               => 'CGCS 2000',
            'synonyms'           => 'HD_1909',
            'epsg_id'            => '1024',
            'semiMajorAxis'      => 6378137.0,
            'inverseFlattening'  => 298.257222101
        ),
        self::CLARKE_1858 => array(
            'name'               => 'Clarke (1858)',
            'synonyms'           => '',
            'epsg_id'            => '7007',
            'semiMajorAxis'      => 6378293.645208759,
            'semiMinorAxis'      => 6356617.987679838
        ),
        self::CLARKE_1866 => array(
            'name'               => 'Clarke (1866)',
            'synonyms'           => '',
            'epsg_id'            => '7008',
            'semiMajorAxis'      => 6378206.4,
            'semiMinorAxis'      => 6356583.8
        ),
        self::CLARKE_1866_AUTHALIC_SPHERE => array(
            'name'               => 'Clarke (1866) Authalic Sphere',
            'synonyms'           => '',
            'epsg_id'            => '7052',
            'semiMajorAxis'      => 6370997.0,
            'semiMinorAxis'      => 6370997.0
        ),
        self::CLARKE_1866_MICHIGAN => array(
            'name'               => 'Clarke (1866) - Michigan',
            'synonyms'           => '',
            'epsg_id'            => '7009',
            'semiMajorAxis'      => 6378450.047548895,
            'semiMinorAxis'      => 6356826.621488444
        ),
        self::CLARKE_1880 => array(
            'name'               => 'Clarke (1880)',
            'synonyms'           => '',
            'epsg_id'            => '7034',
            'semiMajorAxis'      => 6378249.144808011,
            'semiMinorAxis'      => 6356514.966204134
        ),
        self::CLARKE_1880_ARC => array(
            'name'               => 'Clarke (1880) - Arc',
            'synonyms'           => 'CLARKE_1880_CAPE,CLARKE_1880_MODIFIED_SOUTH_AFRICA',
            'epsg_id'            => '7013',
            'semiMajorAxis'      => 6378249.145,
            'inverseFlattening'  => 293.4663077
        ),
        self::CLARKE_1880_BENOIT => array(
            'name'               => 'Clarke (1880) - Benoit',
            'synonyms'           => '',
            'epsg_id'            => '7010',
            'semiMajorAxis'      => 6378300.789,
            'semiMinorAxis'      => 6356566.435
        ),
        self::CLARKE_1880_IGN => array(
            'name'               => 'Clarke (1880) - IGN',
            'synonyms'           => '',
            'epsg_id'            => '7011',
            'semiMajorAxis'      => 6378249.2,
            'semiMinorAxis'      => 6356515.0
        ),
        self::CLARKE_1880_INTERNATIONAL_FOOT => array(
            'name'               => 'Clarke (1880) - International Foot',
            'synonyms'           => '',
            'epsg_id'            => '7055',
            'semiMajorAxis'      => 6378306.3696,
            'semiMinorAxis'      => 6356571.996
        ),
        self::CLARKE_1880_RGS => array(
            'name'               => 'Clarke (1880) - RGS',
            'synonyms'           => 'CLARKE_MODIFIED_1880',
            'epsg_id'            => '7012',
            'semiMajorAxis'      => 6378249.145,
            'inverseFlattening'  => 293.465
        ),
        self::CLARKE_1880_SGA_1922 => array(
            'name'               => 'Clarke (1880) - SGA 1922',
            'synonyms'           => '',
            'epsg_id'            => '7014',
            'semiMajorAxis'      => 6378249.2,
            'inverseFlattening'  => 293.46598
        ),
        self::DANISH_1876 => array(
            'name'               => 'Danish (1876)',
            'synonyms'           => '',
            'epsg_id'            => '7051',
            'semiMajorAxis'      => 6377019.27,
            'inverseFlattening'  => 300.0
        ),
        self::EVEREST_1830 => array(
            'name'               => 'Everest (1830)',
            'synonyms'           => '',
            'epsg_id'            => '7042',
            'semiMajorAxis'      => 6377299.36559538,
            'semiMinorAxis'      => 6356098.359005156
        ),
        self::EVEREST_MODIFIED => array(
            'name'               => 'Everest Modified (1830)',
            'synonyms'           => 'MODIFIED_EVEREST',
            'epsg_id'            => '7018',
            'semiMajorAxis'      => 6377304.063,
            'inverseFlattening'  => 300.8017
        ),
        self::EVEREST_1830_ADJUSTMENT_1937 => array(
            'name'               => 'Everest (1830) - 1937 Adjustment',
            'synonyms'           => '',
            'epsg_id'            => '7015',
            'semiMajorAxis'      => 6377276.345,
            'inverseFlattening'  => 300.8017
        ),
        self::EVEREST_1830_ADJUSTMENT_1962 => array(
            'name'               => 'Everest (1830) - 1962 Adjustment',
            'synonyms'           => '',
            'epsg_id'            => '7044',
            'semiMajorAxis'      => 6377301.243,
            'inverseFlattening'  => 300.8017255
        ),
        self::EVEREST_1830_ADJUSTMENT_1967 => array(
            'name'               => 'Everest (1830) - 1967 Adjustment',
            'synonyms'           => '',
            'epsg_id'            => '7016',
            'semiMajorAxis'      => 6377298.556,
            'inverseFlattening'  => 300.8017
        ),
        self::EVEREST_1830_ADJUSTMENT_1975 => array(
            'name'               => 'Everest (1830) - 1975 Adjustment',
            'synonyms'           => '',
            'epsg_id'            => '7045',
            'semiMajorAxis'      => 6377299.151,
            'inverseFlattening'  => 300.8017255
        ),
        self::EVEREST_1830_RSO_1969 => array(
            'name'               => 'Everest (1830) - RSO 1969',
            'synonyms'           => '',
            'epsg_id'            => '7056',
            'semiMajorAxis'      => 6377295.664,
            'inverseFlattening'  => 300.8017
        ),
        self::FISHER_1960 => array(
            'name'               => 'Fisher (1960)',
            'synonyms'           => '',
            'epsg_id'            => '50002',
            'semiMajorAxis'      => 6378166.0,
            'inverseFlattening'  => 298.3
        ),
        self::FISCHER_MODIFIED => array(
            'name'               => 'Fischer Modified (1960)',
            'synonyms'           => 'MODIFIED_FISCHER',
            'epsg_id'            => '50001',
            'semiMajorAxis'      => 6378155.0,
            'inverseFlattening'  => 298.3
        ),
        self::FISHER_1968 => array(
            'name'               => 'Fisher (1968)',
            'synonyms'           => '',
            'epsg_id'            => '50003',
            'semiMajorAxis'      => 6378150.0,
            'inverseFlattening'  => 298.3
        ),
        self::GEM_10C => array(
            'name'               => 'GEM 10C',
            'synonyms'           => '',
            'epsg_id'            => '7031',
            'semiMajorAxis'      => 6378137.0,
            'inverseFlattening'  => 298.257223563
        ),
        self::GRS_67 => array(
            'name'               => 'Geodetic Reference System (1967)',
            'synonyms'           => 'GRS_1967,INTERNATIONAL_1967',
            'epsg_id'            => '7036',
            'semiMajorAxis'      => 6378160.0,
            'inverseFlattening'  => 298.247167427
        ),
        self::GRS_MODIFIED_67 => array(
            'name'               => 'Geodetic Reference System (1967) Modified',
            'synonyms'           => 'GRS_MODIFIED_1967,GRS_1967_MODIFIED,GRS_67_MODIFIED',
            'epsg_id'            => '7050',
            'semiMajorAxis'      => 6378160.0,
            'inverseFlattening'  => 298.25
        ),
        self::GRS_80 => array(
            'name'               => 'Geodetic Reference System (1980)',
            'synonyms'           => 'GRS_1980,INTERNATIONAL_1979',
            'epsg_id'            => '7019',
            'semiMajorAxis'      => 6378137.0,
            'inverseFlattening'  => 298.257222101
        ),
        self::HELMERT_1906 => array(
            'name'               => 'Helmert (1906)',
            'synonyms'           => '',
            'epsg_id'            => '7020',
            'semiMajorAxis'      => 6378200.0,
            'inverseFlattening'  => 298.3
        ),
        self::HOUGH_1906 => array(
            'name'               => 'Hough (1906)',
            'synonyms'           => '',
            'epsg_id'            => '7053',
            'semiMajorAxis'      => 6378270.0,
            'inverseFlattening'  => 297.0
        ),
        self::HUGHES_1980 => array(
            'name'               => 'Hughes (1980)',
            'synonyms'           => '',
            'epsg_id'            => '7058',
            'semiMajorAxis'      => 6378273.0,
            'semiMinorAxis'      => 6356889.449
        ),
        self::IAG_1975 => array(
            'name'               => 'IAG (1975)',
            'synonyms'           => '',
            'epsg_id'            => '7049',
            'semiMajorAxis'      => 6378140.0,
            'inverseFlattening'  => 298.257
        ),
        self::INDONESIAN_1974 => array(
            'name'               => 'Indonesian National Spheroid (1974)',
            'synonyms'           => '',
            'epsg_id'            => '7021',
            'semiMajorAxis'      => 6378160.0,
            'inverseFlattening'  => 298.247
        ),
        self::INTERNATIONAL_1924 => array(
            'name'               => 'International (1924)',
            'synonyms'           => 'HAYFORD_1909',
            'epsg_id'            => '7022',
            'semiMajorAxis'      => 6378388.0,
            'inverseFlattening'  => 297.0
        ),
        self::INTERNATIONAL_1924_AUTHALIC => array(
            'name'               => 'International (1924) Authalic Sphere',
            'synonyms'           => '',
            'epsg_id'            => '7057',
            'semiMajorAxis'      => 6371228.0,
            'semiMinorAxis'      => 6371228.0
        ),
        self::KRASSOWSKY_1940 => array(
            'name'               => 'Krassowsky (1940)',
            'synonyms'           => '',
            'epsg_id'            => '7024',
            'semiMajorAxis'      => 6378245.0,
            'inverseFlattening'  => 298.3
        ),
        self::NWL_9D => array(
            'name'               => 'NWL 9D',
            'synonyms'           => '',
            'epsg_id'            => '7025',
            'semiMajorAxis'      => 6378145.0,
            'inverseFlattening'  => 298.25
        ),
        self::OSU_86F => array(
            'name'               => 'OSU 86F',
            'synonyms'           => '',
            'epsg_id'            => '7032',
            'semiMajorAxis'      => 6378136.2,
            'inverseFlattening'  => 298.257223563
        ),
        self::OSU_91A => array(
            'name'               => 'OSU 91A',
            'synonyms'           => '',
            'epsg_id'            => '7033',
            'semiMajorAxis'      => 6378136.3,
            'inverseFlattening'  => 298.257223563
        ),
        self::PLESSIS_1817 => array(
            'name'               => 'Plessis (1817)',
            'synonyms'           => '',
            'epsg_id'            => '7027',
            'semiMajorAxis'      => 6376523.0,
            'inverseFlattening'  => 308.64
        ),
        self::POPULAR_VISUALISATION_SPHERE => array(
            'name'               => 'Popular Visualisation Sphere',
            'synonyms'           => '',
            'epsg_id'            => '7059',
            'semiMajorAxis'      => 6378137.0,
            'semiMinorAxis'      => 6378137.0
        ),
        self::PZ_90 => array(
            'name'               => 'PZ 90',
            'synonyms'           => '',
            'epsg_id'            => '7054',
            'semiMajorAxis'      => 6378136.0,
            'inverseFlattening'  => 298.257839303
        ),
        self::STRUVE_1860 => array(
            'name'               => 'Struve (1860)',
            'synonyms'           => '',
            'epsg_id'            => '7028',
            'semiMajorAxis'      => 6378298.3,
            'inverseFlattening'  => 294.73
        ),
        self::WAR_OFFICE => array(
            'name'               => 'War Office',
            'synonyms'           => 'MCCAW_1924',
            'epsg_id'            => '7029',
            'semiMajorAxis'      => 6378300.0,
            'inverseFlattening'  => 296.0
        ),
        self::WGS_60 => array(
            'name'               => 'World Geodetic System (1960)',
            'synonyms'           => 'WGS_1960',
            'epsg_id'            => '',
            'semiMajorAxis'      => 6378165.000,
            'semiMinorAxis'      => 6356783.287,
            'inverseFlattening'  => 298.300000
        ),
        self::WGS_66 => array(
            'name'               => 'World Geodetic System (1966)',
            'synonyms'           => 'WGS_1966',
            'epsg_id'            => '',
            'semiMajorAxis'      => 6378145.000,
            'semiMinorAxis'      => 6356759.769,
            'inverseFlattening'  => 298.250000
        ),
        self::WGS_72 => array(
            'name'               => 'World Geodetic System (1972)',
            'synonyms'           => 'WGS_1972,NWL_10D',
            'epsg_id'            => '7043',
            'semiMajorAxis'      => 6378135.0,
            'inverseFlattening'  => 298.26
        ),
        self::WGS_84 => array(
            'name'               => 'World Geodetic System (1984)',
            'synonyms'           => 'WGS_1984',
            'epsg_id'            => '7030',
            'semiMajorAxis'      => 6378137.0,
            'inverseFlattening'  => 298.257223563
        ),
        self::IERS_1989 => array(
            'name'               => 'International Earth Rotation and Reference Systems Service (1989)',
            'synonyms'           => '',
            'epsg_id'            => '',
            'semiMajorAxis'      => 6378136,
            'semiMinorAxis'      => 6356751.302,
            'inverseFlattening'  => 298.257
        ),
        self::IERS_2003 => array(
            'name'               => 'International Earth Rotation and Reference Systems Service (2003)',
            'synonyms'           => '',
            'epsg_id'            => '',
            'semiMajorAxis'      => 6378136.6,
            'semiMinorAxis'      => 6356751.9,
            'inverseFlattening'  => 298.25642
        ),
    );


    /**
     * Flag indicating whether secondary attributes need calculating
     *
     * @access protected
     * @var    boolean
     */
    protected $dirty = true;

    /**
     * Reference code for this ellipsoid
     *
     * @access protected
     * @var    string
     */
    protected $ellipsoidReference;

    /**
     * Name of this ellipsoid
     *
     * @access protected
     * @var    string
     */
    protected $ellipsoidName;

    /**
     * EPSG ID value for this ellipsoid
     *
     * @access protected
     * @var    string
     */
    protected $epsgId;

    /**
     * The semi-major (Equatorial) axis of this ellipsoid
     *
     * @access protected
     * @var    float
     */
    protected $semiMajorAxis;

    /**
     * The semi-minor (Polar) axis of this ellipsoid
     *
     * @access protected
     * @var    float
     */
    protected $semiMinorAxis;

    /**
     * The Inverse Flattening of this ellipsoid
     *
     * @access protected
     * @var    float
     */
    protected $inverseFlattening;

    /**
     * The First Eccentricity Squared of this ellipsoid
     *
     * @access protected
     * @var    float
     */
    protected $firstEccentricitySquared;

    /**
     * The Second Eccentricity Squared of this ellipsoid
     *
     * @access protected
     * @var    float
     */
    protected $secondEccentricitySquared;


    /**
     * Helper method to return the sine squared value
     *
     * @param     int|float    $value    The value on which to perform the calculation
     * @return    float        The sine squared result
     */
    private static function sinSquared($value)
    {
        return sin($value) * sin($value);
    }

    /**
     * Calculate the secondary properties for this Reference Ellipsoid object
     * We calculate the Semi-Minor (Polar) Axis if it han't been provided,
     * using the Semi-Major (Equatorial) Axis and the Inverse Flattening values
     * We calculate the Inverse Flattening if it han't been provided,
     * using the Semi-Major (Equatorial) and the Semi-Minor (Polar) Axis values
     * We also calculate the First and Second Eccentricity Squared values
     *
     * @access    private
     * @return    void
     * @throws    Exception
     */
    private function calculateDerivedParameters()
    {
        if ($this->semiMajorAxis->getValue() === 0.0) {
            throw new Exception('Semi-Major (Equatorial) Axis is not set');
        }

        if ($this->semiMinorAxis->getValue() == 0.0) {
            if ($this->inverseFlattening === 0.0) {
                throw new Exception('Neither Semi-Minor (Polar) Axis nor Inverse Flattening is set');
            }
            $this->semiMinorAxis->setValue($this->semiMajorAxis->getValue() * (1 - (1 / $this->inverseFlattening)));
        } elseif ($this->inverseFlattening == 0.0) {
            if ($this->semiMajorAxis->getValue() !== $this->semiMinorAxis->getValue()) {
                $this->inverseFlattening = $this->semiMajorAxis->getValue() /
                                           ($this->semiMajorAxis->getValue() - $this->semiMinorAxis->getValue());
            }
        }

        $this->firstEccentricitySquared = (($this->semiMajorAxis->getValue() * $this->semiMajorAxis->getValue()) -
                                           ($this->semiMinorAxis->getValue() * $this->semiMinorAxis->getValue())) /
                                          ($this->semiMajorAxis->getValue() * $this->semiMajorAxis->getValue());
        $this->secondEccentricitySquared = (($this->semiMajorAxis->getValue() * $this->semiMajorAxis->getValue()) -
                                            ($this->semiMinorAxis->getValue() * $this->semiMinorAxis->getValue())) /
                                           ($this->semiMinorAxis->getValue() * $this->semiMinorAxis->getValue());

        $this->dirty = false;
    }   //  private function calculateDerivedParameters()


    /**
     * Create a new Reference Ellipsoid object
     *
     * @param     string    $ellipsoid    The name of the ellipsoid to use
     * @return    void
     * @throws    Exception
     */
    public function __construct($ellipsoid = ReferenceEllipsoid::WGS_1984)
    {
        if (!is_null($ellipsoid)) {
            $this->setEllipsoid($ellipsoid);
        }
    }   // function __construct()


    /**
     * Get the internal reference name of the Reference Ellipsoid used for this object
     *
     * @return    string    The name of this ellipsoid
     */
    public function getEllipsoidReference()
    {
        return $this->ellipsoidReference;
    }   //  getEllipsoidName()

    /**
     * Get the descriptive name of the Reference Ellipsoid used for this object
     *
     * @return    string    The name of this ellipsoid
     */
    public function getEllipsoidName()
    {
        return $this->ellipsoidName;
    }   //  getEllipsoidName()

    /**
     * Get the EPSG ID of the Reference Ellipsoid used for this object
     *
     * @return    string    The name of this ellipsoid
     */
    public function getEllipsoidID()
    {
        return $this->epsgId;
    }   //  getEllipsoidID()

    /**
     * Validate an Ellipsoid Name or synonym
     *
     * @param    string    $ellipsoid    The name of the ellipsoid to validate, or a synonym for that name
     * @return   string    The actual name used internally for the requested ellipsoid
     * @throws   Exception
     */
    private static function isValidEllipsoid($ellipsoid)
    {
        if (is_null($ellipsoid)) {
            throw new Exception('An Ellipsoid name must be specified');
        }

        if (!isset(self::$ellipsoidData[$ellipsoid])) {
            if (defined('self::'.$ellipsoid)) {
                $ellipsoid = constant('self::'.$ellipsoid);
                if (!isset(self::$ellipsoidData[$ellipsoid])) {
                    throw new Exception('"'.$ellipsoid.'" is not a valid ellipsoid');
                }
            } else {
                throw new Exception('"'.$ellipsoid.'" is not a valid ellipsoid');
            }
        }

        return $ellipsoid;
    }

    /**
     * Set the Data for this Reference Ellipsoid object
     *
     * @param     string    $ellipsoidName    The name of the ellipsoid to use
     * @return    ReferenceEllipsoid
     * @throws    Exception
     */
    public function setEllipsoid($ellipsoidName = null)
    {
        $ellipsoidName = self::isValidEllipsoid($ellipsoidName);

        $this->semiMajorAxis = new Distance();
        $this->semiMinorAxis = new Distance();
        $this->ellipsoidReference = $ellipsoidName;
        $this->ellipsoidName = self::$ellipsoidData[$ellipsoidName]['name'];
        $this->epsgId = self::$ellipsoidData[$ellipsoidName]['epsg_id'];

        //    All pre-configured Ellipsoid dimensions are already defined in meters,
        //        so we don't need to do any UOM conversions here
        $this->semiMajorAxis->setValue(self::$ellipsoidData[$ellipsoidName]['semiMajorAxis']);
        $this->semiMinorAxis->setValue(
            isset(self::$ellipsoidData[$ellipsoidName]['semiMinorAxis']) ?
                self::$ellipsoidData[$ellipsoidName]['semiMinorAxis'] :
                0.0
            );
        $this->inverseFlattening = isset(self::$ellipsoidData[$ellipsoidName]['inverseFlattening']) ?
            self::$ellipsoidData[$ellipsoidName]['inverseFlattening'] :
            0.0;

        $this->calculateDerivedParameters();

        return $this;
    }   //  public function setEllipsoid()

    /**
     * Set the Semi-Major (Equatorial) Axis for this Reference Ellipsoid object
     *
     * @param     integer|float    $semiMajorAxis    Length of the Semi-Major (Equatorial) Axis
     *                                                   to use for this ellipsoid
     * @param     string           $uom              Unit of Measure for this axis length
     * @throws    Exception
     */
    public function setSemiMajorAxis($semiMajorAxis = null, $uom = Distance::METRES)
    {
        if (is_null($semiMajorAxis)) {
            throw new Exception('Missing Semi-Major (Equatorial) Axis value');
        } elseif (!is_numeric($semiMajorAxis)) {
            throw new Exception('Semi-Major (Equatorial) Axis is not a numeric value');
        }

        $this->semiMajorAxis->setValue($semiMajorAxis, $uom);
        $this->dirty = true;

        return $this;
    }

    /**
     * Get the Semi-Major (Equatorial) Axis for this Reference Ellipsoid object
     *
     * @param     string    $uom    Unit of Measure for the returned value
     * @return    float     Length of the Semi-Major (Equatorial) Axis for this ellipsoid
     * @throws    Exception
     */
    public function getSemiMajorAxis($uom = Distance::METRES)
    {
        return $this->semiMajorAxis->getValue($uom);
    }

    /**
     * Set the Semi-Minor (Polar) Axis for this Reference Ellipsoid object
     * This will nullify the Inverse Flattening,
     * and force a recalculation from the Semi-Major (Equatorial) axis and the Semi-Minor (Polar) Axis
     *
     * @param     integer|float    $semiMinorAxis   Length of the Semi-Minor (Polar) Axis
     *                                                  to use for this ellipsoid
     * @param     string           $uom             Unit of Measure for this axis length
     * @throws    Exception
     */
    public function setSemiMinorAxis($semiMinorAxis = null, $uom = Distance::METRES)
    {
        if (is_null($semiMinorAxis)) {
            throw new Exception('Missing Semi-Minor (Polar) Axis value');
        } elseif (!is_numeric($semiMinorAxis)) {
            throw new Exception('Semi-Minor (Polar) Axis is not a numeric value');
        }

        $this->semiMinorAxis->setValue($semiMinorAxis, $uom);
        $this->inverseFlattening = null;
        $this->dirty = true;

        return $this;
    }

    /**
     * Get the Semi-Minor (Polar) Axis for this Reference Ellipsoid object
     *
     * @param     string    $uom    Unit of Measure for the returned value
     * @return    float     Length of the Semi-Minor (Polar) Axis for this ellipsoid
     * @throws    Exception
     */
    public function getSemiMinorAxis($uom = Distance::METRES)
    {
        return $this->semiMinorAxis->getValue($uom);
    }

    /**
     * Set the Inverse Flattening for this Reference Ellipsoid object
     * This will nullify the Semi-Minor (Polar) Axis,
     * and force a recalculation from the Semi-Major (Equatorial) axis and the specified flattening
     *
     * @param     integer|float    $inverseFlattening    Inverse Flattening to use for this ellipsoid
     * @throws    Exception
     */
    public function setInverseFlattening($inverseFlattening = null)
    {
        if (is_null($inverseFlattening)) {
            throw new Exception('Missing Inverse Flattening value');
        } elseif (!is_numeric($inverseFlattening)) {
            throw new Exception('Inverse Flattening is not a numeric value');
        }

        $this->inverseFlattening = (float) $inverseFlattening;
        $this->semiMinorAxis->setValue();
        $this->dirty = true;

        return $this;
    }

    /**
     * Get the Inverse Flattening for this Reference Ellipsoid object
     *
     * @return    float    Inverse Flattening for this ellipsoid
     * @throws    Exception
     */
    public function getInverseFlattening()
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return $this->inverseFlattening;
    }

    /**
     * Set the Flattening for this Reference Ellipsoid object
     * This will nullify the Semi-Minor (Polar) Axis,
     * and force a recalculation from the Semi-Major (Equatorial) axis and the specified flattening
     *
     * @param     integer|float    $flattening    Flattening to use for this ellipsoid
     * @throws    Exception
     */
    public function setFlattening($flattening = null)
    {
        if (is_null($flattening)) {
            throw new Exception('Missing Flattening value');
        } elseif (!is_numeric($flattening)) {
            throw new Exception('Flattening is not a numeric value');
        }

        $this->inverseFlattening = (float) 1 / $flattening;
        $this->semiMinorAxis->setValue();
        $this->dirty = true;

        return $this;
    }

    /**
     * Get the Flattening for this Reference Ellipsoid object
     *
     * @return    float    Flattening for this ellipsoid
     * @throws    Exception
     */
    public function getFlattening()
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        if ($this->inverseFlattening > 0.0) {
            return 1 / $this->inverseFlattening;
        }
        return INF;
    }

    /**
     * Get the First Eccentricity for this Reference Ellipsoid object
     *
     * @return    float    First Eccentricity for this ellipsoid
     * @throws    Exception
     */
    public function getFirstEccentricity()
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return sqrt($this->firstEccentricitySquared);
    }

    /**
     * Get the First Eccentricity Squared for this Reference Ellipsoid object
     *
     * @return    float    First Eccentricity Squared for this ellipsoid
     * @throws    Exception
     */
    public function getFirstEccentricitySquared()
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return $this->firstEccentricitySquared;
    }

    /**
     * Get the Second Eccentricity for this Reference Ellipsoid object
     *
     * @return    float    Second Eccentricity for this ellipsoid
     * @throws    Exception
     */
    public function getSecondEccentricity()
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return sqrt($this->secondEccentricitySquared);
    }

    /**
     * Get the Second Eccentricity Squared for this Reference Ellipsoid object
     *
     * @return    float    Second Eccentricity Squared for this ellipsoid
     * @throws    Exception
     */
    public function getSecondEccentricitySquared()
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return $this->secondEccentricitySquared;
    }

    /**
     * Get the Mean Radius this Reference Ellipsoid object
     *
     * @param     string    $uom    Unit of Measure for the returned value
     * @return    float     Mean Radius for this ellipsoid
     * @throws    Exception
     */
    public function getMeanRadius($uom = Distance::METRES)
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return Distance::convertFromMeters(
            (2 * $this->semiMajorAxis->getValue() + $this->semiMinorAxis->getValue()) / 3,
            $uom
        );
    }

    /**
     * Get the Authalic Radius this Reference Ellipsoid object
     *
     * The authalic ("equal area") radius is the radius of a hypothetical perfect sphere which has the same surface area
     * as the reference ellipsoid.
     *
     * @param     string    $uom    Unit of Measure for the returned value
     * @return    float     Authalic Radius for this ellipsoid
     * @throws    Exception
     */
    public function getAuthalicRadius($uom = Distance::METRES)
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        $semiMajorSquared = $this->semiMajorAxis->getValue() * $this->semiMajorAxis->getValue();
        $semiMinorSquared = $this->semiMinorAxis->getValue() * $this->semiMinorAxis->getValue();

        if ($this->inverseFlattening > 0.0) {
            return Distance::convertFromMeters(
                sqrt(
                    ($semiMajorSquared +
                     (($this->semiMajorAxis->getValue() * $semiMinorSquared) / sqrt($semiMajorSquared - $semiMinorSquared)) *
                     log(
                        ($this->semiMajorAxis->getValue() + sqrt($semiMajorSquared - $semiMinorSquared)) /
                         $this->semiMinorAxis->getValue()
                     )
                    ) / 2
                ),
                $uom
            );
        }
        return $this->semiMajorAxis->getValue($uom);
    }

    /**
     * Get the Volumetric Radius this Reference Ellipsoid object
     *
     * This is the radius of a sphere of equal volume to the ellipsoid
     *
     * @param     string    $uom    Unit of Measure for the returned value
     * @return    float     Volumetric Radius for this ellipsoid
     * @throws    Exception
     */
    public function getVolumetricRadius($uom = Distance::METRES)
    {
        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        return Distance::convertFromMeters(
            pow(
                $this->semiMajorAxis->getValue() * $this->semiMajorAxis->getValue() *
                    $this->semiMinorAxis->getValue(),
                1/3
            ),
            $uom
        );
    }

    /**
     * Get the Radius of Curvature along the Meridian at a specified latitude
     * for this Reference Ellipsoid object
     *
     * The formula used here is from http://www.epsg.org/guides/docs/G7-2.pdf
     *
     * @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature,
     *                                              positive when to the north of the equator, negative when to the south
     * @param     string           $degrad      Indicating whether the Angle of Latitude is being specified
     *                                              in degrees or radians
     * @param     string           $uom         Unit of Measure for the returned value
     * @return    float            The Radius of Curvature along the Meridian
     *                                 at the specified latitude for this ellipsoid
     * @throws    Exception
     */
    public function getRadiusOfCurvatureMeridian(
        $latitude = null,
        $degrad = Angle::DEGREES,
        $uom = Distance::METRES
    ) {
        $latitude = LatLong::validateLatitude($latitude, $degrad);

        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        $radius = ($this->semiMajorAxis->getValue() * (1 - $this->firstEccentricitySquared)) /
                  pow(1 - $this->firstEccentricitySquared * self::sinSquared($latitude), 1.5);

        return Distance::convertFromMeters($radius, $uom);
    }

    /**
     * Get the Radius of Curvature along the Prime Vertical at a specified latitude
     * for this Reference Ellipsoid object
     *
     * The formula used here is from http://www.epsg.org/guides/docs/G7-2.pdf
     *
     * @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature,
     *                                              positive when to the north of the equator, negative when to the south
     * @param     string           $degrad      Indicating whether the Angle of Latitude is being specified
     *                                              in degrees or radians
     * @param     string           $uom         Unit of Measure for the returned value
     * @return    float            The Radius of Curvature along the Prime Vertical at the specified latitude
     *                                 for this ellipsoid
     * @throws    Exception
     */
    public function getRadiusOfCurvaturePrimeVertical(
        $latitude = null,
        $degrad = Angle::DEGREES,
        $uom = Distance::METRES
    ) {
        $latitude = LatLong::validateLatitude($latitude, $degrad);

        if ($this->dirty) {
            $this->calculateDerivedParameters();
        }

        $radius = $this->semiMajorAxis->getValue() /
                   pow(1 - $this->firstEccentricitySquared * self::sinSquared($latitude), 0.5);

        return Distance::convertFromMeters($radius, $uom);
    }

    /**
     * Get a list of the supported Reference Ellipsoid names
     *
     * @return    string[]    An array listing the permitted Reference Ellipsoid names
     *                        The array value is the descriptive name that can be passed to the constructor,
     *                            or to the setEllipsoid() method, while the key is an internal constant value
     *                            for that ellipsoid.
     */
    public static function getEllipsoidNames()
    {
        return array_combine(
            array_keys(
                self::$ellipsoidData
            ),
            array_map(
                function ($ellipsoidData) {
                    return $ellipsoidData['name'];
                },
                self::$ellipsoidData
            )
        );
    }
}
