<?php

/**
 * A set of Bursa-Wolf Parameters for a Helmert Translation.
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_BursaWolfParameters
{

    /**
     * The Rotation Matrix for this set of Bursa-Wolf Parameters.
     *
     * @access protected
     * @var Geodetic_RotationMatrix
     */
    protected $_rotationMatrix;

    /**
     * The Translation Vectors for this set of Bursa-Wolf Parameters.
     *
     * @access protected
     * @var Geodetic_TranslationVectors
     */
    protected $_translationVectors;

    /**
     * The Scale Factor value of this Bursa-Wolf Parameters object.
     *
     * @access protected
     * @var float
     */
    protected $_scaleFactor = 0.0;


    /**
     * Create a new object for Bursa-Wolf Parameters
     *
     * @param     Geodetic_RotationMatrix        $rotationMatrix        Rotation Matrix object
     * @param     Geodetic_TranslationVectors    $translationVectors    Translation Vectors object
     * @param     integer|float                  $scaleFactor           Scale Factor value
     * @throws    Geodetic_Exception
     */
    function __construct(Geodetic_RotationMatrix $rotationMatrix = NULL,
                         Geodetic_TranslationVectors $translationVectors = NULL,
                         $scaleFactor = NULL)
    {
        if (!is_null($rotationMatrix))
            $this->_rotationMatrix = $rotationMatrix;

        if (!is_null($translationVectors))
            $this->_translationVectors = $translationVectors;

        if (!is_null($scaleFactor))
            $this->_scaleFactor = $scaleFactor;
    }


    /**
     * Set the Rotation Matrix
     *
     * @param     Geodetic_RotationMatrix    $rotationMatrix    The Rotation Matrix
     * @return    Geodetic_BursaWolfParameters
     * @throws    Geodetic_Exception
     */
    public function setRotationMatrix(Geodetic_RotationMatrix $rotationMatrix = NULL)
    {
        if (is_null($rotationMatrix)) {
            throw new Geodetic_Exception('The Rotation Matrix must be a Geodetic_RotationMatrix object');
        }
        $this->_rotationMatrix = $rotationMatrix;

        return $this;
    }

    /**
     * Get the Rotation Matrix
     *
     * @return    Geodetic_RotationMatrix    The Rotation Matrix
     */
    public function getRotationMatrix()
    {
        return $this->_rotationMatrix;
    }

    /**
     * Set the Translation Vectors
     *
     * @param     Geodetic_TranslationVectors    $translationVectors    The Translation Vectors
     * @return    Geodetic_BursaWolfParameters
     * @throws    Geodetic_Exception
     */
    public function setTranslationVectors(Geodetic_TranslationVectors $translationVectors = NULL)
    {
        if (is_null($translationVectors)) {
            throw new Geodetic_Exception('The Translation Vectors must be a Geodetic_TranslationVectors object');
        }
        $this->_translationVectors = $translationVectors;

        return $this;
    }

    /**
     * Get the Translation Vectors
     *
     * @return    Geodetic_TranslationVectors    The Translation Vectors
     */
    public function getTranslationVectors()
    {
        return $this->_translationVectors;
    }

    /**
     * Set the ScaleFactor
     *
     * @param     integer|float    $scaleFactor    The Scale Factor
     * @return    Geodetic_BursaWolfParameters
     * @throws    Geodetic_Exception
     */
    public function setScaleFactor($scaleFactor = NULL)
    {
        if (is_null($scaleFactor) || !is_numeric($scaleFactor)) {
            throw new Geodetic_Exception('The ScaleFactor must be set to a numeric value');
        }
        $this->_scaleFactor = (float) $scaleFactor;

        return $this;
    }

    /**
     * Get the ScaleFactor as a Geodetic_Distance object
     *
     * @return    float    The Scale Factor
     */
    public function getScaleFactor()
    {
        return $this->_scaleFactor;
    }

    /**
     * Reverse the sign of all the Bursa-Wolf parameter values
     *
     * @return    void
     */
    public function invert()
    {
        $this->_translationVectors->getX()->invertValue();
        $this->_translationVectors->getY()->invertValue();
        $this->_translationVectors->getZ()->invertValue();

        $this->_rotationMatrix->getX()->invertValue();
        $this->_rotationMatrix->getY()->invertValue();
        $this->_rotationMatrix->getZ()->invertValue();

        $this->_scaleFactor = 0 - $this->_scaleFactor;
    }

}
