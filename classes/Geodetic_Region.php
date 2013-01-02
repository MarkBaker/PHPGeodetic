<?php

/**
 * Region coordinate object.
 *
 * Regions can be used to represent enclosed geographic features such as islands, country borders and legislative
 *     boundaries and end at another point, rather than linear features such as roads and rivers that can be
 *     represented by the Geodetic_Line object.
 *
 * @package Geodetic
 * @subpackage Features
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
    protected $_nodePoints;


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

        $this->_nodePoints = $perimeterPoints;

        return $this;
    }

    /**
     * Get the Perimeter Points that define this region
     *
     * @return    Geodetic_LatLong[]    Array of Latitude/Longitude objects that define the perimeter of this region
     */
    public function getPerimeterPoints()
    {
        return $this->_nodePoints;
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
        $pointCount = count($this->_nodePoints);
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
                $lambda1 = $this->_nodePoints[$j]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
                $beta1 = $this->_nodePoints[$j]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
                $lambda2 = $this->_nodePoints[$k]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
                $beta2 = $this->_nodePoints[$k]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
                $cosB1 = cos($beta1);
                $cosB2 = cos($beta2);
            } else {
                $k = ($j+1) % $pointCount;
                $lambda1 = $lambda2;
                $beta1 = $beta2;
                $lambda2 = $this->_nodePoints[$k]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
                $beta2 = $this->_nodePoints[$k]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
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
     * Get the Signed Area of this region
     *
     * @return    float    The signed area of this region in degrees squared
     */
    private function _getSignedArea()
    {
        $pointCount = count($this->_nodePoints);

        $area = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $area += (($this->_nodePoints[$i]->getLongitude()->getValue() *
                       $this->_nodePoints[$j]->getLatitude()->getValue()) -
                      ($this->_nodePoints[$j]->getLongitude()->getValue() *
                       $this->_nodePoints[$i]->getLatitude()->getValue())
                     );
        }

        return $area / 2;
    }

    /**
     * Get the Planar Centre Point of this region
     *
     * @TODO regions that span the poles, or cross the dateline
     *
     * @return    Geodetic_LatLong    The planar centre point of this region
     * @throws    Geodetic_Exception
     */
    public function getCentrePointPlanar()
    {
        $pointCount = count($this->_nodePoints);
        if ($pointCount == 0)
            throw new Geodetic_Exception('Area is not defined, so cannot have a centre point');

        $cLong = $cLat = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $cTemp = (($this->_nodePoints[$i]->getLongitude()->getValue() *
                       $this->_nodePoints[$j]->getLatitude()->getValue()) -
                      ($this->_nodePoints[$j]->getLongitude()->getValue() *
                       $this->_nodePoints[$i]->getLatitude()->getValue())
                     );
            $cLat +=  ($this->_nodePoints[$i]->getLatitude()->getValue() +
                       $this->_nodePoints[$j]->getLatitude()->getValue()) *
                      $cTemp;
            $cLong += ($this->_nodePoints[$i]->getLongitude()->getValue() +
                       $this->_nodePoints[$j]->getLongitude()->getValue()) *
                      $cTemp;
        }

        $area = $this->_getSignedArea();
        if ($area == 0) {
            $areaAdjust = 1;
        } else {
            $areaAdjust = 1 / (6 * $area);
        }
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

    private function _Q($x)
    {
        $sinx = sin($x);
        $sinx2 = $sinx * $sinx;
        return $sinx * (1 + $sinx2 * ($this->QA + $sinx2 * ($this->QB + $sinx2 * $this->QC)));
    }

    private function _Qbar($x)
    {
        $cosx = cos($x);
        $cosx2 = $cosx * $cosx;
        return $cosx * ($this->QbarA + $cosx2 * ($this->QbarB + $cosx2 * ($this->QbarC + $cosx2 * $this->QbarD)));
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
        $pointCount = count($this->_nodePoints);
        if ($pointCount == 0)
            return new Geodetic_Area();

        if (is_null($ellipsoid)) {
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);
        }
        $semiMajorAxis = $ellipsoid->getSemiMajorAxis();
        $eccentricitySquared = $ellipsoid->getFirstEccentricitySquared();

        $eccentricity4 = $eccentricitySquared * $eccentricitySquared;
        $eccentricity6 = $eccentricity4 * $eccentricitySquared;
        $AE = $semiMajorAxis * $semiMajorAxis * (1 - $eccentricitySquared);
        $this->QA = (2.0 / 3.0) * $eccentricitySquared;
        $this->QB = (3.0 / 5.0) * $eccentricity4;
        $this->QC = (4.0 / 7.0) * $eccentricity6;
        $this->QbarA = -1.0 - (2.0 / 3.0) * $eccentricitySquared - (3.0 / 5.0) * $eccentricity4 - (4.0 / 7.0) * $eccentricity6;
        $this->QbarB = (2.0 / 9.0) * $eccentricitySquared + (2.0 / 5.0) * $eccentricity4 + (4.0 / 7.0) * $eccentricity6;
        $this->QbarC = -(3.0 / 25.0) * $eccentricity4 - (12.0 / 35.0) * $eccentricity6;
        $this->QbarD = (4.0 / 49.0) * $eccentricity6;
        $Qp = $this->_Q(M_PI_2);

        $earthSurfaceArea = 4 * M_PI * $Qp * $AE;
        if ($earthSurfaceArea < 0.0)
            $earthSurfaceArea = -$earthSurfaceArea;

        $pointCount--;
        $area = 0;

        $longitude2 = $this->_nodePoints[$pointCount]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
        $latitude2 = $this->_nodePoints[$pointCount]->getLatitude()->getValue(Geodetic_Angle::RADIANS);

        $Qbar2 = $this->_Qbar($latitude2);
        $area = 0.0;
        $n = 0;
        while ($n++ < $pointCount) {
            $longitude1 = $longitude2;
            $latitude1 = $latitude2;
            $Qbar1 = $Qbar2;
            $longitude2 = $this->_nodePoints[$n]->getLongitude()->getValue(Geodetic_Angle::RADIANS);
            $latitude2 = $this->_nodePoints[$n]->getLatitude()->getValue(Geodetic_Angle::RADIANS);
            $Qbar2 = $this->_Qbar($latitude2);
            if ($longitude1 > $longitude2) {
                while ($longitude1 - $longitude2 > M_PI) {
                    $longitude2 += M_PI + M_PI;
                }
            } elseif ($longitude2 > $longitude1) {
                while ($longitude2 - $longitude1 > M_PI) {
                    $longitude1 += M_PI + M_PI;
                }
            }
            $deltaLongitude = $longitude2 - $longitude1;
            $area += $deltaLongitude * ($Qp - $this->_Q($latitude2));
            if (($deltaLatitude = $latitude2 - $latitude1) != 0.0)
                $area += $deltaLongitude * $this->_Q($latitude2) - ($deltaLongitude / $deltaLatitude) * ($Qbar2 - $Qbar1);
        }
        if (($area *= $AE) < 0.0)
            $area = -$area;

        /*
         * kludge - if polygon circles the south pole the area will be computed as if it cirlced the north pole.
         * The correction is the difference between total surface area of the earth and the "north pole" area.
         */
        if ($area > $earthSurfaceArea)
            $area = $earthSurfaceArea;
        if ($area > $earthSurfaceArea / 2)
            $area = $earthSurfaceArea - $area;

        return new Geodetic_Area(
            $area
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
        $pointCount = count($this->_nodePoints);
        if ($pointCount == 0)
            return new Geodetic_Area();

        if (is_null($ellipsoid)) {
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);
        }

        $distance = 0;
        for($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            if ($useHaversine) {
                $distance += $this->_nodePoints[$i]->getDistanceHaversine(
                    $this->_nodePoints[$j],
                    $ellipsoid
                )->getValue();
            } else {
                $distance += $this->_nodePoints[$i]->getDistanceVincenty(
                    $this->_nodePoints[$j],
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
        $perimeterNodeCount = count($this->_nodePoints);

        $jIndex = $perimeterNodeCount - 1 ;
        $oddNodes = FALSE;
        for ($iIndex = 0; $iIndex < $perimeterNodeCount; ++$iIndex) {
            $iLatitude = $this->_nodePoints[$iIndex]->getLatitude()->getValue();
            $jLatitude = $this->_nodePoints[$jIndex]->getLatitude()->getValue();

            if (($iLatitude < $latitude && $jLatitude >= $latitude) ||
                ($jLatitude < $latitude && $iLatitude >= $latitude)) {
                $iLongitude = $this->_nodePoints[$iIndex]->getLongitude()->getValue();
                $jLongitude = $this->_nodePoints[$jIndex]->getLongitude()->getValue();

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
