<?php

namespace Geodetic;

class AngleTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $angleObject = new Angle();
        //    Must return an object...
        $this->assertTrue(is_object($angleObject));
        //    ... of the correct type
        $this->assertTrue(is_a($angleObject, 'Geodetic\\Angle'));

        $angleDefaultValue = $angleObject->getValue();
        $this->assertEquals(0.0, $angleDefaultValue);
    }

    public function testInstantiateWithValue()
    {
        $angleObject = new Angle(M_PI, Angle::RADIANS);

        $angleValue = $angleObject->getValue();
        $this->assertEquals(180, $angleValue);
    }

    public function testGetValue()
    {
        $angleObject = new Angle(2, Angle::RADIANS);

        $angleValue = $angleObject->getValue();
        $this->assertEquals(114.59155902616, $angleValue);

        $angleValue = $angleObject->getValue(NULL);
        $this->assertEquals(114.59155902616, $angleValue);
    }

    public function testGetValueWithConversion()
    {
        $angleObject = new Angle(45, Angle::DEGREES);

        $angleValue = $angleObject->getValue(Angle::RADIANS);
        $this->assertEquals(0.78539816339745, $angleValue);
    }

    /**
     * @expectedException Exception
     */
    public function testGetValueInvalidUOM()
    {
        $angleObject = new Angle(10, Angle::SECONDS);

        $angleValue = $angleObject->getValue('Ounces');
    }

    public function testSetValue()
    {
        $angleObject = new Angle(10, Angle::MINUTES);

        $angleObject->setValue(10, Angle::DEGREES);
        $angleValue = $angleObject->getValue(Angle::DEGREES);
        $this->assertEquals(10.0, $angleValue);

        $angleObject->setValue(10, NULL);
        $angleValue = $angleObject->getValue(Angle::SECONDS);
        $this->assertEquals(36000, $angleValue);
    }

    /**
     * @expectedException Exception
     */
    public function testSetValueInvalidUOM()
    {
        $angleObject = new Angle();

        $angleObject->setValue(10, 'Joules');
    }

    public function testInvertValue()
    {
        $angleObject = new Angle(10, Angle::MINUTES);

        $angleObject->setValue(10, Angle::DEGREES);
        $angleObject->invertValue();
        $angleValue = $angleObject->getValue(Angle::DEGREES);
        $this->assertEquals(-10.0, $angleValue);
    }

    public function testConvertAngle()
    {
        $angleValue = Angle::convertAngle(45, Angle::DEGREES, Angle::RADIANS);
        $this->assertEquals(0.78539816339745, $angleValue);
    }

    public function testToDM()
    {
        $angleObject = new Angle(2, Angle::RADIANS);

        $angleValue = $angleObject->toDM(2);
        $this->assertEquals("114°35.49'", $angleValue);
    }

    public function testToDMS()
    {
        $angleObject = new Angle(2, Angle::RADIANS);

        $angleValue = $angleObject->toDMS(2);
        $this->assertEquals("114°35'29.61\"", $angleValue);
    }

}
