<?php

/**
 *  Latitude/Longitude coordinate object.
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
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_LatLong
{

    /**
     *  The Latitude value of this LatLong object.
     *  This value will always be maintained internally in degrees (°)
     *
     *  @access protected
     *  @var Geodetic_Angle
     */
    protected $_latitude;

    /**
     *  The Longitude value of this LatLong object.
     *  This value will always be maintained internally in degrees (°)
     *
     *  @access protected
     *  @var Geodetic_Angle
     */
    protected $_longitude;

    /**
     *  The Height value of this LatLong object.
     *  This value will always be maintained internally in meters (m)
     *
     *  @access protected
     *  @var Geodetic_Distance
     */
    protected $_height;


    /**
     * Create a new LatLong
     *
     *  @param     Geodetic_XyzFormat_Interface    $xyzCoordinates    The LatLong Latitude, Longitude and
     *                                                                    Height/Elevation values expressed as X, Y and Z values
     *  @throws    Geodetic_Exception
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
     *  Set the Latitude
     *
     *  @param     Geodetic_Angle    $latitudeObj    The Latitude
     *  @return    Geodetic_LatLong
     *  @throws    Geodetic_Exception
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
     *  Get the Latitude as a Geodetic_Angle object
     *
     *  @return    Geodetic_Angle    The Latitude
     */
    public function getLatitude()
    {
        return $this->_latitude;
    }

    /**
     *  Set the Longitude
     *
     *  @param     Geodetic_Angle    $longitudeObj    The Longitude
     *  @return    Geodetic_LatLong
     *  @throws    Geodetic_Exception
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
     *  Get the Longitude as a Geodetic_Angle object
     *
     *  @return    Geodetic_Angle    The Longitude
     */
    public function getLongitude()
    {
        return $this->_longitude;
    }

    /**
     *  Set the Height
     *
     *  @param     Geodetic_Distance    $heightObj    The Height
     *  @return    Geodetic_LatLong
     *  @throws    Geodetic_Exception
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
     *  Get the Height as a Geodetic_Distance object
     *
     *  @return    Geodetic_Distance    The Height
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     *  Validate a latitude, and return its value in radians
     *
     *  @public
     *  @param     integer|float    $latitude    Angle of Latitude for the Radius of Curvature
     *  @param     string           $degRad      Indicating whether the Angle of Latitude is being specified
     *                                               in degrees or radians
     *  @return    float            The specified latitude in radians
     *  @throws    Geodetic_Exception
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
     *  Validate a longitude, and return its value in radians
     *
     *  @public
     *  @param     integer|float    $longitude    Angle of Longitude for the Radius of Curvature
     *  @param     string           $degRad       Indicating whether the Angle of Longitude is being specified
     *                                                in degrees or radians
     *  @return    float            The specified longitude in radians
     *  @throws    Geodetic_Exception
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
     *  Convert this Latitude/Longitude to an Earth-Centric Earth-Fixed Geodetic_ECEF object using a specified Datum
     *
     *  @param     Geodetic_Datum    $datum    The Datum to use for this transform
     *  @return    Geodetic_ECEF     The Earth-Centric Earth-Fixed Geodetic_ECEF object that matches this Latitude/Longitude
     *  @throws    Geodetic_Exception
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

}
