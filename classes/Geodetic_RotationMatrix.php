<?php

/**
 * Rotation Matrix.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_RotationMatrix
{
    /**
     * The Angle of Rotation on the X-Axis value of this RotationMatrix object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Geodetic_Angle
     */
    protected $_xAngle;

    /**
     * The Angle of Rotation on the Y-Axis value of this RotationMatrix object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Geodetic_Angle
     */
    protected $_yAngle;

    /**
     * The Angle of Rotation on the Z-Axis value of this RotationMatrix object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Geodetic_Angle
     */
    protected $_zAngle;


    /**
     * Create a new Rotation Matrix
     *
     * @param     Geodetic_XyzFormat_Interface    $xyzCoordinates    The Rotation Matrix values
     * @throws    Geodetic_Exception
     */
    function __construct(Geodetic_XyzFormat_Interface $xyzCoordinates = NULL)
    {
        if (!is_null($xyzCoordinates)) {
            $this->_xAngle = $xyzCoordinates->getX();
            $this->_yAngle = $xyzCoordinates->getY();
            $this->_zAngle = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->_xAngle = new Geodetic_Angle();
        $this->_yAngle = new Geodetic_Angle();
        $this->_zAngle = new Geodetic_Angle();
    }


    /**
     * Set the Angle of Rotation on the X-Axis
     *
     * @param     Geodetic_Angle    $xAngle      The Angle of Rotation on the X-Axis
     * @return    Geodetic_RotationMatrix
     * @throws    Geodetic_Exception
     */
    public function setX(Geodetic_Angle $xAngle = NULL)
    {
        if (is_null($xAngle)) {
            throw new Geodetic_Exception('The Angle of Rotation on the X-Axis must be a Geodetic_Angle object');
        }
        $this->_xAngle = $xAngle;

        return $this;
    }

    /**
     * Get the Angle of Rotation on the X-Axis
     *
     * @return    Geodetic_Angle    The Angle of Rotation on the X-Axis
     * @throws    Geodetic_Exception
     */
    public function getX()
    {
        return $this->_xAngle;
    }

    /**
     * Set the Angle of Rotation on the Y-Axis
     *
     * @param     Geodetic_Angle    $yAngle    The Angle of Rotation on the Z-Axis
     * @return    Geodetic_RotationMatrix
     * @throws    Geodetic_Exception
     */
    public function setY(Geodetic_Angle $yAngle = NULL)
    {
        if (is_null($yAngle)) {
            throw new Geodetic_Exception('The Angle of Rotation on the Y-Axis must be a Geodetic_Angle object');
        }
        $this->_yAngle = $yAngle;

        return $this;
    }

    /**
     * Get the Angle of Rotation on the Y-Axis
     *
     * @return    Geodetic_Angle    The Angle of Rotation on the Y-Axis
     * @throws    Geodetic_Exception
     */
    public function getY()
    {
        return $this->_yAngle;
    }

    /**
     * Set the Angle of Rotation on the Z-Axis
     *
     * @param     Geodetic_Angle    $zAngle    The Angle of Rotation on the Z-Axis
     * @return    Geodetic_RotationMatrix
     * @throws    Geodetic_Exception
     */
    public function setZ(Geodetic_Angle $zAngle = NULL)
    {
        if (is_null($zAngle)) {
            throw new Geodetic_Exception('The Angle of Rotation on the Z-Axis must be a Geodetic_Angle object');
        }
        $this->_zAngle = $zAngle;

        return $this;
    }

    /**
     * Get the Angle of Rotation on the Z-Axis
     *
     * @return    Geodetic_Angle    The Angle of Rotation on the Z-Axis
     * @throws    Geodetic_Exception
     */
    public function getZ()
    {
        return $this->_zAngle;
    }

}
