<?php

/**
 * Feature coordinate object.
 *
 * @package Geodetic
 * @subpackage Features
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
abstract class Geodetic_Feature
{

    /**
     * An array of Latitude/Longitude points that defines the node for this feature
     *
     * @access protected
     * @var Geodetic_LatLong[]
     */
    protected $_nodePoints;


    /**
     * Create a new set of node points for a feature
     *
     * @param     Geodetic_LatLong[]    $nodePoints
     * @throws    Geodetic_Exception
     */
    function __construct(array $nodePoints = array())
    {
        $this->setNodePoints($nodePoints);
    }

    /**
     * Set the node points that define this cluster
     *
     * @param     Geodetic_LatLong[]    $nodePoints
     * @return    Geodetic_Cluster
     * @throws    Geodetic_Exception
     */
    public function setNodePoints(array $nodePoints = array())
    {
        $this->_setNodePoints($nodePoints);

        return $this;
    }

    /**
     * Set the node points that define this feature
     *
     * @param     Geodetic_LatLong[]    $nodePoints
     * @return    Geodetic_Line
     * @throws    Geodetic_Exception
     */
    protected function _setNodePoints(array $nodePoints = array())
    {
        foreach($nodePoints as $nodePoint) {
            if (!($nodePoint instanceof Geodetic_LatLong)) {
                throw new Geodetic_Exception('Each node must be a Geodetic_LatLong object');
            }
        }

        // We want a simple numerically indexed array, so use array_values() to enforce this
        $this->_nodePoints = array_values($nodePoints);
    }

    /**
     * Get the Node Points that define this feature
     *
     * @return    Geodetic_LatLong[]    Array of Latitude/Longitude objects that define the node points of this feature
     */
    public function getNodePoints()
    {
        return $this->_nodePoints;
    }

    public function insertNodeBefore(Geodetic_LatLong $newNode, $beforeKey) {
        if (!isset($this->_nodePoints[$beforeKey])) {
            throw new Geodetic_Exception('Insert before node does not exist');
        }

        array_splice(
                $this->_nodePoints,
                $beforeKey,
                0,
                $newNode
        );

        return $this;
    }

    public function insertNodeAfter(Geodetic_LatLong $newNode, $afterKey) {
        if (!isset($this->_nodePoints[$afterKey])) {
            throw new Geodetic_Exception('Insert after node does not exist');
        }

        array_splice(
                $this->_nodePoints,
                $afterKey + 1,
                0,
                $newNode
        );

        return $this;
    }

    public function deleteNode($nodeKey) {
        if (!isset($this->_nodePoints[$nodeKey])) {
            throw new Geodetic_Exception('Node does not exist');
        }

        array_splice(
                $this->_nodePoints,
                $nodeKey,
                1
        );

        return $this;
    }

}
