<?php

namespace Geodetic;

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
class Region extends Base\Feature
{

    /**
     * Create a new Region
     *
     * @param     LatLong[]    $perimeterPoints
     * @throws    Exception
     */
    public function __construct(array $perimeterPoints = array())
    {
        $this->setPerimeterPoints($perimeterPoints);
    }

    /**
     * Set the perimeter points that define this region
     *
     * @param     LatLong[]    $perimeterPoints
     * @return    Region
     * @throws    Exception
     */
    public function setPerimeterPoints(array $perimeterPoints = array())
    {
        $pointCount = count($perimeterPoints);
        if ($pointCount == 0) {
            return $this;
        } elseif ($pointCount < 3) {
            throw new Exception('A region must be defined by at least 3 node points');
        }

        $this->populateNodePoints($perimeterPoints);

        // Start and end nodes must be the same
        // If they aren't, then we create a new end node to match the start node so that the region is fully enclosed
        if (($this->nodePoints[0]->getLatitude()->getValue() !==
             $this->nodePoints[$pointCount-1]->getLatitude()->getValue()) ||
            ($this->nodePoints[0]->getLongitude()->getValue() !==
             $this->nodePoints[$pointCount-1]->getLongitude()->getValue())) {
             $this->nodePoints[] = $this->nodePoints[0];
        }

        return $this;
    }

    /**
     * Get the Perimeter Points that define this region
     *
     * @return    LatLong[]    Array of Latitude/Longitude objects that define the perimeter of this region
     */
    public function getPerimeterPoints()
    {
        return parent::getNodePoints();
    }

    /**
     * Helper method to adjust haversine values
     *
     * @param     int|float    $x    The value on which to perform the calculation
     * @return    float        The adjusted haversine result
     */
    private static function haversineAdjust($x)
    {
        return (1.0 - cos($x)) / 2.0;
    }

    /**
     * Get the Planar Area of this region
     *
     * @param     ReferenceEllipsoid|null    $ellipsoid    Reference Ellipsoid to use for this calculation
     *                                                              If null, then the WGS 1984 Ellipsoid will be used
     * @return    Area    The planar area of this region
     */
    public function getAreaPlanar(ReferenceEllipsoid $ellipsoid = null)
    {
        $pointCount = count($this->nodePoints);
        if ($pointCount == 0) {
            return new Area();
        } elseif (is_null($ellipsoid)) {
            $ellipsoid = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);
        }
        $radius = $ellipsoid->getSemiMajorAxis();

