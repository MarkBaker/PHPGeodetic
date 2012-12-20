<?php

/**
 *  Region coordinate object.
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Region
{

    /**
     *  An array of Latitude/Longitude points that defines the region
     *
     *  @access protected
     *  @var Geodetic_Angle[]
     */
    protected $_perimeterPoints;


    /**
     * Create a new Region
     *
     *  @param     Geodetic_LatLong[]    $perimeterPoints
     *  @throws    Geodetic_Exception
     */
    function __construct(array $perimeterPoints = array())
    {
        $this->setPerimeterPoints($perimeterPoints);
    }

    /**
     *  Set the perimeter points that define this region
     *
     *  @param     Geodetic_LatLong[]    $perimeterPoints
     *  @return    Geodetic_Region
     *  @throws    Geodetic_Exception
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
     *  Get the Perimeter Points that define this region
     *
     *  @return    Geodetic_LatLong[]    Array of Latitude/Longitude objects that define the perimeter of this region
     */
    public function getPerimeterPoints()
    {
        return $this->_perimeterPoints;
    }

    /**
     *  Identify whether a specified Latitude/Longitude falls within the bounds of this region
     *
     *  @param     Geodetic_LatLong    The Latitude/Longitude object that we wish to test
     *  @return    boolean
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
