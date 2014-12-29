<?php

namespace Geodetic;

/**
 * Translation Vectors.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class TranslationVectors
{
    /**
     * The Translation in the X-Plane value of this TranslationVectors object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $xVector;

    /**
     * The Translation in the Y-Plane value of this TranslationVectors object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $yVector;

    /**
     * The Translation in the Z-Plane value of this TranslationVectors object.
     * This value will always be maintained internally in meters (m)
     *
     * @access protected
     * @var Distance
     */
    protected $zVector;


    /**
     * Create a new Translation Vector
     *
     * @param     Base\XyzFormat    $xyzCoordinates    The Translation Vector values
     * @throws    Exception
     */
    public function __construct(Base\XyzFormat $xyzCoordinates = null)
    {
        if (!is_null($xyzCoordinates)) {
            $this->xVector = $xyzCoordinates->getX();
            $this->yVector = $xyzCoordinates->getY();
            $this->zVector = $xyzCoordinates->getZ();
            return;
        }

        //    Defaults
        $this->xVector = new Distance();
        $this->yVector = new Distance();
        $this->zVector = new Distance();
    }


    /**
     * Set the Translation Vector in the X-plane
     *
     * @param     Distance    $xDistance    The Translation Vector in the X-plane
     * @return    TranslationVectors
     * @throws    Exception
     */
    public function setX(Distance $xDistance = null)
    {
        if (is_null($xDistance)) {
            throw new Exception('The X Translation Vector must be a Distance object');
        }
        $this->xVector = $xDistance;

        return $this;
    }

    /**
     * Get the Translation Vector in the X-plane
     *
     * @return    Distance    The Translation Vector in the X-plane
     * @throws    Exception
     */
    public function getX()
    {
        return $this->xVector;
    }

    /**
     * Set the Translation Vector in the Y-plane
     *
     * @param     Distance    $yDistance    The Translation Vector in the Y-plane
     * @return    TranslationVectors
     * @throws    Exception
     */
    public function setY(Distance $yDistance = null)
    {
        if (is_null($yDistance)) {
            throw new Exception('The Y Translation Vector must be a Distance object');
        }
        $this->yVector = $yDistance;

        return $this;
    }

    /**
     * Get the Translation Vector in the Y-plane
     *
     * @return    Distance    The Translation Vector in the Y-plane
     * @throws    Exception
     */
    public function getY()
    {
        return $this->yVector;
    }

    /**
     * Set the Translation Vector in the Z-plane
     *
     * @param     Distance    $zDistance    The Translation Vector in the Z-plane
     * @return    TranslationVectors
     * @throws    Exception
     */
    public function setZ(Distance $zDistance = null)
    {
        if (is_null($zDistance)) {
            throw new Exception('The Z Translation Vector must be a Distance object');
        }
        $this->zVector = $zDistance;

        return $this;
    }

    /**
     * Get the Translation Vector in the Z-plane
     *
     * @return    Distance    The Translation Vector in the Z-plane
     * @throws    Exception
     */
    public function getZ()
    {
        return $this->zVector;
    }
}
