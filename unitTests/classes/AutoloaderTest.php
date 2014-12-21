<?php

namespace Geodetic;

class AutoloaderTest extends \PHPUnit_Framework_TestCase
{

    public function testAutoloaderNonGeodeticClass()
    {
        $className = 'InvalidClass';

        $result = Autoloader::Load($className);
        //    Must return a boolean...
        $this->assertTrue(is_bool($result));
        //    ... indicating failure
        $this->assertFalse($result);
    }

    public function testAutoloaderInvalidGeodeticClass()
    {
        $className = 'Geodetic\\Invalid_Class';

        $result = Autoloader::Load($className);
        //    Must return a boolean...
        $this->assertTrue(is_bool($result));
        //    ... indicating failure
        $this->assertFalse($result);
    }

    public function testAutoloadValidGeodeticClass()
    {
        $className = 'Geodetic\\Angle';

        $result = Autoloader::Load($className);
        //    Check that class has been loaded
        $this->assertTrue(class_exists($className));
    }

    public function testAutoloadInstantiateSuccess()
    {
        $result = new Distance(10, 'km');
        //    Must return an object...
        $this->assertTrue(is_object($result));
        //    ... of the correct type
        $this->assertTrue(is_a($result, 'Geodetic\\Distance'));
    }

}
