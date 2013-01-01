<?php

/**
 * Line coordinate object.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Line
{

    /**
     * An array of Latitude/Longitude points that defines the Line
     *
     * @access protected
     * @var Geodetic_Angle[]
     */
    protected $_nodePoints;


    /**
     * Create a new Line
     *
     * @param     Geodetic_LatLong[]    $nodePoints
     * @throws    Geodetic_Exception
     */
    function __construct(array $nodePoints = array())
    {
        $this->setnodePoints($nodePoints);
    }

    /**
     * Set the perimeter points that define this Line
     *
     * @param     Geodetic_LatLong[]    $nodePoints
     * @return    Geodetic_Line
     * @throws    Geodetic_Exception
     */
    public function setNodePoints(array $nodePoints = array())
    {
        if ((count($nodePoints) > 0) && (count($nodePoints) < 3)) {
            throw new Geodetic_Exception('A Line must be defined by at least 3 perimeter points');
        }
        foreach($nodePoints as $perimeterPoint) {
            if (!($perimeterPoint instanceof Geodetic_LatLong)) {
                throw new Geodetic_Exception('Each perimeter point must be a Geodetic_LatLong object');
            }
        }

        $this->_nodePoints = $nodePoints;

        return $this;
    }

    /**
     * Get the Perimeter Points that define this Line
     *
     * @return    Geodetic_LatLong[]    Array of Latitude/Longitude objects that define the perimeter of this Line
     */
    public function getNodePoints()
    {
        return $this->_nodePoints;
    }

    /**
     * Get the length of this Line
     *
     * @param     Geodetic_ReferenceEllipsoid|NULL    $ellipsoid       Reference Ellipsoid to use for this calculation
     *                                                                     If NULL, then the WGS 1984 Ellipsoid will be used
     * @param     boolean                             $useHaversine    If true, then the Haversine formula will be used
     *                                                                     for the calculation, otherwise the more accurate
     *                                                                     Vincenty formula will be used instead.
     * @return    Geodetic_Distance    The length along the perimeter for this Line
     */
    public function getLength(Geodetic_ReferenceEllipsoid $ellipsoid = NULL,
                              $useHaversine = FALSE)
    {
        $pointCount = count($this->_nodePoints);
        if ($pointCount == 0)
            return new Geodetic_Area();

        if (is_null($ellipsoid)) {
            $ellipsoid = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);
        }

        $distance = 0;
        for($i = 0, $j = 1; $j < $pointCount; ++$i, ++$j) {
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

}
