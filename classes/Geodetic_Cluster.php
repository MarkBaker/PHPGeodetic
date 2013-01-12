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
class Geodetic_Cluster extends Geodetic_Feature
{

    /**
     * Set the node points that define this cluster
     *
     * @param     Geodetic_LatLong[]    $nodePoints
     * @return    Geodetic_Cluster
     * @throws    Geodetic_Exception
     */
    public function setNodePoints(array $nodePoints = array())
    {
        if (count($nodePoints) < 2) {
            throw new Geodetic_Exception('A cluster must be defined by at least 2 node points');
        }
        $this->_setNodePoints($nodePoints);

        return $this;
    }

}
