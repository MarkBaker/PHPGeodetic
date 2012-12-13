<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_TranslationVectorArray extends Geodetic_Distance_Abstract
{
    public function __construct(array $distances = NULL,
                                $uom = Geodetic_Distance::METRES)
    {
        if (is_null($distances))
            throw new Geodetic_Exception('An array of vector distance coordinates must be passed');
        if (count($distances) == 3) {
            list ($xDistance, $yDistance, $zDistance) = array_values($distances);
        } else {
            throw new Geodetic_Exception('Invalid number of vectors distances in array');
        }

        $this->setValues($xDistance, $yDistance, $zDistance, $uom);
    }

}
