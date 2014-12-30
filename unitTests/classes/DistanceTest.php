<?php

namespace Geodetic;

class DistanceTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $distanceObject = new Distance();
        //    Must return an object...
        $this->assertTrue(is_object($distanceObject));
        //    ... of the correct type
        $this->assertTrue(is_a($distanceObject, 'Geodetic\\Distance'));

        $distanceDefaultValue = $distanceObject->getValue();
        $this->assertEquals(0.0, $distanceDefaultValue);
    }

    public function testInstantiateWithValue()
    {
        $distanceObject = new Distance(10, Distance::MILES);

        $distanceValue = $distanceObject->getValue();
        $this->assertEquals(16093.44, $distanceValue);
    }

    public function testGetValue()
    {
        $distanceObject = new Distance(10, Distance::KILOMETRES);

        $distanceValue = $distanceObject->getValue();
        $this->assertEquals(10000, $distanceValue);

        $distanceValue = $distanceObject->getValue(NULL);
        $this->assertEquals(10000, $distanceValue);
    }

    public function testGetValueWithConversion()
    {
        $distanceObject = new Distance(10, Distance::KILOMETRES);

        $distanceValue = $distanceObject->getValue(Distance::MILES);
        $this->assertEquals(6.2137119224, $distanceValue);
    }

    /**
     * @expectedException Exception
     */
    public function testGetValueInvalidUOM()
    {
        $distanceObject = new Distance(10, Distance::KILOMETRES);

        $distanceValue = $distanceObject->getValue('Ounces');
    }

    public function testSetValue()
    {
        $distanceObject = new Distance(10, Distance::KILOMETRES);

        $distanceObject->setValue(10, Distance::MILES);
        $distanceValue = $distanceObject->getValue(Distance::MILES);
        $this->assertEquals(10.0, $distanceValue);

        $distanceObject->setValue(10, NULL);
        $distanceValue = $distanceObject->getValue(Distance::KILOMETRES);
        $this->assertEquals(0.010, $distanceValue);
    }

    /**
     * @expectedException Exception
     */
    public function testSetValueInvalidUOM()
    {
        $distanceObject = new Distance();

        $distanceObject->setValue(10, 'Joules');
    }

    public function testInvertValue()
    {
        $distanceObject = new Distance(10, Distance::KILOMETRES);

        $distanceObject->setValue(10, Distance::MILES);
        $distanceObject->invertValue();
        $distanceValue = $distanceObject->getValue(Distance::MILES);
        $this->assertEquals(-10.0, $distanceValue);
    }

    public function testConvertDistance()
    {
        $distanceValue = Distance::convertDistance(10, Distance::KILOMETRES, Distance::MILES);
        $this->assertEquals(6.2137119224, $distanceValue);
    }

}
