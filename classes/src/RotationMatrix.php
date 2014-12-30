<?php

namespace Geodetic;

/**
 * Rotation Matrix.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class RotationMatrix
{
    /**
     * The Angle of Rotation on the X-Axis value of this RotationMatrix object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Angle
     */
    protected $xAngle;

    /**
     * The Angle of Rotation on the Y-Axis value of this RotationMatrix object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Angle
     */
    protected $yAngle;

    /**
     * The Angle of Rotation on the Z-Axis value of this RotationMatrix object.
     * This value will always be maintained internally in degrees (°)
     *
     * @access protected
     * @var Angle
     */
    protected $zAngle;


    /**
     * Create a new Rotation Matrix
     *
     * @param     Base\XyzFormat    $xyzCoordinates    The Rotation Matrix values
     * @throws    Exception
     */
    public function __construct(Base\XyzFormat $xyzCoordinates = null)
    {
        if (!is_null($xyzCoordinates)) {
            $this->xAngle = $xyzCoordinates->getX();
            $this->yAngle = $xyzCoordinates->getY();
            $this->zAngle = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->xAngle = new Angle();
        $this->yAngle = new Angle();
        $this->zAngle = new Angle();
    }


    /**
     * Set the Angle of Rotation on the X-Axis
     *
     * @param     Angle    $xAngle      The Angle of Rotation on the X-Axis
     * @return    RotationMatrix
     * @throws    Exception
     */
    public function setX(Angle $xAngle = null)
    {
        if (is_null($xAngle)) {
            throw new Exception('The Angle of Rotation on the X-Axis must be a Angle object');
        }
        $this->xAngle = $xAngle;

        return $this;
    }

    /**
     * Get the Angle of Rotation on the X-Axis
     *
     * @return    Angle    The Angle of Rotation on the X-Axis
     * @throws    Exception
     */
    public function getX()
    {
        return $this->xAngle;
    }

    /**
     * Set the Angle of Rotation on the Y-Axis
     *
     * @param     Angle    $yAngle    The Angle of Rotation on the Z-Axis
     * @return    RotationMatrix
     * @throws    Exception
     */
    public function setY(Angle $yAngle = null)
    {
        if (is_null($yAngle)) {
            throw new Exception('The Angle of Rotation on the Y-Axis must be a Angle object');
        }
        $this->yAngle = $yAngle;

        return $this;
    }

    /**
     * Get the Angle of Rotation on the Y-Axis
     *
     * @return    Angle    The Angle of Rotation on the Y-Axis
     * @throws    Exception
     */
    public function getY()
    {
        return $this->yAngle;
    }

    /**
     * Set the Angle of Rotation on the Z-Axis
     *
     * @param     Angle    $zAngle    The Angle of Rotation on the Z-Axis
     * @return    RotationMatrix
     * @throws    Exception
     */
    public function setZ(Angle $zAngle = null)
    {
        if (is_null($zAngle)) {
            throw new Exception('The Angle of Rotation on the Z-Axis must be a Angle object');
        }
        $this->zAngle = $zAngle;

        return $this;
    }

    /**
     * Get the Angle of Rotation on the Z-Axis
     *
     * @return    Angle    The Angle of Rotation on the Z-Axis
     * @throws    Exception
     */
    public function getZ()
    {
        return $this->zAngle;
    }
}
