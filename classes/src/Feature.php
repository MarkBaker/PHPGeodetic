<?php

namespace Geodetic;

/**
 * Feature coordinate object.
 *
 * @package Geodetic
 * @subpackage Features
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Feature
{

    /**
     * An array of Latitude/Longitude points that defines the node for this feature
     *
     * @access protected
     * @var LatLong[]
     */
    protected $_nodePoints;


    /**
     * Create a new set of node points for a feature
     *
     * @param     LatLong[]    $nodePoints
     * @throws    Exception
     */
    public function __construct(array $nodePoints = array())
    {
        $this->setNodePoints($nodePoints);
    }

    /**
     * Set the node points that define this cluster
     *
     * @param     LatLong[]    $nodePoints
     * @return    Feature
     * @throws    Exception
     */
    public function setNodePoints(array $nodePoints = array())
    {
        $this->_setNodePoints($nodePoints);

        return $this;
    }

    /**
     * Set the node points that define this feature
     *
     * @param     LatLong[]    $nodePoints
     * @throws    Exception
     */
    protected function _setNodePoints(array $nodePoints = array())
    {
        foreach ($nodePoints as $nodePoint) {
            if (!($nodePoint instanceof LatLong)) {
                throw new Exception('Each node must be a LatLong object');
            }
        }

        // We want a simple numerically indexed array, so use array_values() to enforce this
        $this->_nodePoints = array_values($nodePoints);
    }

    /**
     * Get the Node Points that define this feature
     *
     * @return    LatLong[]    Array of Latitude/Longitude objects that define the node points of this feature
     */
    public function getNodePoints()
    {
        return $this->_nodePoints;
    }

    /**
     * Insert a new node point before a particular index position in this feature
     *
     * @param     LatLong    $nodePoint
     * @param     integer             $beforeKey
     * @return    Feature
     * @throws    Exception
     */
    public function insertNodeBefore(LatLong $newNode, $beforeKey)
    {
        if (!isset($this->_nodePoints[$beforeKey])) {
            throw new Exception('Insert before node does not exist');
        }

        array_splice(
            $this->_nodePoints,
            $beforeKey,
            0,
            $newNode
        );

        return $this;
    }

    /**
     * Insert a new node point after a particular index position in this feature
     *
     * @param     LatLong    $nodePoint
     * @param     integer             $beforeKey
     * @return    Feature
     * @throws    Exception
     */
    public function insertNodeAfter(LatLong $newNode, $afterKey)
    {
        if (!isset($this->_nodePoints[$afterKey])) {
            throw new Exception('Insert after node does not exist');
        }

        array_splice(
            $this->_nodePoints,
            $afterKey + 1,
            0,
            $newNode
        );

        return $this;
    }

    /**
     * Delete a node point at a particular index position in this feature
     *
     * @param     integer             $beforeKey
     * @return    Feature
     * @throws    Exception
     */
    public function deleteNode($nodeKey)
    {
        if (!isset($this->_nodePoints[$nodeKey])) {
            throw new Exception('Node does not exist');
        }

        array_splice(
            $this->_nodePoints,
            $nodeKey,
            1
        );

        return $this;
    }

    /**
     * Get the nearest feature node to a specified position
     *
     * @param     LatLong               $position           The point for which we want the nearest feature node
     * @param     string                         $method             Distance::METHOD_HAVERSINE or Distance::METHOD_VINCENTY
     * @return    LatLong
     * @throws    Exception
     */
    public function getNearestNeighbour(LatLong $position, $method = Distance::METHOD_HAVERSINE)
    {
        $distances = array();
        foreach ($this->_nodePoints as $nodeKey => $nodePoint) {
            $distances[$nodeKey] = $nodePoint->getDistance($position, $method);
        }
        arsort($distances);
        $key = array_pop($distances);
        return clone $this->_nodePoints[$key];
    }

    /**
     * Get the centre point for a collection of lat/long values
     *
     * @return    LatLong
     * @throws    Exception
     */
    public function getGeographicCentrePoint()
    {
        $xPoints = $yPoints = $zPoints = array();
        foreach ($this->_nodePoints as $nodePoint) {
            $latitude = $nodePoint->getLatitude()->getValue(Angle::RADIANS);
            $longitude = $nodePoint->getLatitude()->getValue(Angle::RADIANS);
            $xPoints[] = cos($latitude) * cos($longitude);
            $yPoints[] = cos($latitude) * sin($longitude);
            $zPoints[] = sin($latitude);
        }
        $x = array_sum($xPoints) / count($xPoints);
        $y = array_sum($yPoints) / count($yPoints);
        $z = array_sum($zPoints) / count($zPoints);
        
        $longitude = atan2($y, $x);
        $latitude = atan2($z, sqrt($x * $x + $y * $y));
        
        return new LatLong(
            new LatLong_CoordinateValues(
                $latitude,
                $longitude,
                Angle::RADIANS
            )
        );
    }
}
