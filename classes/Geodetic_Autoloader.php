<?php

Geodetic_Autoloader::Register();

/**
 *
 *  @package Geodetic
 *  @copyright  Copyright (c) 2012 Mark Baker (https://github.com/MarkBaker/PHPGeodetic)
 *  @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Geodetic_Autoloader
{
    /**
     * Register the Autoloader with SPL
     *
     */
    public static function Register() {
        if (function_exists('__autoload')) {
            //    Register any existing autoloader function with SPL, so we don't get any clashes
            spl_autoload_register('__autoload');
        }
        //    Register ourselves with SPL
        return spl_autoload_register(array('Geodetic_Autoloader', 'Load'));
    }    //    function Register()


    /**
     * Autoload a class identified by name
     *
     * @param    string    $pClassName        Name of the object to load
     */
    public static function Load($pClassName) {
        if ((class_exists($pClassName, FALSE)) || (strpos($pClassName, 'Geodetic') !== 0)) {
            //    Either already loaded, or not a Geodetic class request
            return FALSE;
        }

        $pClassFilePath = __DIR__ .
                          DIRECTORY_SEPARATOR .
                          $pClassName .
                          '.php';

        if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
            //    Can't load
            return FALSE;
        }
        require($pClassFilePath);
    }    //    function Load()

}