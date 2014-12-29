<?php

namespace Geodetic\Base;

/**
 *
 * Interface for overloading constructor in classes that require x, y and z arguments
 *
 * @package Geodetic
 * @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
interface XyzFormat
{
    /**
     * Get the X-value
     *
     * @return    mixed    The X-value
     */
    public function getX();

    /**
     * Get the Y-value
     *
     * @return    mixed    The Y-value
     */
    public function getY();

    /**
     * Get the Z-value
     *
     * @return    mixed    The Z-value
     */
    public function getZ();
}
