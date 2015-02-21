<?php

namespace Geodetic\Base;

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
     * @var \Geodetic\LatLong[]
     */
    protected $nodePoints;


    /**
     * Create a new set of node points for a feature
     *
     * @param     \Geodetic\LatLong[]    $nodePoints
     * @throws    Exception
     */
    public function __construct(array $nodePoints = array())
    {
        $this->populateNodePoints($nodePoints);
    }

    /**
     * Set the node points that define this cluster
     *
     * @param     \Geodetic\LatLong[]    $nodePoints
     * @return    Feature
     * @throws    \Geodetic\Exception
     */
    public function setNodePoints(array $nodePoints = array())
    {
        $this->setNodePoints($nodePoints);

        return $this;
    }

    /**
     * Set the node points that define this feature
     *
     * @param     \Geodetic\LatLong[]    $nodePoints
     * @throws    \Geodetic\Exception
     */
    protected function populateNodePoints(array $nodePoints = array())
    {
        foreach ($nodePoints as $nodePoint) {
            if (!($nodePoint instanceof \Geodetic\LatLong)) {
                throw new \Geodetic\Exception('Each node must be a LatLong object');
            }
        }

        // We want a simple numerically indexed array, so use array_values() to enforce this
        $this->nodePoints = array_values($nodePoints);
    }

    /**
     * Get the Node Points that define this feature
     *
     * @return    \Geodetic\LatLong[]    Array of Latitude/Longitude objects that define the node points of this feature
     */
    public function getNodePoints()
    {
        return $this->nodePoints;
    }

    /**
     * Insert a new node point before a particular index position in this feature
     *
     * @param     \Geodetic\LatLong    $newNode      The new node to add
     * @param     integer              $beforeKey    The position at which this new node should be added
     * @return    Feature
     * @throws    \Geodetic\Exception
     */
    public function insertNodeBefore(\Geodetic\LatLong $newNode, $beforeKey)
    {
        if (!isset($this->nodePoints[$beforeKey])) {
            throw new \Geodetic\Exception('Insert before node does not exist');
        }

        array_splice(
            $this->nodePoints,
            $beforeKey,
            0,
            $newNode
        );

        return $this;
    }

    /**
     * Insert a new node point after a particular index position in this feature
     *
     * @param     \Geodetic\LatLong    $newNode      The new node to add
     * @param     integer              $afterKey    The position at which this new node should be added
     * @return    Feature
     * @throws    \Geodetic\Exception
     */
    public function insertNodeAfter(\Geodetic\LatLong $newNode, $afterKey)
    {
        if (!isset($this->nodePoints[$afterKey])) {
            throw new \Geodetic\Exception('Insert after node does not exist');
        }

        array_splice(
            $this->nodePoints,
            $afterKey + 1,
            0,
            $newNode
        );

        return $this;
    }

    /**
     * Delete a node point at a particular index position in this feature
     *
     * @param     integer    $nodeKey    The position of the node that should be deleted
     * @return    Feature
     * @throws    \Geodetic\Exception
     */
    public function deleteNode($nodeKey)
    {
        if (!isset($this->nodePoints[$nodeKey])) {
            throw new \Geodetic\Exception('Node does not exist');
        }

        array_splice(
            $this->nodePoints,
            $nodeKey,
            1
        );

        return $this;
    }

    /**
     * Get the nearest feature node to a specified position
     *
     * @param     \Geodetic\LatLong    $position    The point for which we want the nearest feature node
     * @param     string               $method      \Geodetic\Distance::METHOD_HAVERSINE or \Geodetic\Distance::METHOD_VINCENTY
     * @return    \Geodetic\LatLong
     * @throws    \Geodetic\Exception
     */
    public function getNearestNeighbour(\Geodetic\LatLong $position, $method = \Geodetic\Distance::METHOD_HAVERSINE)
    {
        $distances = array();
        foreach ($this->nodePoints as $nodeKey => $nodePoint) {
            $distances[$nodeKey] = $nodePoint->getDistance($position, $method);
        }
        arsort($distances);
        $key = array_pop($distances);
        return clone $this->nodePoints[$key];
    }

    /**
     * Get the centre point for a collection of lat/long values
     *
     * @return    \Geodetic\LatLong
     * @throws    \Geodetic\Exception
     */
    public function getGeographicCentrePoint()
    {
        $xPoints = $yPoints = $zPoints = array();
        foreach ($this->nodePoints as $nodePoint) {
            $latitude = $nodePoint->getLatitude()->getValue(\Geodetic\Angle::RADIANS);
            $longitude = $nodePoint->getLatitude()->getValue(\Geodetic\Angle::RADIANS);
            $xPoints[] = cos($latitude) * cos($longitude);
            $yPoints[] = cos($latitude) * sin($longitude);
            $zPoints[] = sin($latitude);
        }
        $x = array_sum($xPoints) / count($xPoints);
        $y = array_sum($yPoints) / count($yPoints);
        $z = array_sum($zPoints) / count($zPoints);
        
        $longitude = atan2($y, $x);
        $latitude = atan2($z, sqrt($x * $x + $y * $y));
        
        return new \Geodetic\LatLong(
            new \Geodetic\LatLong\CoordinateValues(
                $latitude,
                $longitude,
                \Geodetic\Angle::RADIANS
            )
        );
    }
}
