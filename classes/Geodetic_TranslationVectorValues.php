<?php

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_TranslationVectorValues extends Geodetic_Distance_Abstract
{
    public function __construct($xDistance = NULL,
                                $yDistance = NULL,
                                $zDistance = NULL,
                                $uom = Geodetic_Distance::METRES)
    {
        $this->setValues($xDistance, $yDistance, $zDistance, $uom);
    }

}
