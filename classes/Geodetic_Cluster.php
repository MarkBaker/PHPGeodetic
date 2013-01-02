<?php

/**
 * Cluster coordinate object.
 *
 * Clusters can be used to represent scattered geographic features such as postal zones that are identified
 *     as a series of individual points, rather than enclosed features such as borders that can be represented
 *     by the Geodetic_Region object, or linear features such as roads and rivers that can be represented by
 *     the Geodetic_Line object.
 *
 * @package Geodetic
 * @subpackage Features
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Cluster
{

    /**
     * An array of Latitude/Longitude points that defines the cluster
     *
     * @access protected
     * @var Geodetic_Angle[]
     */
    protected $_nodePoints;


    /**
     * Create a new Cluster
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
        if ((count($nodePoints) > 0) && (count($nodePoints) < 2)) {
            throw new Geodetic_Exception('A cluster must be defined by at least 2 node points');
        }
        foreach($nodePoints as $nodePoint) {
            if (!($nodePoint instanceof Geodetic_LatLong)) {
                throw new Geodetic_Exception('Each node point must be a Geodetic_LatLong object');
            }
        }

        $this->_nodePoints = $nodePoints;

        return $this;
    }

    /**
     * Get the Node Points that define this cluster
     *
     * @return    Geodetic_LatLong[]    Array of Latitude/Longitude objects that define the node of this cluster
     */
    public function getNodePoints()
    {
        return $this->_nodePoints;
    }

}
