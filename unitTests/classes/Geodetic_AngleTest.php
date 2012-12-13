<?php


class AngleTest extends PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $angleObject = new Geodetic_Angle();
        //    Must return an object...
        $this->assertTrue(is_object($angleObject));
        //    ... of the correct type
        $this->assertTrue(is_a($angleObject, 'Geodetic_Angle'));

        $angleDefaultValue = $angleObject->getValue();
        $this->assertEquals(0.0, $angleDefaultValue);
    }

    public function testInstantiateWithValue()
    {
        $angleObject = new Geodetic_Angle(M_PI, Geodetic_Angle::RADIANS);

        $angleValue = $angleObject->getValue();
        $this->assertEquals(180, $angleValue);
    }

    public function testGetValue()
    {
        $angleObject = new Geodetic_Angle(2, Geodetic_Angle::RADIANS);

        $angleValue = $angleObject->getValue();
        $this->assertEquals(114.59155902616, $angleValue);

        $angleValue = $angleObject->getValue(NULL);
        $this->assertEquals(114.59155902616, $angleValue);
    }

    public function testGetValueWithConversion()
    {
        $angleObject = new Geodetic_Angle(45, Geodetic_Angle::DEGREES);

        $angleValue = $angleObject->getValue(Geodetic_Angle::RADIANS);
        $this->assertEquals(0.78539816339745, $angleValue);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testGetValueInvalidUOM()
    {
        $angleObject = new Geodetic_Angle(10, Geodetic_Angle::SECONDS);

        $angleValue = $angleObject->getValue('Ounces');
    }

    public function testSetValue()
    {
        $angleObject = new Geodetic_Angle(10, Geodetic_Angle::MINUTES);

        $angleObject->setValue(10, Geodetic_Angle::DEGREES);
        $angleValue = $angleObject->getValue(Geodetic_Angle::DEGREES);
        $this->assertEquals(10.0, $angleValue);

        $angleObject->setValue(10, NULL);
        $angleValue = $angleObject->getValue(Geodetic_Angle::SECONDS);
        $this->assertEquals(36000, $angleValue);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetValueInvalidUOM()
    {
        $angleObject = new Geodetic_Angle();

        $angleObject->setValue(10, 'Joules');
    }

    public function testInvertValue()
    {
        $angleObject = new Geodetic_Angle(10, Geodetic_Angle::MINUTES);

        $angleObject->setValue(10, Geodetic_Angle::DEGREES);
        $angleObject->invertValue();
        $angleValue = $angleObject->getValue(Geodetic_Angle::DEGREES);
        $this->assertEquals(-10.0, $angleValue);
    }

    public function testConvertAngle()
    {
        $angleValue = Geodetic_Angle::convertAngle(45, Geodetic_Angle::DEGREES, Geodetic_Angle::RADIANS);
        $this->assertEquals(0.78539816339745, $angleValue);
    }

    public function testToDM()
    {
        $angleObject = new Geodetic_Angle(2, Geodetic_Angle::RADIANS);

        $angleValue = $angleObject->toDM(2);
        $this->assertEquals("114°35.49'", $angleValue);
    }

    public function testToDMS()
    {
        $angleObject = new Geodetic_Angle(2, Geodetic_Angle::RADIANS);

        $angleValue = $angleObject->toDMS(2);
        $this->assertEquals("114°35'29.61\"", $angleValue);
    }

}
