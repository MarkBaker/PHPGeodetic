<?php


class DistanceTest extends PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $distanceObject = new Geodetic_Distance();
        //    Must return an object...
        $this->assertTrue(is_object($distanceObject));
        //    ... of the correct type
        $this->assertTrue(is_a($distanceObject, 'Geodetic_Distance'));

        $distanceDefaultValue = $distanceObject->getValue();
        $this->assertEquals(0.0, $distanceDefaultValue);
    }

    public function testInstantiateWithValue()
    {
        $distanceObject = new Geodetic_Distance(10, Geodetic_Distance::MILES);

        $distanceValue = $distanceObject->getValue();
        $this->assertEquals(16093.44, $distanceValue);
    }

    public function testGetValue()
    {
        $distanceObject = new Geodetic_Distance(10, Geodetic_Distance::KILOMETRES);

        $distanceValue = $distanceObject->getValue();
        $this->assertEquals(10000, $distanceValue);

        $distanceValue = $distanceObject->getValue(NULL);
        $this->assertEquals(10000, $distanceValue);
    }

    public function testGetValueWithConversion()
    {
        $distanceObject = new Geodetic_Distance(10, Geodetic_Distance::KILOMETRES);

        $distanceValue = $distanceObject->getValue(Geodetic_Distance::MILES);
        $this->assertEquals(6.2137119224, $distanceValue);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testGetValueInvalidUOM()
    {
        $distanceObject = new Geodetic_Distance(10, Geodetic_Distance::KILOMETRES);

        $distanceValue = $distanceObject->getValue('Ounces');
    }

    public function testSetValue()
    {
        $distanceObject = new Geodetic_Distance(10, Geodetic_Distance::KILOMETRES);

        $distanceObject->setValue(10, Geodetic_Distance::MILES);
        $distanceValue = $distanceObject->getValue(Geodetic_Distance::MILES);
        $this->assertEquals(10.0, $distanceValue);

        $distanceObject->setValue(10, NULL);
        $distanceValue = $distanceObject->getValue(Geodetic_Distance::KILOMETRES);
        $this->assertEquals(0.010, $distanceValue);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetValueInvalidUOM()
    {
        $distanceObject = new Geodetic_Distance();

        $distanceObject->setValue(10, 'Joules');
    }

    public function testInvertValue()
    {
        $distanceObject = new Geodetic_Distance(10, Geodetic_Distance::KILOMETRES);

        $distanceObject->setValue(10, Geodetic_Distance::MILES);
        $distanceObject->invertValue();
        $distanceValue = $distanceObject->getValue(Geodetic_Distance::MILES);
        $this->assertEquals(-10.0, $distanceValue);
    }

    public function testConvertDistance()
    {
        $distanceValue = Geodetic_Distance::convertDistance(10, Geodetic_Distance::KILOMETRES, Geodetic_Distance::MILES);
        $this->assertEquals(6.2137119224, $distanceValue);
    }

}
