<?php


class AreaTest extends PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $areaObject = new Geodetic_Area();
        //    Must return an object...
        $this->assertTrue(is_object($areaObject));
        //    ... of the correct type
        $this->assertTrue(is_a($areaObject, 'Geodetic_Area'));

        $areaDefaultValue = $areaObject->getValue();
        $this->assertEquals(0.0, $areaDefaultValue);
    }

    public function testInstantiateWithValue()
    {
        $areaObject = new Geodetic_Area(10, Geodetic_Area::ACRES);

        $areaValue = $areaObject->getValue();
        $this->assertEquals(40468.564223536, $areaValue, '', 0.1e-8);
    }

    public function testGetValue()
    {
        $areaObject = new Geodetic_Area(10, Geodetic_Area::HECTARES);

        $areaValue = $areaObject->getValue();
        $this->assertEquals(100000.0, $areaValue);

        $areaValue = $areaObject->getValue(NULL);
        $this->assertEquals(100000.0, $areaValue);
    }

    public function testGetValueWithConversion()
    {
        $areaObject = new Geodetic_Area(10, Geodetic_Area::HECTARES);

        $areaValue = $areaObject->getValue(Geodetic_Area::ACRES);
        $this->assertEquals(24.710538147, $areaValue);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testGetValueInvalidUOM()
    {
        $areaObject = new Geodetic_Area(10, Geodetic_Area::HECTARES);

        $areaValue = $areaObject->getValue('Ounces');
    }

    public function testSetValue()
    {
        $areaObject = new Geodetic_Area(10, Geodetic_Area::HECTARES);

        $areaObject->setValue(10, Geodetic_Area::ACRES);
        $areaValue = $areaObject->getValue(Geodetic_Area::ACRES);
        $this->assertEquals(10.0, $areaValue);

        $areaObject->setValue(10, NULL);
        $areaValue = $areaObject->getValue(Geodetic_Area::HECTARES);
        $this->assertEquals(0.0010, $areaValue);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetValueInvalidUOM()
    {
        $areaObject = new Geodetic_Area();

        $areaObject->setValue(10, 'Joules');
    }

    public function testConvertArea()
    {
        $areaValue = Geodetic_Area::convertArea(10, Geodetic_Area::HECTARES, Geodetic_Area::ACRES);
        $this->assertEquals(24.710538147, $areaValue);
    }

}
