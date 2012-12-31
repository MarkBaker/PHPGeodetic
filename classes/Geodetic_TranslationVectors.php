<?php

/**
 * Translation Vectors.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_TranslationVectors
{
    /**
     * The Translation in the X-Plane value of this TranslationVectors object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Geodetic_Distance
     */
    protected $_xVector;

    /**
     * The Translation in the Y-Plane value of this TranslationVectors object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Geodetic_Distance
     */
    protected $_yVector;

    /**
     * The Translation in the Z-Plane value of this TranslationVectors object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Geodetic_Distance
     */
    protected $_zVector;


    /**
     * Create a new Translation Vector
     *
     * @param     Geodetic_XyzFormat_Interface    $xyzCoordinates    The Translation Vector values
     * @throws    Geodetic_Exception
     */
    function __construct(Geodetic_XyzFormat_Interface $xyzCoordinates = NULL)
    {
        if (!is_null($xyzCoordinates)) {
            $this->_xVector = $xyzCoordinates->getX();
            $this->_yVector = $xyzCoordinates->getY();
            $this->_zVector = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->_xVector = new Geodetic_Distance();
        $this->_yVector = new Geodetic_Distance();
        $this->_zVector = new Geodetic_Distance();
    }


    /**
     * Set the Translation Vector in the X-plane
     *
     * @param     Geodetic_Distance    $xDistance    The Translation Vector in the X-plane
     * @return    Geodetic_TranslationVectors
     * @throws    Geodetic_Exception
     */
    public function setX(Geodetic_Distance $xDistance = NULL)
    {
        if (is_null($xDistance)) {
            throw new Geodetic_Exception('The X Translation Vector must be a Geodetic_Distance object');
        }
        $this->_xVector = $xDistance;

        return $this;
    }

    /**
     * Get the Translation Vector in the X-plane
     *
     * @return    Geodetic_Distance    The Translation Vector in the X-plane
     * @throws    Geodetic_Exception
     */
    public function getX()
    {
        return $this->_xVector;
    }

    /**
     * Set the Translation Vector in the Y-plane
     *
     * @param     Geodetic_Distance    $yDistance    The Translation Vector in the Y-plane
     * @return    Geodetic_TranslationVectors
     * @throws    Geodetic_Exception
     */
    public function setY(Geodetic_Distance $yDistance = NULL)
    {
        if (is_null($yDistance)) {
            throw new Geodetic_Exception('The Y Translation Vector must be a Geodetic_Distance object');
        }
        $this->_yVector = $yDistance;

        return $this;
    }

    /**
     * Get the Translation Vector in the Y-plane
     *
     * @return    Geodetic_Distance    The Translation Vector in the Y-plane
     * @throws    Geodetic_Exception
     */
    public function getY()
    {
        return $this->_yVector;
    }

    /**
     * Set the Translation Vector in the Z-plane
     *
     * @param     Geodetic_Distance    $zDistance    The Translation Vector in the Z-plane
     * @return    Geodetic_TranslationVectors
     * @throws    Geodetic_Exception
     */
    public function setZ(Geodetic_Distance $zDistance = NULL)
    {
        if (is_null($zDistance)) {
            throw new Geodetic_Exception('The Z Translation Vector must be a Geodetic_Distance object');
        }
        $this->_zVector = $zDistance;

        return $this;
    }

    /**
     * Get the Translation Vector in the Z-plane
     *
     * @return    Geodetic_Distance    The Translation Vector in the Z-plane
     * @throws    Geodetic_Exception
     */
    public function getZ()
    {
        return $this->_zVector;
    }

}
