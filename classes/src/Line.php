<?php

namespace Geodetic;

/**
 * Line coordinate object.
 *
 * Lines can be used to represent linear geographic features such as roads and rivers that start at one point
 *     and end at another point, rather than enclosed features such as borders that can be represented by the
 *     Region object.
 *
 * @package Geodetic
 * @subpackage Features
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Line extends Base\Feature
{

    /**
     * Set the node points that define this Line
     *
     * @param     LatLong[]    $nodePoints
     * @return    Line
     * @throws    Exception
     */
    public function setNodePoints(array $nodePoints = array())
    {
        if (count($nodePoints) < 2) {
            throw new Exception('A Line must be defined by at least 2 points: start and end');
        }
        $this->populateNodePoints($nodePoints);

        return $this;
    }

    /**
     * Get the length of this Line
     *
     * @param     ReferenceEllipsoid|null    $ellipsoid       Reference Ellipsoid to use for this calculation
     *                                                                     If null, then the WGS 1984 Ellipsoid will be used
     * @param     boolean                             $useHaversine    If true, then the Haversine formula will be used
     *                                                                     for the calculation, otherwise the more accurate
     *                                                                     Vincenty formula will be used instead.
     * @return    Distance    The length along the perimeter for this Line
     */
    public function getLength(ReferenceEllipsoid $ellipsoid = null, $useHaversine = false)
    {
        $pointCount = count($this->nodePoints);
        if ($pointCount == 0) {
            return new Area();
        }
        if (is_null($ellipsoid)) {
            $ellipsoid = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);
        }

        $distance = 0;
        for ($i = 0, $j = 1; $j < $pointCount; ++$i, ++$j) {
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
}
