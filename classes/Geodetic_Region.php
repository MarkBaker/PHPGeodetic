<?php

/**
 * Region coordinate object.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Region
{

    /**
     * An array of Latitude/Longitude points that defines the region
     *
     * @access protected
     * @var Geodetic_Angle[]
     */
    protected $_perimeterPoints;


    /**
     * Create a new Region
     *
     * @param     Geodetic_LatLong[]    $perimeterPoints
     * @throws    Geodetic_Exception
     */
    function __construct(array $perimeterPoints = array())
    {
        $this->setPerimeterPoints($perimeterPoints);
    }

    /**
     * Set the perimeter points that define this region
     *
     * @param     Geodetic_LatLong[]    $perimeterPoints
     * @return    Geodetic_Region
     * @throws    Geodetic_Exception
     */
    public function setPerimeterPoints(array $perimeterPoints = array())
    {
        if ((count($perimeterPoints) > 0) && (count($perimeterPoints) < 3)) {
            throw new Geodetic_Exception('A region must be defined by at least 3 perimeter points');
        }
        foreach($perimeterPoints as $perimeterPoint) {
            if (!($perimeterPoint instanceof Geodetic_LatLong)) {
                throw new Geodetic_Exception('Each perimeter point must be a Geodetic_LatLong object');
            }
        }

        $this->_perimeterPoints = $perimeterPoints;

        return $this;
    }

    /**
     * Get the Perimeter Points that define this region
     *
     * @return    Geodetic_LatLong[]    Array of Latitude/Longitude objects that define the perimeter of this region
     */
    public function getPerimeterPoints()
    {
        return $this->_perimeterPoints;
    }

    /**
     * Helper method to adjust haversine values
     *
     * @param     int|float    $x    The value on which to perform the calculation
     * @return    float        The adjusted haversine result
     */
    private static function _haversineAdjust($x)
    {
        return (1.0 - cos($x)) / 2.0;
    }

    /**
     * Get the Planar Area of this region
     *
     * @param     Geodetic_ReferenceEllipsoid|NULL    $ellipsoid    Reference Ellipsoid to use for this calculation
     *                                                              If NULL, then the WGS 1984 Ellipsoid will be used
     * @return    Geodetic_Area    The planar area of this region
     */
    public function getAreaPlanar(Geodetic_ReferenceEllipsoid $ellipsoid = NULL)
    {
        $pointCount = count($this->_perimeterPoints);
        if ($pointCount == 0)
            return new Geodetic_Area();

        if (is_null($ellipsoid)) {
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);
        }
        $radius = $ellipsoid->getSemiMajorAxis();

        $area = 0;
        for($j = 0; $j < $pointCount; ++$j) {
            $k = $j + 1;
            if ($j == 0) {
                $lambda1 = $this->_perimeterPoints[$j]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
                $beta1 = $this->_perimeterPoints[$j]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
                $lambda2 = $this->_perimeterPoints[$k]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
                $beta2 = $this->_perimeterPoints[$k]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
                $cosB1 = cos($beta1);
                $cosB2 = cos($beta2);
            } else {
                $k = ($j+1) % $pointCount;
                $lambda1 = $lambda2;
                $beta1 = $beta2;
                $lambda2 = $this->_perimeterPoints[$k]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
                $beta2 = $this->_perimeterPoints[$k]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
                $cosB1 = $cosB2;
                $cosB2 = cos($beta2);
            }
            if ($lambda1 != $lambda2) {
                $haversine = self::_haversineAdjust($beta2 - $beta1) +
                    $cosB1 * $cosB2 * self::_haversineAdjust($lambda2 - $lambda1);
                $a = 2 * asin(sqrt($haversine));
                $b = M_PI / 2 - $beta2;
                $c = M_PI / 2 - $beta1;
                $s = 0.5 * ($a + $b + $c);
                $t = tan($s / 2) * tan(($s - $a) / 2) * tan(($s - $b) / 2) * tan(($s - $c) / 2);

                $excess = abs(4 * atan(sqrt(abs($t))));

                if ($lambda2 < $lambda1) {
                    $excess = -$excess;
                }
                $area += $excess;
            }
        }

        return new Geodetic_Area(
            abs($area) * $radius * $radius
        );
    }

    /**
     * Get the Planar Area of this region
     *
     * @return    float    The planar area of this region in degrees squared
     */
    private function _getAreaPlanarDegrees()
    {
        $pointCount = count($this->_perimeterPoints);

        $area = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $area += (($this->_perimeterPoints[$i]->getLongitude()->getValue() *
                       $this->_perimeterPoints[$j]->getLatitude()->getValue()) -
                      ($this->_perimeterPoints[$j]->getLongitude()->getValue() *
                       $this->_perimeterPoints[$i]->getLatitude()->getValue())
                     );
        }

        return $area / 2;
    }

    /**
     * Get the Planar Centre Point of this region
     *
     * @return    Geodetic_LatLong    The planar centre point of this region
     * @throws    Geodetic_Exception
     */
    public function getCentrePointPlanar()
    {
        $pointCount = count($this->_perimeterPoints);
        if ($pointCount == 0)
            throw new Geodetic_Exception('Area is not defined, so cannot have a centre point');

        $cLong = $cLat = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $cTemp = (($this->_perimeterPoints[$i]->getLongitude()->getValue() *
                       $this->_perimeterPoints[$j]->getLatitude()->getValue()) -
                      ($this->_perimeterPoints[$j]->getLongitude()->getValue() *
                       $this->_perimeterPoints[$i]->getLatitude()->getValue())
                     );
            $cLat +=  ($this->_perimeterPoints[$i]->getLatitude()->getValue() +
                       $this->_perimeterPoints[$j]->getLatitude()->getValue()) *
                      $cTemp;
            $cLong += ($this->_perimeterPoints[$i]->getLongitude()->getValue() +
                       $this->_perimeterPoints[$j]->getLongitude()->getValue()) *
                      $cTemp;
        }

        $area = $this->_getAreaPlanarDegrees();
        $areaAdjust = 1 / (6 * $area);
        $cLat *= $areaAdjust;
        $cLong *= $areaAdjust;

        return new Geodetic_LatLong(
            new Geodetic_LatLong_CoordinateValues(
                $cLat,
                $cLong,
                Geodetic_Angle::DEGREES
            )
        );
    }

    /**
     * Get the Area of this region
     *
     * @param     Geodetic_ReferenceEllipsoid|NULL    $ellipsoid    Reference Ellipsoid to use for this calculation
     *                                                              If NULL, then the WGS 1984 Ellipsoid will be used
     * @return    Geodetic_Area    The area of this region
     */
    public function getArea(Geodetic_ReferenceEllipsoid $ellipsoid = NULL)
    {
        $pointCount = count($this->_perimeterPoints);
        if ($pointCount == 0)
            return new Geodetic_Area();

        if (is_null($ellipsoid)) {
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);
        }
        $radius1 = $ellipsoid->getSemiMajorAxis();
        $radius2 = $ellipsoid->getSemiMinorAxis();

        $area = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $h = ($i-1) % $pointCount;
            if ($h < 0)
                $h += $pointCount;
            $area += ($this->_perimeterPoints[$j]->getLongitude()->getValue(Geodetic_Angle::RADIANS) -
                      $this->_perimeterPoints[$h]->getLongitude()->getValue(Geodetic_Angle::RADIANS)) *
                     sin($this->_perimeterPoints[$i]->getLatitude()->getValue(Geodetic_Angle::RADIANS));
        }

        return new Geodetic_Area(
            abs($area * $radius1 * $radius2 / 2)
        );
    }

    /**
     * Get the length along the Perimeter for this region
     *
     * @param     Geodetic_ReferenceEllipsoid|NULL    $ellipsoid       Reference Ellipsoid to use for this calculation
     *                                                                     If NULL, then the WGS 1984 Ellipsoid will be used
     * @param     boolean                             $useHaversine    If true, then the Haversine formula will be used
     *                                                                     for the calculation, otherwise the more accurate
     *                                                                     Vincenty formula will be used instead.
     * @return    Geodetic_Distance    The length along the perimeter for this region
     */
    public function getPerimeter(Geodetic_ReferenceEllipsoid $ellipsoid = NULL,
                                 $useHaversine = FALSE)
    {
        $pointCount = count($this->_perimeterPoints);
        if ($pointCount == 0)
            return new Geodetic_Area();

        if (is_null($ellipsoid)) {
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);
        }

        $distance = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            if ($useHaversine) {
                $distance += $this->_perimeterPoints[$i]->getDistanceHaversine(
                    $this->_perimeterPoints[$j],
                    $ellipsoid
                )->getValue();
            } else {
                $distance += $this->_perimeterPoints[$i]->getDistanceVincenty(
                    $this->_perimeterPoints[$j],
                    $ellipsoid
                )->getValue();
            }
        }

        return new Geodetic_Distance(
            $distance
        );
    }

    /**
     * Identify whether a specified Latitude/Longitude falls within the bounds of this region
     *
     * @param     Geodetic_LatLong    The Latitude/Longitude object that we wish to test
     * @return    boolean
     */
    function isInRegion(Geodetic_LatLong $position)
    {
        $latitude = $position->getLatitude()->getValue();
        $longitude = $position->getLongitude()->getValue();
        $perimeterNodeCount = count($this->_perimeterPoints);

        $jIndex = $perimeterNodeCount - 1 ;
        $oddNodes = FALSE;
        for ($iIndex = 0; $iIndex < $perimeterNodeCount; ++$iIndex) {
            $iLatitude = $this->_perimeterPoints[$iIndex]->getLatitude()->getValue();
            $jLatitude = $this->_perimeterPoints[$jIndex]->getLatitude()->getValue();

            if (($iLatitude < $latitude && $jLatitude >= $latitude) ||
                ($jLatitude < $latitude && $iLatitude >= $latitude)) {
                $iLongitude = $this->_perimeterPoints[$iIndex]->getLongitude()->getValue();
                $jLongitude = $this->_perimeterPoints[$jIndex]->getLongitude()->getValue();

                if ($iLongitude +
                    ($latitude - $iLatitude) /
                    ($jLatitude - $iLatitude) * ($jLongitude - $iLongitude) < $longitude) {
                    $oddNodes = !$oddNodes;
                }
            }
            $jIndex = $iIndex;
        }

        return $oddNodes;
    }

}
