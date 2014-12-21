<?php

namespace Geodetic;

class AreaTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $areaObject = new Area();
        //    Must return an object...
        $this->assertTrue(is_object($areaObject));
        //    ... of the correct type
        $this->assertTrue(is_a($areaObject, 'Geodetic\\Area'));

        $areaDefaultValue = $areaObject->getValue();
        $this->assertEquals(0.0, $areaDefaultValue);
    }

    public function testInstantiateWithValue()
    {
        $areaObject = new Area(10, Area::ACRES);

        $areaValue = $areaObject->getValue();
        $this->assertEquals(40468.564223536, $areaValue, '', 0.1e-8);
    }

    public function testGetValue()
    {
        $areaObject = new Area(10, Area::HECTARES);

        $areaValue = $areaObject->getValue();
        $this->assertEquals(100000.0, $areaValue);

        $areaValue = $areaObject->getValue(NULL);
        $this->assertEquals(100000.0, $areaValue);
    }

    public function testGetValueWithConversion()
    {
        $areaObject = new Area(10, Area::HECTARES);

        $areaValue = $areaObject->getValue(Area::ACRES);
        $this->assertEquals(24.710538147, $areaValue);
    }

    /**
     * @expectedException Exception
     */
    public function testGetValueInvalidUOM()
    {
        $areaObject = new Area(10, Area::HECTARES);

        $areaValue = $areaObject->getValue('Ounces');
    }

    public function testSetValue()
    {
        $areaObject = new Area(10, Area::HECTARES);

        $areaObject->setValue(10, Area::ACRES);
        $areaValue = $areaObject->getValue(Area::ACRES);
        $this->assertEquals(10.0, $areaValue);

        $areaObject->setValue(10, NULL);
        $areaValue = $areaObject->getValue(Area::HECTARES);
        $this->assertEquals(0.0010, $areaValue);
    }

    /**
     * @expectedException Exception
     */
    public function testSetValueInvalidUOM()
    {
        $areaObject = new Area();

        $areaObject->setValue(10, 'Joules');
    }

    public function testConvertArea()
    {
        $areaValue = Area::convertArea(10, Area::HECTARES, Area::ACRES);
        $this->assertEquals(24.710538147, $areaValue);
    }

}
