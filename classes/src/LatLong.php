<?php

namespace Geodetic;

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
class LatLong
{

    /**
     * The Latitude value of this LatLong object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Angle
     */
    protected $latitude;

    /**
     * The Longitude value of this LatLong object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Angle
     */
    protected $longitude;

    /**
     * The Height value of this LatLong object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $height;


    /**
     * Create a new LatLong
     *
     * @param     Base\XyzFormat    $xyzCoordinates    The LatLong Latitude, Longitude and
     *                                                     Height/Elevation values expressed as X, Y and Z values
     * @throws    Exception
     */
    public function __construct(Base\XyzFormat $xyzCoordinates = null)
    {
        if (!is_null($xyzCoordinates)) {
            $this->latitude = $xyzCoordinates->getX();
            $this->longitude = $xyzCoordinates->getY();
            $this->height = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->latitude = new Angle();
        $this->longitude = new Angle();
        $this->height = new Distance();
    }


    /**
     * Set the Latitude
     *
     * @param     Angle    $latitudeObj    The Latitude
     * @return    LatLong
     * @throws    Exception
     */
    public function setLatitude(Angle $latitudeObj = null)
    {
        if (is_null($latitudeObj)) {
            throw new Exception('The Latitude must be a Angle object');
        }
        $this->latitude = $latitudeObj;

        return $this;
    }

    /**
     * Get the Latitude as a Angle object
     *
     * @return    Angle    The Latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the Longitude
     *
     * @param     Angle    $longitudeObj    The Longitude
     * @return    LatLong
     * @throws    Exception
     */
    public function setLongitude(Angle $longitudeObj = null)
    {
        if (is_null($longitudeObj)) {
            throw new Exception('The Longitude must be a Angle object');
        }
        $this->longitude = $longitudeObj;

        return $this;
    }

    /**
     * Get the Longitude as a Angle object
     *
     * @return    Angle    The Longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the Height
     *
     * @param     Distance    $heightObj    The Height
     * @return    LatLong
     * @throws    Exception
     */
    public function setHeight(Distance $heightObj = null)
    {
        if (is_null($heightObj)) {
            throw new Exception('The Height must be a Distance object');
        }
        $this->height = $heightObj;

        return $this;
    }

    /**
     * Get the Height as a Distance object
     *
     * @return    Distance    The Height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Validate a latitude, and return its value in radians
     *
     * @public
     * @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature
     * @param     string           $degrad      Indicating whether the Angle of Latitude is being specified
     *                                              in degrees or radians
     * @return    float            The specified latitude in radians
     * @throws    Exception
     */
    public static function validateLatitude($latitude = null, $degrad = Angle::DEGREES)
    {
        if (is_null($latitude)) {
            throw new Exception('You must specify Latitude');
        } elseif (!is_numeric($latitude)) {
            throw new Exception('Latitude must be a numeric value');
        } elseif (is_null($degrad)) {
            $degrad = Angle::DEGREES;
        }

        $latitude = ($degrad == Angle::DEGREES) ? deg2rad($latitude) : $latitude;

        if (($latitude < (-M_PI)) || ($latitude > (M_PI))) {
            throw new Exception('Latitude is out of range');
        }

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
     * @throws    Exception
     */
    public static function validateLongitude($longitude = null, $degrad = Angle::DEGREES)
    {
        if (is_null($longitude)) {
            throw new Exception('You must specify Longitude');
        } elseif (!is_numeric($longitude)) {
            throw new Exception('Longitude must be a numeric value');
        } elseif (is_null($degrad)) {
            $degrad = Angle::DEGREES;
        }

        $longitude = ($degrad == Angle::DEGREES) ? deg2rad($longitude) : $longitude;

        if (($longitude < (-M_PI * 2)) || ($longitude > (M_PI * 2))) {
            throw new Exception('Longitude is out of range');
        }

        return $longitude;
    }

    /**
     * Convert this Latitude/Longitude to an Earth-Centric Earth-Fixed ECEF object using a specified Datum
     *
     * @param     Datum    $datum    The Datum to use for this transform
     * @return    ECEF     The Earth-Centric Earth-Fixed ECEF object that matches this Latitude/Longitude
     * @throws    Exception
     */
    public function toECEF(Datum $datum = null)
    {
        if (is_null($datum)) {
            throw new Exception('You must specify a datum to use for this conversion');
        }

        $ellipsoid = $datum->getReferenceEllipsoid();

        $phi = $this->latitude->getValue(Angle::RADIANS);
        $lambda = $this->longitude->getValue(Angle::RADIANS);
        $radiusOfCurvature = $ellipsoid->getRadiusOfCurvaturePrimeVertical($phi, Angle::RADIANS);

        $xCoordinate = ($radiusOfCurvature + $this->height->getValue()) * cos($phi) * cos($lambda);
        $yCoordinate = ($radiusOfCurvature + $this->height->getValue()) * cos($phi) * sin($lambda);
        $zCoordinate = ((1 - $ellipsoid->getFirstEccentricitySquared()) * $radiusOfCurvature +
            $this->height->getValue()) * sin($phi);

        $ecefCoordinates = new ECEF\CoordinateValues(
            $xCoordinate,
            $yCoordinate,
            $zCoordinate
        );
        return new ECEF($ecefCoordinates);
    }

    /**
     * Convert this Latitude/Longitude to a Univeral Transverse Mercator UTM object using a specified Datum
     *
     * @param     Datum    $datum    The Datum to use for this transform
     * @return    UTF      The Univeral Transverse Mercator UTM object that matches this Latitude/Longitude
     * @throws    Exception
     */
    public function toUTM(Datum $datum = null)
    {
        if (is_null($datum)) {
            throw new Exception('You must specify a datum to use for this conversion');
        }

        $ellipsoid = $datum->getReferenceEllipsoid();
        $eSquared = $ellipsoid->getFirstEccentricitySquared();
        $eSquared2 = $eSquared * $eSquared;
        $eSquared3 = $eSquared * $eSquared * $eSquared;

        $utmF0 = 0.9996;

        $utmLongitudeZone = UTM::identifyLongitudeZone(
            $this->latitude->getValue(),
            $this->longitude->getValue()
        );
        $utmLatitudeZone = UTM::identifyLatitudeZone($this->latitude->getValue());
        $longitudeOrigin = Angle::convertFromDegrees(
            ($utmLongitudeZone - 1) * 6 - 180 + 3,
            Angle::RADIANS
        );

        $ePrimeSquared = ($eSquared) / (1 - $eSquared);

        $nValue = $ellipsoid->getSemiMajorAxis() /
            sqrt(
                1 - $eSquared *
                sin($this->latitude->getValue(Angle::RADIANS)) *
                sin($this->latitude->getValue(Angle::RADIANS))
            );
        $tValue = tan($this->latitude->getValue(Angle::RADIANS)) *
                  tan($this->latitude->getValue(Angle::RADIANS));
        $cValue = $ePrimeSquared *
                  cos($this->latitude->getValue(Angle::RADIANS)) *
                  cos($this->latitude->getValue(Angle::RADIANS));
        $aValue = cos($this->latitude->getValue(Angle::RADIANS)) *
                  ($this->longitude->getValue(Angle::RADIANS) - $longitudeOrigin);

        $mValue = $ellipsoid->getSemiMajorAxis() * (
            (1 - $eSquared / 4 - 3 * $eSquared2 / 64 - 5 * $eSquared3 / 256) *
            $this->latitude->getValue(Angle::RADIANS) -
                (3 * $eSquared / 8 + 3 * $eSquared2 / 32 + 45 * $eSquared3 / 1024) *
            sin(2 * $this->latitude->getValue(Angle::RADIANS)) +
                (15 * $eSquared2 / 256 + 45 * $eSquared3 / 1024) *
            sin(4 * $this->latitude->getValue(Angle::RADIANS)) -
                (35 * $eSquared3 / 3072) * sin(6 * $this->latitude->getValue(Angle::RADIANS))
        );

        $UTMEasting = ($utmF0 * $nValue * ($aValue + (1 - $tValue + $cValue) * pow($aValue, 3.0) / 6 +
                      (5 - 18 * $tValue + $tValue * $tValue + 72 * $cValue - 58 * $ePrimeSquared) *
                      pow($aValue, 5.0) / 120) + 500000.0);

        $UTMNorthing = ($utmF0 * ($mValue + $nValue * tan($this->latitude->getValue(Angle::RADIANS)) *
                       ($aValue * $aValue / 2 + (5 - $tValue + (9 * $cValue) + (4 * $cValue * $cValue)) * pow($aValue, 4.0) / 24 +
                       (61 - (58 * $tValue) + ($tValue * $tValue) + (600 * $cValue) - (330 * $ePrimeSquared)) *
                       pow($aValue, 6.0) / 720)));

        // Adjust for the southern hemisphere
        if ($this->latitude->getValue(Angle::RADIANS) < 0) {
            $UTMNorthing += 10000000.0;
        }

        return new UTM(
            $UTMNorthing,
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
     * @param     LatLong               $endPoint           The destination point
     * @param     string                         $method             Distance::METHOD_HAVERSINE or Distance::METHOD_VINCENTY
     * @param     ReferenceEllipsoid    $ellipsoid          If left blank, a default value of 6371009.0 metres will
     *                                                                   be used for the Earth Mean Radius for the calculation;
     *                                                               If a reference ellipsoid is specified, the Authalic Radius
     *                                                                   for that ellipsoid will be used.
     * @return    Distance              The great circle distance between this Lat/Long and the $endpoint Lat/Long
     * @throws    Exception
     */
    public function getDistance(
        LatLong $endPoint,
        $method = Distance::METHOD_HAVERSINE,
        ReferenceEllipsoid $ellipsoid = null
    ) {
        if ($method == Distance::METHOD_HAVERSINE) {
            return $this->getDistanceHaversine($endPoint, $ellipsoid);
        } elseif ($method == Distance::METHOD_VINCENTY) {
            return $this->getDistanceVincenty($endPoint, $ellipsoid);
        }

        throw new Exception('Calculation method must be Vincenty or Haversine');
    }

     /**
     * Get the distance between two Latitude/Longitude objects using the Haversine formula
     *
     * The Haversine Formula calculates the distance to your destination point assuming a spherical Earth
     *
     * @param     LatLong               $endPoint           The destination point
     * @param     ReferenceEllipsoid    $ellipsoid          If left blank, a default value of 6371009.0 metres will
     *                                                                   be used for the Earth Mean Radius for the calculation;
     *                                                               If a reference ellipsoid is specified, the Authalic Radius
     *                                                                   for that ellipsoid will be used.
     * @return    Distance              The great circle distance between this Lat/Long and the $endpoint Lat/Long
     * @throws    Exception
     */
    public function getDistanceHaversine(LatLong $endPoint, ReferenceEllipsoid $ellipsoid = null)
    {
        if (!is_null($ellipsoid)) {
            $earthMeanRadius = $ellipsoid->getAuthalicRadius();
        } else {
            $earthMeanRadius = 6371009.0; // metres
        }

        $deltaLatitude =  $endPoint->getLatitude()->getValue(Angle::RADIANS) -
            $this->latitude->getValue(Angle::RADIANS);
        $deltaLongitude = $endPoint->getLongitude()->getValue(Angle::RADIANS) -
            $this->longitude->getValue(Angle::RADIANS);
        $aValue = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) +
             cos($this->latitude->getValue(Angle::RADIANS)) *
                 cos($endPoint->getLatitude()->getValue(Angle::RADIANS)) *
             sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
        $cValue = 2 * atan2(sqrt($aValue), sqrt(1 - $aValue));

        return new Distance(
            $earthMeanRadius * $cValue
        );
    }

    /**
     * Get the distance between two Latitude/Longitude objects using the Vincenty formula
     *
     * The Vincenty Formula calculates the distance to your destination point based on the specified ellipsoid
     *
     * @param     LatLong               $endPoint    The destination point
     * @param     ReferenceEllipsoid    $ellipsoid
     * @return    Distance              The great circle distance between this Lat/Long and the $endpoint Lat/Long
     * @throws    Exception
     */
    public function getDistanceVincenty(LatLong $endPoint, ReferenceEllipsoid $ellipsoid = null)
    {
        if (is_null($ellipsoid)) {
            $ellipsoid = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_84);
        }

        $semiMinor = $ellipsoid->getSemiMinorAxis();
        $flattening = $ellipsoid->getFlattening();

        $lDifference = $this->longitude->getValue(Angle::RADIANS) -
            $endPoint->getLongitude()->getValue(Angle::RADIANS);

        $U1Value = atan((1 - $flattening) * tan($endPoint->getLatitude()->getValue(Angle::RADIANS)));
        $U2Value = atan((1 - $flattening) * tan($this->latitude->getValue(Angle::RADIANS)));

        $sinU1 = sin($U1Value);
        $cosU1 = cos($U1Value);
        $sinU2 = sin($U2Value);
        $cosU2 = cos($U2Value);

        $lambda = $lDifference;
        $lambdaP = 2 * M_PI;
        $iterLimit = 20;
        while (abs($lambda - $lambdaP) > 1E-12 && $iterLimit>0) {
            $sinLambda = sin($lambda);
            $cosLambda = cos($lambda);
            $sinSigma = sqrt(
                ($cosU2 * $sinLambda) * ($cosU2 * $sinLambda) +
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda) *
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda)
            );
            if ($sinSigma == 0.0) { //  co-incident points
                return new Distance();
            }

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

        return new Distance(
            $semiMinor * $aValue * ($sigma - $deltaSigma)
        );
    }

    /**
     * Get the initial bearing for a great circle route between two Latitude/Longitude objects
     *
     * @param     LatLong    $endPoint    The destination point
     * @return    Angle      The initial bearing to reach $endPoint
     * @throws    Exception
     */
    public function getInitialBearing(LatLong $endPoint)
    {
        $deltaLongitude = $endPoint->getLongitude()->getValue(Angle::RADIANS) -
            $this->longitude->getValue(Angle::RADIANS);

        $yValue = sin($deltaLongitude) * cos($endPoint->getLatitude()->getValue(Angle::RADIANS));
        $xValue = cos($this->latitude->getValue(Angle::RADIANS)) *
            sin($endPoint->getLatitude()->getValue(Angle::RADIANS)) -
            sin($this->latitude->getValue(Angle::RADIANS)) *
            cos($endPoint->getLatitude()->getValue(Angle::RADIANS)) *
            cos($deltaLongitude);

        $bearing = atan2($yValue, $xValue);

        return new Angle(rad2deg($bearing) + 360 % 360);
    }

    /**
     * Get the final bearing for a great circle route between two Latitude/Longitude objects
     *
     * @param     LatLong    $endPoint    The destination point
     * @return    Angle      The final bearing when $endPoint is reached
     * @throws    Exception
     */
    public function getFinalBearing(LatLong $endPoint)
    {
        $initialBearing = $endPoint->getInitialBearing($this);
        $finalBearing = $initialBearing->getValue() + 180 % 360;

        return new Angle($finalBearing);
    }

    /**
     * Ensure that a latitude value falls within a valid range
     *
     * @param     float    $latitude    The latitude in radians
     * @return    float    The "fixed" latitude in radians
     */
    private static function cleanLatitude($latitude)
    {
        if ($latitude > M_PI_2) {
            $latitude -= M_PI;
        } elseif ($latitude < -M_PI_2) {
            $latitude += M_PI;
        }

        return $latitude;
    }

    /**
     * Ensure that a longitude value falls within a valid range
     *
     * @param     float    $longitude    The longitude in radians
     * @return    float    The "fixed" longitude in radians
     */
    private static function cleanLongitude($longitude)
    {
        if ($longitude > M_PI) {
            $longitude -= 2 * M_PI;
        } elseif ($longitude < -M_PI) {
            $longitude += 2 * M_PI;
        }

        return $longitude;
    }

    /**
     * Get the midpoint for a great circle route between two Latitude/Longitude objects
     *
     * @param     LatLong    $endPoint    The destination point
     * @return    LatLong    The midpoint Lat/Long between this Lat/Long and the $endpoint Lat/Long
     * @throws    Exception
     */
    public function getMidpoint(LatLong $endPoint)
    {
        $deltaLongitude = $endPoint->getLongitude()->getValue(Angle::RADIANS) -
            $this->longitude->getValue(Angle::RADIANS);

        $xModified = cos($endPoint->getLatitude()->getValue(Angle::RADIANS)) *
            cos($deltaLongitude);
        $yModified = cos($endPoint->getLatitude()->getValue(Angle::RADIANS)) *
            sin($deltaLongitude);

        $midpointLatitude = atan2(
            sin($this->latitude->getValue(Angle::RADIANS)) +
                sin($endPoint->getLatitude()->getValue(Angle::RADIANS)),
            sqrt((cos($this->latitude->getValue(Angle::RADIANS)) + $xModified) *
                (cos($this->latitude->getValue(Angle::RADIANS)) + $xModified) + $yModified * $yModified)
        );
        $midpointLongitude = $this->longitude->getValue(Angle::RADIANS) +
            atan2($yModified, cos($this->latitude->getValue(Angle::RADIANS)) + $xModified);

        return new LatLong(
            new LatLong\CoordinateValues(
                self::cleanLatitude($midpointLatitude),
                self::cleanLongitude($midpointLongitude),
                Angle::RADIANS
            )
        );
    }

    /**
     * Get the destination for a given initial bearing and distance along a great circle route
     *
     * @param     Angle                 $bearing      Initial bearing
     * @param     Distance              $distance     Distance to travel along the route
     * @param     ReferenceEllipsoid    $ellipsoid    If left blank, a default value of 6371009.0 metres will
     *                                                             be used for the Earth Mean Radius for the calculation;
     *                                                         If a reference ellipsoid is specified, the Authalic Radius for
     *                                                             that ellipsoid will be used.
     * @return    LatLong               The endpoint Lat/Long for a journey from this Lat/Long starting on a bearing
     *                                               of $bearing and travelling for $distance along a great circle route
     * @throws    Exception
     */
    public function getDestination(
        Angle $bearing,
        Distance $distance,
        ReferenceEllipsoid $ellipsoid = null
    ) {
        if (!is_null($ellipsoid)) {
            $earthMeanRadius = $ellipsoid->getAuthalicRadius();
        } else {
            $earthMeanRadius = 6371009.0; // metres
        }

        $destinationLatitude = asin(
            sin($this->latitude->getValue(Angle::RADIANS)) *
                cos($distance->getValue() / $earthMeanRadius) +
            cos($this->latitude->getValue(Angle::RADIANS)) *
                sin($distance->getValue() / $earthMeanRadius) *
                cos($bearing->getValue(Angle::RADIANS))
        );
        $destinationLongitude = $this->longitude->getValue(Angle::RADIANS) +
            atan2(
                sin($bearing->getValue(Angle::RADIANS)) *
                    sin($distance->getValue() / $earthMeanRadius) *
                    cos($this->latitude->getValue(Angle::RADIANS)),
                cos($distance->getValue() / $earthMeanRadius) -
                    sin($this->latitude->getValue(Angle::RADIANS)) * sin($destinationLatitude)
            );

        return new LatLong(
            new LatLong\CoordinateValues(
                self::cleanLatitude($destinationLatitude),
                self::cleanLongitude($destinationLongitude),
                Angle::RADIANS
            )
        );
    }

    /**
     * Get the nearest feature node to a specified position
     *
     * @param     Base\Feature    $pointSet    The series of points from which we want the nearest feature node
     * @param     string          $method      Distance::METHOD_HAVERSINE or Distance::METHOD_VINCENTY
     * @return    LatLong
     * @throws    Exception
     */
    public function getNearestNeighbour(Base\Feature $pointSet, $method = Distance::METHOD_HAVERSINE)
    {
        return $pointSet->getNearestNeighbour($this, $method);
    }
}
