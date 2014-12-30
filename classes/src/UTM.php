<?php

namespace Geodetic;

/**
 * Universal Transverse Mercator object.
 *
 *  The Universal Transverse Mercator (UTM) geographic coordinate system uses a 2-dimensional Cartesian coordinate
 *      system to give locations on the surface of the Earth. It is a horizontal position representation, i.e. it is
 *      used to identify locations on the Earth independently of vertical position, but differs from the traditional
 *      method of latitude and longitude in several respects.
 *  The UTM system is not a single map projection. The system instead divides the Earth into sixty zones, each a six-
 *      degree band of longitude, and uses a secant transverse Mercator projection in each zone.
 *  The transverse Mercator projection is a variant of the Mercator projection, which was originally developed by the
 *      Flemish geographer and cartographer Gerardus Mercator, in 1570. This projection is conformal, so it preserves
 *      angles and approximates shape but distorts distance and area. UTM involves non-linear scaling in both Easting
 *      and Northing to ensure the projected map of the ellipsoid is conformal.
 *
 *  The UTM system divides the Earth between 80°S and 84°N latitude into 60 zones, each 6° of longitude in width.
 *      Zone 1 covers longitude 180° to 174° W; zone numbering increases eastward to zone 60 that covers longitude
 *      174 to 180 East.
 *  Each of the 60 zones uses a transverse Mercator projection that can map a region of large north-south extent with
 *      low distortion. By using narrow zones of 6° of longitude (up to 800 km) in width, and reducing the scale
 *      factor along the central meridian to 0.9996 (a reduction of 1:2500), the amount of distortion is held below 1
 *      part in 1,000 inside each zone. Distortion of scale increases to 1.0010 at the zone boundaries along the
 *      equator.
 *  In each zone the scale factor of the central meridian reduces the diameter of the transverse cylinder to produce a
 *      secant projection with two standard lines, or lines of true scale, about 180 km on each side of, and about
 *      parallel to, the central meridian (Arc cos 0.9996 = 1.62° at the Equator). The scale is less than 1 inside the
 *      standard lines and greater than 1 outside them, but the overall distortion is minimized.
 *
 *  -    Description modified from the Wikipedia article at
 *           http://en.wikipedia.org/wiki/Universal_Transverse_Mercator_coordinate_system
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class UTM
{
    /**
     * Array for the upper and lower bounds of each latitude zone,
     *     indexed by the zone ID.
     *
     * @access protected
     * @var array[]
     */
    protected static $latitudeZones = array(
        'X' => array(72, 84),
        'W' => array(64, 72),
        'V' => array(56, 64),
        'U' => array(48, 56),
        'T' => array(40, 48),
        'S' => array(32, 40),
        'R' => array(24, 32),
        'Q' => array(16, 24),
        'P' => array(8, 16),
        'N' => array(0, 8),
        'M' => array(-8, 0),
        'L' => array(-16, -8),
        'K' => array(-24, -16),
        'J' => array(-32, -24),
        'H' => array(-40, -32),
        'G' => array(-48, -40),
        'F' => array(-56, -48),
        'E' => array(-64, -56),
        'D' => array(-72, -64),
        'C' => array(-80, -72),
    );

    /**
     * The Northing value of this UTM object.
     *
     * @access protected
     * @var float
     */
    protected $northing;

    /**
     * The Easting value of this UTM object.
     *
     * @access protected
     * @var float
     */
    protected $easting;

    /**
     * The Latitude Zone of this UTM object.
     *
     * @access protected
     * @var string
     */
    protected $latitudeZone;

    /**
     * The Longitude Zone of this UTM object.
     *
     * @access protected
     * @var string
     */
    protected $longitudeZone;


    /**
     * Create a new UTM
     *
     * @param     integer|float    $northing         The UTM Northing value
     * @param     integer|float    $easting          The UTM Easting value
     * @param     string           $latitudeZone     The UTM Latitude Zone value
     * @param     string           $longitudeZone    The UTM Longitude Zone value
     * @throws    Exception
     */
    public function __construct(
        $northing = null,
        $easting = null,
        $latitudeZone = null,
        $longitudeZone = null
    ) {
        if (!is_null($northing)) {
            $this->setNorthing($northing);
        }
        if (!is_null($easting)) {
            $this->setEasting($easting);
        }
        if (!is_null($latitudeZone)) {
            $this->setLatitudeZone($latitudeZone);
        }
        if (!is_null($longitudeZone)) {
            $this->setLongitudeZone($longitudeZone);
        }
    }


    /**
     * Set the Northing value
     *
     * @param     float    $northing    The Northing value
     * @return    UTM
     * @throws    Exception
     */
    public function setNorthing($northing = null)
    {
        if (!is_numeric($northing)) {
            throw new Exception('Northing must be a numeric value');
        }

        $this->northing = $northing;

        return $this;
    }

    /**
     * Get the Northing value
     *
     * @return    float    The Northing value
     */
    public function getNorthing()
    {
        return $this->northing;
    }

    /**
     * Set the Easting value
     *
     * @param     float    $easting    The Easting value
     * @return    UTM
     * @throws    Exception
     */
    public function setEasting($easting = null)
    {
        if (!is_numeric($easting)) {
            throw new Exception('Easting must be a numeric value');
        }

        $this->easting = $easting;

        return $this;
    }

    /**
     * Get the Easting value
     *
     * @return    float    The Easting value
     */
    public function getEasting()
    {
        return $this->easting;
    }

    /**
     * Set the Latitude Zone
     *
     * @param     string    $latitudeZone    The Latitude Zone
     * @return    UTM
     * @throws    Exception
     */
    public function setLatitudeZone($latitudeZone = null)
    {
        $latitudeZone = strtoupper($latitudeZone);
        if (!(isset(self::$latitudeZones[$latitudeZone]) || $latitudeZone == 'Z')) {
            throw new Exception('Invalid Latitude Zone');
        }

        $this->latitudeZone = $latitudeZone;

        return $this;
    }

    /**
     * Get the Latitude Zone
     *
     * @return    string    The Latitude Zone
     */
    public function getLatitudeZone()
    {
        return $this->latitudeZone;
    }

    /**
     * Set the Longitude Zone
     *
     * @param     integer    $longitudeZone    The Longitude Zone
     * @return    UTM
     * @throws    Exception
     */
    public function setLongitudeZone($longitudeZone = null)
    {
        if (!is_numeric($longitudeZone)) {
            throw new Exception('Invalid Longitude Zone');
        }

        $this->longitudeZone = $longitudeZone;

        return $this;
    }

    /**
     * Get the Longitude Zone
     *
     * @return    integer    The Longitude Zone
     */
    public function getLongitudeZone()
    {
        return $this->longitudeZone;
    }

    /**
     * Convert this Univeral Transverse Mercator to a Latitude/Longitude LatLong object using a specified Datum
     *
     * @param     Datum    $datum    The Datum to use for this transform
     * @return    LatLong            The Latitude/Longitude LatLong object that matches this UTM
     * @throws    Exception
     */
    public function toLatLong(Datum $datum = null)
    {
        if (is_null($datum)) {
            throw new Exception('You must specify a datum to use for this conversion');
        }

        $ellipsoid = $datum->getReferenceEllipsoid();
        $eSquared = $ellipsoid->getFirstEccentricitySquared();
        $ePrimeSquared = ($eSquared) / (1 - $eSquared);
        $e1Value = (1 - sqrt(1 - $eSquared)) / (1 + sqrt(1 - $eSquared));

        $utmF0 = 0.9996;

        $easting = $this->easting - 500000.0;
        $northing = $this->northing;
        $zoneNumber = $this->longitudeZone;
        $zoneLetter = $this->latitudeZone;

        $longitudeOrigin = ($zoneNumber - 1.0) * 6.0 - 180.0 + 3.0;

        // Correct y for southern hemisphere
        if ((ord($zoneLetter) - ord("N")) < 0) {
            $northing -= 10000000.0;
        }

        $mValue = $northing / $utmF0;
        $muValue = $mValue / ($ellipsoid->getSemiMajorAxis() *
            (1.0 - $eSquared / 4.0 - 3.0 * $eSquared * $eSquared / 64.0 - 5.0 * pow($eSquared, 3.0) / 256.0));

        $phi = $muValue + (3.0 * $e1Value / 2.0 - 27.0 * pow($e1Value, 3.0) / 32.0) * sin(2.0 * $muValue) +
            (21.0 * $e1Value * $e1Value / 16.0 - 55.0 * pow($e1Value, 4.0) / 32.0) *
            sin(4.0 * $muValue) + (151.0 * pow($e1Value, 3.0) / 96.0) * sin(6.0 * $muValue);

        $nValue = $ellipsoid->getSemiMajorAxis() /
            sqrt(1.0 - $eSquared * sin($phi) * sin($phi));
        $tValue = tan($phi) * tan($phi);
        $cValue = $ePrimeSquared * cos($phi) * cos($phi);
        $rValue = $ellipsoid->getSemiMajorAxis() * (1.0 - $eSquared) /
            pow(1.0 - $eSquared * sin($phi) * sin($phi), 1.5);
        $dValue = $easting / ($nValue * $utmF0);

        $latitude = ($phi - ($nValue * tan($phi) / $rValue) *
                            ($dValue * $dValue / 2.0 -
                                (5.0 + (3.0 * $tValue) + (10.0 * $cValue) - (4.0 * $cValue * $cValue) - (9.0 * $ePrimeSquared)) *
                            pow($dValue, 4.0) / 24.0 +
                            (61.0 + (90.0 * $tValue) + (298.0 * $cValue) + (45.0 * $tValue * $tValue) -
                                (252.0 * $ePrimeSquared) - (3.0 * $cValue * $cValue)) *
                            pow($dValue, 6.0) / 720.0)) * (180.0 / M_PI);

        $longitude = $longitudeOrigin +
                     (($dValue - (1.0 + 2.0 * $tValue + $cValue) * pow($dValue, 3.0) / 6.0 +
                         (5.0 - (2.0 * $cValue) + (28.0 * $tValue) - (3.0 * $cValue * $cValue) + (8.0 * $ePrimeSquared) +
                         (24.0 * $tValue * $tValue)) * pow($dValue, 5.0) / 120.0) /
                         cos($phi)) *
                     (180.0 / M_PI);

        $latLongCoordinates = new LatLong\CoordinateValues(
            $latitude,
            $longitude,
            Angle::DEGREES,
            0.0,
            Distance::METRES
        );
        return new LatLong($latLongCoordinates);
    }

    /**
     * Work out the UTM longitude zone from the latitude and longitude
     *
     * @param     $latitude     The Latitude value (in degrees)
     * @param     $longitude    The Longitude value (in degrees)
     * @return    string        The UTM Zone letter for the specified Latitude and Longitude
     */
    public static function identifyLongitudeZone($latitude, $longitude)
    {
        $utmLongitudeZone = (int) (($longitude + 180.0) / 6.0) + 1;
        //  Special zone for Norway
        if (($latitude >= 56.0 && $latitude < 64.0) &&
            ($longitude >= 3.0 && $longitude < 12.0)) {
            $utmLongitudeZone = 32;
        }
        //  Special zones for Svalbard
        if ($latitude >= 72.0 && $latitude < 84.0) {
            if ($longitude >= 0.0 && $longitude < 9.0) {
                $utmLongitudeZone = 31;
            } elseif ($longitude >= 9.0 && $longitude < 21.0) {
                $utmLongitudeZone = 33;
            } elseif ($longitude >= 21.0 && $longitude < 33.0) {
                $utmLongitudeZone = 35;
            } elseif ($longitude >= 33.0 && $longitude < 42.0) {
                $utmLongitudeZone = 37;
            }
        }

        return $utmLongitudeZone;
    }

    /**
     * Work out the UTM latitude zone from the latitude
     *
     * @param     $latitude    The Latitude value (in degrees)
     * @return    string       The UTM Zone letter for the specified Latitude
     */
    public static function identifyLatitudeZone($latitude)
    {
        foreach (self::$latitudeZones as $zone => $range) {
            if ($latitude >= $range[0] && $latitude < $range[1]) {
                return $zone;
            }
        }
        return 'Z';
    }
}
