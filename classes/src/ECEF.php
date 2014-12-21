<?php

namespace Geodetic;

/**
 * Earth-Centered, Earth-Fixed coordinate object.
 *
 *  An ECEF Object represents an Earth-Centered, Earth-Fixed set of Cartesian coordinates.
 *  The point (0,0,0) is defined as the center of mass of the earth (hence the expression Earth-Centered).
 *  Its axes are aligned with the International Reference Pole (IRP) and International Reference Meridian (IRM)
 *  that are fixed with respect to the surface of the Earth (hence the expression Earth-Fixed).
 *
 *  The z-axis is pointing towards the north but it does not coincide exactly with the instantaneous Earth
 *  rotational axis.
 *  The x-axis intersects the sphere of the earth at 0° latitude (Equator) and 0° longitude (Greenwich).
 *  This means that ECEF rotates with the earth and therefore, coordinates of a point fixed on the surface of
 *  the earth do not change.
 *
 *  -    Description modified from the Wikipedia article at
 *           http://en.wikipedia.org/wiki/ECEF
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class ECEF
{
    /**
     * The x-coordinate value of this ECEF object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $_xCoordinate;

    /**
     * The y-coordinate value of this ECEF object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $_yCoordinate;

    /**
     * The z-coordinate value of this ECEF object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $_zCoordinate;


    /**
     * Helper method to return the sine squared value
     *
     * @param     int|float    $value    The value on which to perform the calculation
     * @return    float        The sine squared result
     */
    private static function _sinSquared($value) {
        return sin($value) * sin($value);
    }

    /**
     * Create a new ECEF
     *
     * @param     XyzFormat_Interface    $xyzCoordinates    The ECEF X-, Y-, and Z-Coordinate values
     * @throws    Exception
     */
    public function __construct(XyzFormat_Interface $xyzCoordinates = null)
    {
        if (!is_null($xyzCoordinates)) {
            $this->_xCoordinate = $xyzCoordinates->getX();
            $this->_yCoordinate = $xyzCoordinates->getY();
            $this->_zCoordinate = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->_xCoordinate = new Distance();
        $this->_yCoordinate = new Distance();
        $this->_zCoordinate = new Distance();
    }


    /**
     * Set the Distance from earth centre on the X-Axis
     *
     * @param     Distance    $xDistance    The Distance from earth centre on the X-Axis
     * @return    ECEF
     * @throws    Exception
     */
    public function setX(Distance $xDistance = null)
    {
        if (is_null($xDistance)) {
            throw new Exception('The Distance on the X-Axis must be a Distance object');
        }
        $this->_xCoordinate = $xDistance;

        return $this;
    }

    /**
     * Get the Distance from earth centre on the X-Axis
     *
     * @return    Distance    The Distance from earth centre on the X-Axis
     */
    public function getX()
    {
        return $this->_xCoordinate;
    }

    /**
     * Set the Distance from earth centre on the Y-Axis
     *
     * @param     Distance    $yDistance    The Distance from earth centre on the Y-Axis
     * @return    ECEF
     * @throws    Exception
     */
    public function setY(Distance $yDistance = null)
    {
        if (is_null($yDistance)) {
            throw new Exception('The Distance on the Y-Axis must be a Distance object');
        }
        $this->_yCoordinate = $yDistance;

        return $this;
    }

    /**
     * Get the Distance from earth centre on the Y-Axis
     *
     * @return    Distance    The Distance from earth centre on the Y-Axis
     */
    public function getY()
    {
        return $this->_yCoordinate;
    }

    /**
     * Set the Distance from earth centre on the Z-Axis
     *
     * @param     Distance    $zDistance    The Distance from earth centre on the Z-Axis
     * @return    ECEF
     * @throws    Exception
     */
    public function setZ(Distance $zDistance = null)
    {
        if (is_null($zDistance)) {
            throw new Exception('The Distance on the Z-Axis must be a Distance object');
        }
        $this->_zCoordinate = $zDistance;

        return $this;
    }

    /**
     * Get the Distance from earth centre on the Z-Axis
     *
     * @return    Distance    The Distance from earth centre on the Z-Axis
     */
    public function getZ()
    {
        return $this->_zCoordinate;
    }

    /**
     * Convert this ECEF to a Latitude/Longitude LatLong object using a specified Datum
     *
     * @param     Datum      $datum    The Datum to use for this transform
     * @return    LatLong    The Latitude/Longitude LatLong object that matches this ECEF
     * @throws    Exception
     */
    public function toLatLong(Datum $datum = null)
    {
        if (is_null($datum)) {
            throw new Exception('You must specify a datum to use for this conversion');
        }

        $ellipsoid = $datum->getReferenceEllipsoid();

        $pValue = sqrt(
            ($this->_xCoordinate->getValue() * $this->_xCoordinate->getValue()) +
            ($this->_yCoordinate->getValue() * $this->_yCoordinate->getValue())
        );

        $lat = atan2(
            $this->_zCoordinate->getValue(),
            $pValue * (1 - $ellipsoid->getFirstEccentricitySquared())
        );
        $tempLat = 2 * M_PI;
        while (abs($lat - $tempLat) > 4) { // Accuracy to about 4 metres
            $vValue = $ellipsoid->getSemiMajorAxis() /
                (sqrt(1 - $ellipsoid->getFirstEccentricitySquared() * self::_sinSquared($lat)));
            $tempLat = $lat;
            $lat = atan2(
                $this->_zCoordinate->getValue() +
                    $ellipsoid->getFirstEccentricitySquared() * $vValue * sin($lat),
                $pValue
            );
        }
        $long = atan2($this->_yCoordinate->getValue(), $this->_xCoordinate->getValue());
        $height = $pValue / cos($lat) - $vValue;

        $latLongCoordinates = new LatLong_CoordinateValues(
            $lat,
            $long,
            Angle::RADIANS,
            $height,
            Distance::METRES
        );
        return new LatLong($latLongCoordinates);
    }


    /**
     * Execute a Helmert Transform on this ECEF using the specified Bursa-Wolf Parameters
     *
     * @param     BursaWolfParameters    $bursaWolfParameters    The Bursa-Wolf parameter to use for the transform
     * @return    void
     * @throws    Exception
     */
    private function _helmertTransform(BursaWolfParameters $bursaWolfParameters)
    {
        $ppmScaling = 1 + $bursaWolfParameters->getScaleFactor() / 1000000;

        $xCoordinate = $bursaWolfParameters->getTranslationVectors()->getX()->getValue() +
            ($this->_xCoordinate->getValue() * $ppmScaling) +
            (-$bursaWolfParameters->getRotationMatrix()->getX()->getValue(Angle::RADIANS) *
                $this->_yCoordinate->getValue()) +
            ($bursaWolfParameters->getRotationMatrix()->getY()->getValue(Angle::RADIANS) *
                $this->_zCoordinate->getValue());
        $yCoordinate = $bursaWolfParameters->getTranslationVectors()->getY()->getValue() +
            ($bursaWolfParameters->getRotationMatrix()->getZ()->getValue(Angle::RADIANS) *
                $this->_xCoordinate->getValue()) +
            ($this->_yCoordinate->getValue() * $ppmScaling) +
            (-$bursaWolfParameters->getRotationMatrix()->getX()->getValue(Angle::RADIANS) *
                $this->_zCoordinate->getValue());
        $zCoordinate = $bursaWolfParameters->getTranslationVectors()->getZ()->getValue() +
            (-$bursaWolfParameters->getRotationMatrix()->getY()->getValue(Angle::RADIANS) *
                $this->_xCoordinate->getValue()) +
            ($bursaWolfParameters->getRotationMatrix()->getX()->getValue(Angle::RADIANS) *
                $this->_yCoordinate->getValue()) +
            ($this->_zCoordinate->getValue() * $ppmScaling);

        $this->_xCoordinate->setValue($xCoordinate);
        $this->_yCoordinate->setValue($yCoordinate);
        $this->_zCoordinate->setValue($zCoordinate);
    }

    /**
     * Transform this ECEF from the specified Datum to WGS84
     *
     * @param     Datum      $fromDatum    The Datum to convert this ECEF from
     * @return    ECEF
     * @throws    Exception
     */
    public function toWGS84(Datum $fromDatum = null)
    {
        if (is_null($fromDatum)) {
            throw new Exception('You must specify a datum to use for this conversion');
        }

        $bursaWolfParameters = $fromDatum->getBursaWolfParameters();
        $this->_helmertTransform($bursaWolfParameters);
    }

    /**
     * Transform this ECEF to the specified Datum from WGS84
     *
     * @param     Datum      $toDatum    The Datum to convert that ECEF from
     * @return    ECEF
     * @throws    Exception
     */
    public function fromWGS84(Datum $toDatum = null)
    {
        if (is_null($toDatum)) {
            throw new Exception('You must specify a datum to use for this conversion');
        }
        $bursaWolfParameters = clone $toDatum->getBursaWolfParameters();
        $bursaWolfParameters->invert();
        $this->_helmertTransform($bursaWolfParameters);
    }
}
