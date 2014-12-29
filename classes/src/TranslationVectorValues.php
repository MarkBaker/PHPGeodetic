<?php

namespace Geodetic;

/**
 *
 * Class that accepts a set of individual Distance values for a Translation Vector and creates a standardised interface
 * that can be passed to the Translation Vector constructor
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class TranslationVectorValues extends Base\Distance
{
    /**
     * Create an XYZ_Format interface object for Translation Vector Distance Coordinates from individual values
     *
     * @param     integer|float|Distance    $xDistance    The X-Distance value
     * @param     integer|float|Distance    $yDistance    The Y-Distance value
     * @param     integer|float|Distance    $zDistance    The Z-Distance value
     * @param     string                             $uom          Unit of measure for all three Distance values
     *                                                                 (if they are passed as integer or float)
     * @throws    Exception
     */
    public function __construct(
        $xDistance = null,
        $yDistance = null,
        $zDistance = null,
        $uom = Distance::METRES
    ) {
        $this->setValues($xDistance, $yDistance, $zDistance, $uom);
    }
}