        $area = 0;
        for ($j = 0; $j < $pointCount; ++$j) {
            $k = $j + 1;
            if ($j == 0) {
                $lambda1 = $this->nodePoints[$j]->getLongitude()->getValue(Angle::RADIANS);
                $beta1 = $this->nodePoints[$j]->getLatitude()->getValue(Angle::RADIANS);
                $lambda2 = $this->nodePoints[$k]->getLongitude()->getValue(Angle::RADIANS);
                $beta2 = $this->nodePoints[$k]->getLatitude()->getValue(Angle::RADIANS);
                $cosB1 = cos($beta1);
                $cosB2 = cos($beta2);
            } else {
                $k = ($j+1) % $pointCount;
                $lambda1 = $lambda2;
                $beta1 = $beta2;
                $lambda2 = $this->nodePoints[$k]->getLongitude()->getValue(Angle::RADIANS);
                $beta2 = $this->nodePoints[$k]->getLatitude()->getValue(Angle::RADIANS);
                $cosB1 = $cosB2;
                $cosB2 = cos($beta2);
            }
            if ($lambda1 != $lambda2) {
                $haversine = self::haversineAdjust($beta2 - $beta1) +
                    $cosB1 * $cosB2 * self::haversineAdjust($lambda2 - $lambda1);
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

        return new Area(
            abs($area) * $radius * $radius
        );
    }

    /**
     * Get the Signed Area of this region
     *
     * @return    float    The signed area of this region in degrees squared
     */
    private function getSignedArea()
    {
        $pointCount = count($this->nodePoints);

        $area = 0;
        for ($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $area += (($this->nodePoints[$i]->getLongitude()->getValue() *
                       $this->nodePoints[$j]->getLatitude()->getValue()) -
                      ($this->nodePoints[$j]->getLongitude()->getValue() *
                       $this->nodePoints[$i]->getLatitude()->getValue())
                     );
        }

        return $area / 2;
    }

    /**
     * Get the Planar Centre Point of this region
     *
     * @TODO regions that span the poles, or cross the dateline
     *
     * @return    LatLong    The planar centre point of this region
     * @throws    Exception
     */
    public function getCentrePointPlanar()
    {
        $pointCount = count($this->nodePoints);
        if ($pointCount == 0) {
            throw new Exception('Area is not defined, so cannot have a centre point');
        }

        $cLong = $cLat = 0;
        for ($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            $cTemp = (($this->nodePoints[$i]->getLongitude()->getValue() *
                       $this->nodePoints[$j]->getLatitude()->getValue()) -
                      ($this->nodePoints[$j]->getLongitude()->getValue() *
                       $this->nodePoints[$i]->getLatitude()->getValue())
                     );
            $cLat +=  ($this->nodePoints[$i]->getLatitude()->getValue() +
                       $this->nodePoints[$j]->getLatitude()->getValue()) *
                      $cTemp;
            $cLong += ($this->nodePoints[$i]->getLongitude()->getValue() +
                       $this->nodePoints[$j]->getLongitude()->getValue()) *
                      $cTemp;
        }

        $area = $this->getSignedArea();
        if ($area == 0) {
            $areaAdjust = 1;
        } else {
            $areaAdjust = 1 / (6 * $area);
        }
        $cLat *= $areaAdjust;
        $cLong *= $areaAdjust;

        return new LatLong(
            new LatLong\CoordinateValues(
                $cLat,
                $cLong,
                Angle::DEGREES
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
     * Area adjustments for regions that cross the date line
     *
     * @param     float    &$longitude1    Longitude position 1
     * @param     float    &$longitude2    Longitude position 2
     * @return    void
     */
    private static function datelineAdjust(&$longitude1, &$longitude2)
    {
        if ($longitude1 > $longitude2) {
            while ($longitude1 - $longitude2 > M_PI) {
                $longitude2 += M_PI + M_PI;
            }
        } elseif ($longitude2 > $longitude1) {
            while ($longitude2 - $longitude1 > M_PI) {
                $longitude1 += M_PI + M_PI;
            }
        }
    }

    /**
     * Area adjustments for regions that span the poles
     *
     * @param     float    $area                The calculated area
     * @param     float    $AE
     * @param     float    $Qp
     * @return    float    The adjusted area
     */
    private static function polarAdjust($area, $AE, $Qp)
    {
        $earthSurfaceArea = 4 * M_PI * $Qp * $AE;
        if ($earthSurfaceArea < 0.0) {
            $earthSurfaceArea = -$earthSurfaceArea;
        }
        if (($area *= $AE) < 0.0) {
            $area = -$area;
        }

        /*
         * kludge - if polygon circles the south pole the area will be computed as if it cirlced the north pole.
         * The correction is the difference between total surface area of the earth and the "north pole" area.
         */
        if ($area > $earthSurfaceArea) {
            $area = $earthSurfaceArea;
        }
        if ($area > $earthSurfaceArea / 2) {
            $area = $earthSurfaceArea - $area;
        }

        return $area;
    }

    /**
     * Get the Area of this region
     *
     * The algorithm used here is derived from the algorithm used by the GRASS GIS package
     *
     * @param     ReferenceEllipsoid|null    $ellipsoid    Reference Ellipsoid to use for this calculation
     *                                                              If null, then the WGS 1984 Ellipsoid will be used
     * @return    Area    The area of this region
     */
    public function getArea(ReferenceEllipsoid $ellipsoid = null)
    {
        $pointCount = count($this->nodePoints);
        if ($pointCount == 0) {
            return new Area();
        } elseif (is_null($ellipsoid)) {
            $ellipsoid = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);
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

        $pointCount--;

        $longitude2 = $this->nodePoints[$pointCount]->getLongitude()->getValue(Angle::RADIANS);
        $latitude2 = $this->nodePoints[$pointCount]->getLatitude()->getValue(Angle::RADIANS);

        $Qbar2 = $this->_Qbar($latitude2);
        $area = 0.0;
        $n = 0;
        while ($n++ < $pointCount) {
            $longitude1 = $longitude2;
            $latitude1 = $latitude2;
            $Qbar1 = $Qbar2;
            $longitude2 = $this->nodePoints[$n]->getLongitude()->getValue(Angle::RADIANS);
            $latitude2 = $this->nodePoints[$n]->getLatitude()->getValue(Angle::RADIANS);
            $Qbar2 = $this->_Qbar($latitude2);

            self::datelineAdjust($longitude1, $longitude2);

            $deltaLongitude = $longitude2 - $longitude1;
            $area += $deltaLongitude * ($Qp - $this->_Q($latitude2));
            if (($deltaLatitude = $latitude2 - $latitude1) != 0.0) {
                $area += $deltaLongitude * $this->_Q($latitude2) - ($deltaLongitude / $deltaLatitude) * ($Qbar2 - $Qbar1);
            }
        }

        $area = self::polarAdjust($area, $AE, $Qp);

        return new Area(
            $area
        );
    }

    /**
     * Get the length along the Perimeter for this region
     *
     * @param     ReferenceEllipsoid|null    $ellipsoid       Reference Ellipsoid to use for this calculation
     *                                                                     If null, then the WGS 1984 Ellipsoid will be used
     * @param     boolean                             $useHaversine    If true, then the Haversine formula will be used
     *                                                                     for the calculation, otherwise the more accurate
     *                                                                     Vincenty formula will be used instead.
     * @return    Distance    The length along the perimeter for this region
     */
    public function getPerimeter(ReferenceEllipsoid $ellipsoid = null, $useHaversine = false)
    {
        $pointCount = count($this->nodePoints);
        if ($pointCount == 0) {
            return new Area();
        }

        if (is_null($ellipsoid)) {
            $ellipsoid = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);
        }

        $distance = 0;
        for ($i = 0; $i < $pointCount; ++$i) {
            $j = ($i+1) % $pointCount;
            if ($useHaversine) {
                $distance += $this->nodePoints[$i]->getDistanceHaversine(
                    $this->nodePoints[$j],
                    $ellipsoid
                )->getValue();
            } else {
                $distance += $this->nodePoints[$i]->getDistanceVincenty(
                    $this->nodePoints[$j],
                    $ellipsoid
                )->getValue();
            }
        }

        return new Distance(
            $distance
        );
    }

    /**
     * Identify whether a specified Latitude/Longitude falls within the bounds of this region
     *
     * @param     LatLong    The Latitude/Longitude object that we wish to test
     * @return    boolean
     */
    public function isInRegion(LatLong $position)
    {
        $latitude = $position->getLatitude()->getValue();
        $longitude = $position->getLongitude()->getValue();
        $perimeterNodeCount = count($this->nodePoints);

        $jIndex = $perimeterNodeCount - 1 ;
        $oddNodes = false;
        for ($iIndex = 0; $iIndex < $perimeterNodeCount; ++$iIndex) {
            $iLatitude = $this->nodePoints[$iIndex]->getLatitude()->getValue();
            $jLatitude = $this->nodePoints[$jIndex]->getLatitude()->getValue();

            if (($iLatitude < $latitude && $jLatitude >= $latitude) ||
                ($jLatitude < $latitude && $iLatitude >= $latitude)) {
                $iLongitude = $this->nodePoints[$iIndex]->getLongitude()->getValue();
                $jLongitude = $this->nodePoints[$jIndex]->getLongitude()->getValue();

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
