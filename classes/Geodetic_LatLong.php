<?php

/**
 * Latitude/Longitude coordinate object.
 *
 *  Latitude is a geographic coordinate that specifies the north-south position of a point on the Earth's surface.
 *      Lines of constant latitude, or parallels, run east-west as circles parallel to the equator. Latitude is an
 *      angle which ranges from 0° at the Equator to 90° (North or South) at the poles.
 *  Longitude is a geographic coordinate that specifies the east-west position of a point on the Earth's surface.
 *      It is an angular measurement, usually expressed in degrees. Points with the same longitude lie in lines
 *      running from the North Pole to the South Pole. By convention, one of these, the Prime Meridian, which passes
 *      through the Royal Observatory, Greenwich, England, establishes the position of zero degrees longitude. The
 *      longitude of other places is measured as an angle east or west from the Prime Meridian, ranging from 0° at
 *      the Prime Meridian to +180° eastward and -180° westward. Specifically, it is the angle between a plane
 *      containing the Prime Meridian and a plane containing the North Pole, South Pole and the location in question.
 *  Latitude is used together with longitude to specify the precise location of features on the surface of the Earth.
 *
 *  -    Description modified from the Wikipedia articles at
 *           http://en.wikipedia.org/wiki/Latitude
 *       and
 *           http://en.wikipedia.org/wiki/Longitude
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_LatLong
{

    /**
     * The Latitude value of this LatLong object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Geodetic_Angle
     */
    protected $_latitude;

    /**
     * The Longitude value of this LatLong object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Geodetic_Angle
     */
    protected $_longitude;

    /**
     * The Height value of this LatLong object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Geodetic_Distance
     */
    protected $_height;


    /**
     * Create a new LatLong
     *
     * @param     Geodetic_XyzFormat_Interface    $xyzCoordinates    The LatLong Latitude, Longitude and
     *                                                                   Height/Elevation values expressed as X, Y and Z values
     * @throws    Geodetic_Exception
     */
    function __construct(Geodetic_XyzFormat_Interface $xyzCoordinates = NULL)
    {
        if (!is_null($xyzCoordinates)) {
            $this->_latitude = $xyzCoordinates->getX();
            $this->_longitude = $xyzCoordinates->getY();
            $this->_height = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->_latitude = new Geodetic_Angle();
        $this->_longitude = new Geodetic_Angle();
        $this->_height = new Geodetic_Distance();
    }


    /**
     * Set the Latitude
     *
     * @param     Geodetic_Angle    $latitudeObj    The Latitude
     * @return    Geodetic_LatLong
     * @throws    Geodetic_Exception
     */
    public function setLatitude(Geodetic_Angle $latitudeObj = NULL)
    {
        if (is_null($latitudeObj)) {
            throw new Geodetic_Exception('The Latitude must be a Geodetic_Angle object');
        }
        $this->_latitude = $latitudeObj;

        return $this;
    }

    /**
     * Get the Latitude as a Geodetic_Angle object
     *
     * @return    Geodetic_Angle    The Latitude
     */
    public function getLatitude()
    {
        return $this->_latitude;
    }

    /**
     * Set the Longitude
     *
     * @param     Geodetic_Angle    $longitudeObj    The Longitude
     * @return    Geodetic_LatLong
     * @throws    Geodetic_Exception
     */
    public function setLongitude(Geodetic_Angle $longitudeObj = NULL)
    {
        if (is_null($longitudeObj)) {
            throw new Geodetic_Exception('The Longitude must be a Geodetic_Angle object');
        }
        $this->_longitude = $longitudeObj;

        return $this;
    }

    /**
     * Get the Longitude as a Geodetic_Angle object
     *
     * @return    Geodetic_Angle    The Longitude
     */
    public function getLongitude()
    {
        return $this->_longitude;
    }

    /**
     * Set the Height
     *
     * @param     Geodetic_Distance    $heightObj    The Height
     * @return    Geodetic_LatLong
     * @throws    Geodetic_Exception
     */
    public function setHeight(Geodetic_Distance $heightObj = NULL)
    {
        if (is_null($heightObj)) {
            throw new Geodetic_Exception('The Height must be a Geodetic_Distance object');
        }
        $this->_height = $heightObj;

        return $this;
    }

    /**
     * Get the Height as a Geodetic_Distance object
     *
     * @return    Geodetic_Distance    The Height
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * Validate a latitude, and return its value in radians
     *
     * @public
     * @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature
     * @param     string           $degrad      Indicating whether the Angle of Latitude is being specified
     *                                              in degrees or radians
     * @return    float            The specified latitude in radians
     * @throws    Geodetic_Exception
     */
    public static function validateLatitude($latitude = NULL,
                                            $degrad = Geodetic_Angle::DEGREES)
    {
        if (is_null($latitude))
            throw new Geodetic_Exception('You must specify Latitude');

        if (!is_numeric($latitude))
            throw new Geodetic_Exception('Latitude must be a numeric value');

        if (is_null($degrad))
            $degrad = Geodetic_Angle::DEGREES;

        $latitude = ($degrad == Geodetic_Angle::DEGREES) ? deg2rad($latitude) : $latitude;

        if (($latitude < (-M_PI)) || ($latitude > (M_PI)))
            throw new Geodetic_Exception('Latitude is out of range');

        return $latitude;
    }

    /**
     * Validate a longitude, and return its value in radians
     *
     * @public
     * @param     integer|float    $longitude    Angle of Longitude for the Radius of Curvature
     * @param     string           $degrad       Indicating whether the Angle of Longitude is being specified
     *                                               in degrees or radians
     * @return    float            The specified longitude in radians
     * @throws    Geodetic_Exception
     */
    public static function validateLongitude($longitude = NULL,
                                             $degrad = Geodetic_Angle::DEGREES)
    {
        if (is_null($longitude))
            throw new Geodetic_Exception('You must specify Longitude');

        if (!is_numeric($longitude))
            throw new Geodetic_Exception('Longitude must be a numeric value');

        if (is_null($degrad))
            $degrad = Geodetic_Angle::DEGREES;

        $longitude = ($degrad == Geodetic_Angle::DEGREES) ? deg2rad($longitude) : $longitude;

        if (($longitude < (-M_PI * 2)) || ($longitude > (M_PI * 2)))
            throw new Geodetic_Exception('Longitude is out of range');

        return $longitude;
    }

    /**
     * Convert this Latitude/Longitude to an Earth-Centric Earth-Fixed Geodetic_ECEF object using a specified Datum
     *
     * @param     Geodetic_Datum    $datum    The Datum to use for this transform
     * @return    Geodetic_ECEF     The Earth-Centric Earth-Fixed Geodetic_ECEF object that matches this Latitude/Longitude
     * @throws    Geodetic_Exception
     */
    public function toECEF(Geodetic_Datum $datum = NULL)
    {
        if (is_null($datum)) {
            throw new Geodetic_Exception('You must specify a datum to use for this conversion');
        }

        $ellipsoid = $datum->getReferenceEllipsoid();

        $phi = $this->_latitude->getValue(Geodetic_Angle::RADIANS);
        $lambda = $this->_longitude->getValue(Geodetic_Angle::RADIANS);
        $radiusOfCurvature = $ellipsoid->getRadiusOfCurvaturePrimeVertical($phi,
                                                                           Geodetic_Angle::RADIANS);

        $xCoordinate = ($radiusOfCurvature + $this->_height->getValue()) * cos($phi) * cos($lambda);
        $yCoordinate = ($radiusOfCurvature + $this->_height->getValue()) * cos($phi) * sin($lambda);
        $zCoordinate = ((1 - $ellipsoid->getFirstEccentricitySquared()) * $radiusOfCurvature +
            $this->_height->getValue()) * sin($phi);

        $ecefCoordinates = new Geodetic_ECEF_CoordinateValues(
            $xCoordinate,
            $yCoordinate,
            $zCoordinate
        );
        return new Geodetic_ECEF($ecefCoordinates);
    }

    /**
     * Convert this Latitude/Longitude to a Univeral Transverse Mercator Geodetic_UTM object using a specified Datum
     *
     * @param     Geodetic_Datum    $datum    The Datum to use for this transform
     * @return    Geodetic_UTF      The Univeral Transverse Mercator Geodetic_UTM object that matches this Latitude/Longitude
     * @throws    Geodetic_Exception
     */
    public function toUTM(Geodetic_Datum $datum = NULL)
    {
        if (is_null($datum)) {
            throw new Geodetic_Exception('You must specify a datum to use for this conversion');
        }

        $ellipsoid = $datum->getReferenceEllipsoid();
        $eSquared = $ellipsoid->getFirstEccentricitySquared();
        $eSquared2 = $eSquared * $eSquared;
        $eSquared3 = $eSquared * $eSquared * $eSquared;

        $utmF0 = 0.9996;

        $utmLongitudeZone = Geodetic_UTM::identifyLongitudeZone(
            $this->_latitude->getValue(),
            $this->_longitude->getValue()
        );
        $utmLatitudeZone = Geodetic_UTM::identifyLatitudeZone($this->_latitude->getValue());
        $longitudeOrigin = Geodetic_Angle::convertFromDegrees(
            ($utmLongitudeZone - 1) * 6 - 180 + 3,
            Geodetic_Angle::RADIANS
        );

        $ePrimeSquared = ($eSquared) / (1 - $eSquared);

        $nValue = $ellipsoid->getSemiMajorAxis() /
            sqrt(
                1 - $eSquared *
                sin($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                sin($this->_latitude->getValue(Geodetic_Angle::RADIANS))
            );
        $tValue = tan($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                  tan($this->_latitude->getValue(Geodetic_Angle::RADIANS));
        $cValue = $ePrimeSquared *
                  cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                  cos($this->_latitude->getValue(Geodetic_Angle::RADIANS) );
        $aValue = cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                  ($this->_longitude->getValue(Geodetic_Angle::RADIANS) - $longitudeOrigin);

        $mValue = $ellipsoid->getSemiMajorAxis() * (
            (1 - $eSquared / 4 - 3 * $eSquared2 / 64 - 5 * $eSquared3 / 256) *
            $this->_latitude->getValue(Geodetic_Angle::RADIANS) -
                (3 * $eSquared / 8 + 3 * $eSquared2 / 32 + 45 * $eSquared3 / 1024) *
            sin(2 * $this->_latitude->getValue(Geodetic_Angle::RADIANS)) +
                (15 * $eSquared2 / 256 + 45 * $eSquared3 / 1024) *
            sin(4 * $this->_latitude->getValue(Geodetic_Angle::RADIANS)) -
                (35 * $eSquared3 / 3072) * sin(6 * $this->_latitude->getValue(Geodetic_Angle::RADIANS))
        );

        $UTMEasting = ($utmF0 * $nValue * ($aValue + (1 - $tValue + $cValue) * pow($aValue, 3.0) / 6 +
                      (5 - 18 * $tValue + $tValue * $tValue + 72 * $cValue - 58 * $ePrimeSquared) *
                      pow($aValue, 5.0) / 120) + 500000.0);

        $UTMNorthing = ($utmF0 * ($mValue + $nValue * tan($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                       ($aValue * $aValue / 2 + (5 - $tValue + (9 * $cValue) + (4 * $cValue * $cValue)) * pow($aValue, 4.0) / 24 +
                       (61 - (58 * $tValue) + ($tValue * $tValue) + (600 * $cValue) - (330 * $ePrimeSquared)) *
                       pow($aValue, 6.0) / 720)));

        // Adjust for the southern hemisphere
        if ($this->_latitude->getValue(Geodetic_Angle::RADIANS) < 0) {
            $UTMNorthing += 10000000.0;
        }

        return new Geodetic_UTM($UTMNorthing,
                                $UTMEasting,
                                $utmLatitudeZone,
                                $utmLongitudeZone
        );
    }

    /**
     * Get the distance between two Latitude/Longitude objects using the Haversine formula
     *
     * The Haversine Formula calculates the distance to your destination point assuming a spherical Earth
     *
     * @param     Geodetic_LatLong               $endPoint           The destination point
     * @param     string                         $method             Geodetic_Distance::METHOD_HAVERSINE or Geodetic_Distance::METHOD_VINCENTY
     * @param     Geodetic_ReferenceEllipsoid    $ellipsoid          If left blank, a default value of 6371009.0 metres will
     *                                                                   be used for the Earth Mean Radius for the calculation;
     *                                                               If a reference ellipsoid is specified, the Authalic Radius
     *                                                                   for that ellipsoid will be used.
     * @return    Geodetic_Distance              The great circle distance between this Lat/Long and the $endpoint Lat/Long
     * @throws    Geodetic_Exception
     */
    public function getDistance(Geodetic_LatLong $endPoint,
                                $method = Geodetic_Distance::METHOD_HAVERSINE,
                                Geodetic_ReferenceEllipsoid $ellipsoid = NULL)
    {
        if ($method == Geodetic_Distance::METHOD_HAVERSINE) {
            return $this->getDistanceHaversine($endPoint, $ellipsoid);
        } elseif ($method == Geodetic_Distance::METHOD_VINCENTY) {
            return $this->getDistanceVincenty($endPoint, $ellipsoid);
        }

        throw new Geodetic_Exception('Calculation method must be Vincenty or Haversine');
    }

     /**
     * Get the distance between two Latitude/Longitude objects using the Haversine formula
     *
     * The Haversine Formula calculates the distance to your destination point assuming a spherical Earth
     *
     * @param     Geodetic_LatLong               $endPoint           The destination point
     * @param     Geodetic_ReferenceEllipsoid    $ellipsoid          If left blank, a default value of 6371009.0 metres will
     *                                                                   be used for the Earth Mean Radius for the calculation;
     *                                                               If a reference ellipsoid is specified, the Authalic Radius
     *                                                                   for that ellipsoid will be used.
     * @return    Geodetic_Distance              The great circle distance between this Lat/Long and the $endpoint Lat/Long
     * @throws    Geodetic_Exception
     */
    public function getDistanceHaversine(Geodetic_LatLong $endPoint,
                                         Geodetic_ReferenceEllipsoid $ellipsoid = NULL)
    {
        if (!is_null($ellipsoid)) {
            $earthMeanRadius = $ellipsoid->getAuthalicRadius();
        } else {
            $earthMeanRadius = 6371009.0; // metres
        }

        $deltaLatitude =  $endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS) -
            $this->_latitude->getValue(Geodetic_Angle::RADIANS);
        $deltaLongitude = $endPoint->getLongitude()->getValue(Geodetic_Angle::RADIANS) -
            $this->_longitude->getValue(Geodetic_Angle::RADIANS);
        $aValue = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) +
             cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                 cos($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)) *
             sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
        $cValue = 2 * atan2(sqrt($aValue), sqrt(1 - $aValue));

        return new Geodetic_Distance(
            $earthMeanRadius * $cValue
        );
    }

    /**
     * Get the distance between two Latitude/Longitude objects using the Vincenty formula
     *
     * The Vincenty Formula calculates the distance to your destination point based on the specified ellipsoid
     *
     * @param     Geodetic_LatLong               $endPoint    The destination point
     * @param     Geodetic_ReferenceEllipsoid    $ellipsoid
     * @return    Geodetic_Distance              The great circle distance between this Lat/Long and the $endpoint Lat/Long
     * @throws    Geodetic_Exception
     */
    public function getDistanceVincenty(Geodetic_LatLong $endPoint,
                                        Geodetic_ReferenceEllipsoid $ellipsoid = NULL)
    {
        if (is_null($ellipsoid))
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_84);

        $semiMinor = $ellipsoid->getSemiMinorAxis();
        $flattening = $ellipsoid->getFlattening();

        $lDifference = $this->_longitude->getValue(Geodetic_Angle::RADIANS) -
            $endPoint->getLongitude()->getValue(Geodetic_Angle::RADIANS);

        $U1Value = atan((1 - $flattening) * tan($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)));
        $U2Value = atan((1 - $flattening) * tan($this->_latitude->getValue(Geodetic_Angle::RADIANS)));

        $sinU1 = sin($U1Value);
        $cosU1 = cos($U1Value);
        $sinU2 = sin($U2Value);
        $cosU2 = cos($U2Value);

        $lambda = $lDifference;
        $lambdaP = 2 * M_PI;
        $iterLimit = 20;
        while(abs($lambda - $lambdaP) > 1E-12 && $iterLimit>0) {
            $sinLambda = sin($lambda);
            $cosLambda = cos($lambda);
            $sinSigma = sqrt(
                ($cosU2 * $sinLambda) * ($cosU2 * $sinLambda) +
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda) *
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda)
            );
            if ($sinSigma == 0.0)  //  co-incident points
                return new Geodetic_Distance();

            $cosSigma = $sinU1 * $sinU2 + $cosU1 * $cosU2 * $cosLambda;
            $sigma = atan2($sinSigma, $cosSigma);
            $alpha = asin($cosU1 * $cosU2 * $sinLambda / $sinSigma);
            $cosSqAlpha = cos($alpha) * cos($alpha);
            $cos2SigmaM = $cosSigma - 2 * $sinU1 * $sinU2 / $cosSqAlpha;
            $cValue = $flattening / 16 * $cosSqAlpha * (4 + $flattening * (4 - 3 * $cosSqAlpha));
            $lambdaP = $lambda;
            $lambda = $lDifference + (1 - $cValue) * $flattening * sin($alpha) *
                ($sigma + $cValue * $sinSigma * (
                    $cos2SigmaM + $cValue * $cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM))
                );
        }

        $uSq = $cosSqAlpha * $ellipsoid->getSecondEccentricitySquared();
        $aValue = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $bValue = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));

        $deltaSigma = $bValue * $sinSigma * ($cos2SigmaM + $bValue / 4 *
            ($cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM)- $bValue / 6 * $cos2SigmaM *
            (-3 + 4 * $sinSigma * $sinSigma) * (-3 + 4 * $cos2SigmaM * $cos2SigmaM)));

        return new Geodetic_Distance(
            $semiMinor * $aValue * ($sigma - $deltaSigma)
        );
    }

    /**
     * Get the initial bearing for a great circle route between two Latitude/Longitude objects
     *
     * @param     Geodetic_LatLong    $endPoint    The destination point
     * @return    Geodetic_Angle      The initial bearing to reach $endPoint
     * @throws    Geodetic_Exception
     */
    public function getInitialBearing(Geodetic_LatLong $endPoint)
    {
        $deltaLongitude = $endPoint->getLongitude()->getValue(Geodetic_Angle::RADIANS) -
            $this->_longitude->getValue(Geodetic_Angle::RADIANS);

        $yValue = sin($deltaLongitude) * cos($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS));
        $xValue = cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
            sin($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)) -
            sin($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
            cos($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)) *
            cos($deltaLongitude);

        $bearing = atan2($yValue, $xValue);

        return new Geodetic_Angle(rad2deg($bearing) + 360 % 360);
    }

    /**
     * Get the final bearing for a great circle route between two Latitude/Longitude objects
     *
     * @param     Geodetic_LatLong    $endPoint    The destination point
     * @return    Geodetic_Angle      The final bearing when $endPoint is reached
     * @throws    Geodetic_Exception
     */
    public function getFinalBearing(Geodetic_LatLong $endPoint)
    {
        $initialBearing = $endPoint->getInitialBearing($this);
        $finalBearing = $initialBearing->getValue() + 180 % 360;

        return new Geodetic_Angle($finalBearing);
    }

    /**
     * Ensure that a latitude value falls within a valid range
     *
     * @param     float    $latitude    The latitude in radians
     * @return    float    The "fixed" latitude in radians
     */
    private static function _cleanLatitude($latitude)
    {
        if ($latitude > M_PI_2)
            $latitude -= M_PI;
        elseif ($latitude < -M_PI_2)
            $latitude += M_PI;

        return $latitude;
    }

    /**
     * Ensure that a longitude value falls within a valid range
     *
     * @param     float    $longitude    The longitude in radians
     * @return    float    The "fixed" longitude in radians
     */
    private static function _cleanLongitude($longitude)
    {
        if ($longitude > M_PI)
            $longitude -= 2 * M_PI;
        elseif ($longitude < -M_PI)
            $longitude += 2 * M_PI;

        return $longitude;
    }

    /**
     * Get the midpoint for a great circle route between two Latitude/Longitude objects
     *
     * @param     Geodetic_LatLong    $endPoint    The destination point
     * @return    Geodetic_LatLong    The midpoint Lat/Long between this Lat/Long and the $endpoint Lat/Long
     * @throws    Geodetic_Exception
     */
    public function getMidpoint(Geodetic_LatLong $endPoint)
    {
        $deltaLongitude = $endPoint->getLongitude()->getValue(Geodetic_Angle::RADIANS) -
            $this->_longitude->getValue(Geodetic_Angle::RADIANS);

        $xModified = cos($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)) *
            cos($deltaLongitude);
        $yModified = cos($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)) *
            sin($deltaLongitude);

        $midpointLatitude = atan2(
            sin($this->_latitude->getValue(Geodetic_Angle::RADIANS)) +
                sin($endPoint->getLatitude()->getValue(Geodetic_Angle::RADIANS)),
            sqrt((cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) + $xModified) *
                (cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) + $xModified) + $yModified * $yModified)
        );
        $midpointLongitude = $this->_longitude->getValue(Geodetic_Angle::RADIANS) +
            atan2($yModified, cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) + $xModified);

        return new Geodetic_LatLong(
            new Geodetic_LatLong_CoordinateValues(
                self::_cleanLatitude($midpointLatitude),
                self::_cleanLongitude($midpointLongitude),
                Geodetic_Angle::RADIANS
            )
        );
    }

    /**
     * Get the destination for a given initial bearing and distance along a great circle route
     *
     * @param     Geodetic_Angle                 $bearing      Initial bearing
     * @param     Geodetic_Distance              $distance     Distance to travel along the route
     * @param     Geodetic_ReferenceEllipsoid    $ellipsoid    If left blank, a default value of 6371009.0 metres will
     *                                                             be used for the Earth Mean Radius for the calculation;
     *                                                         If a reference ellipsoid is specified, the Authalic Radius for
     *                                                             that ellipsoid will be used.
     * @return    Geodetic_LatLong               The endpoint Lat/Long for a journey from this Lat/Long starting on a bearing
     *                                               of $bearing and travelling for $distance along a great circle route
     * @throws    Geodetic_Exception
     */
    public function getDestination(Geodetic_Angle $bearing,
                                   Geodetic_Distance $distance,
                                   Geodetic_ReferenceEllipsoid $ellipsoid = NULL)
    {
        if (!is_null($ellipsoid)) {
            $earthMeanRadius = $ellipsoid->getAuthalicRadius();
        } else {
            $earthMeanRadius = 6371009.0; // metres
        }

        $destinationLatitude = asin(
            sin($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                cos($distance->getValue() / $earthMeanRadius) +
            cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)) *
                sin($distance->getValue() / $earthMeanRadius) *
                cos($bearing->getValue(Geodetic_Angle::RADIANS))
        );
        $destinationLongitude = $this->_longitude->getValue(Geodetic_Angle::RADIANS) +
            atan2(
                sin($bearing->getValue(Geodetic_Angle::RADIANS)) *
                    sin($distance->getValue() / $earthMeanRadius) *
                    cos($this->_latitude->getValue(Geodetic_Angle::RADIANS)),
                cos($distance->getValue() / $earthMeanRadius) -
                    sin($this->_latitude->getValue(Geodetic_Angle::RADIANS)) * sin($destinationLatitude)
            );

        return new Geodetic_LatLong(
            new Geodetic_LatLong_CoordinateValues(
                self::_cleanLatitude($destinationLatitude),
                self::_cleanLongitude($destinationLongitude),
                Geodetic_Angle::RADIANS
            )
        );
    }

}
