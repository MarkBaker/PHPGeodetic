<?php


class LatLongTest extends PHPUnit_Framework_TestCase
{

    protected $_angle;
    protected $_distance;

    protected function setUp()
    {
        $this->_distance = $this->getMock('Geodetic_Distance');
        $this->_distance->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(12345.67890));

        $this->_angle = $this->getMock('Geodetic_Angle');
        $this->_angle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(12345.67890));

        $this->_xLatitude = $this->getMock('Geodetic_Distance');
        $this->_xLatitude->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.93215644417122));
        $this->_yLongitude = $this->getMock('Geodetic_Distance');
        $this->_yLongitude->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-0.052215829673181));
        $this->_zHeight = $this->getMock('Geodetic_Distance');
        $this->_zHeight->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(1.0));

        $this->_xyz = $this->getMock('Geodetic_LatLong_CoordinateValues');
        $this->_xyz->expects($this->any())
            ->method('getX')
            ->will($this->returnValue($this->_xLatitude));
        $this->_xyz->expects($this->any())
            ->method('getY')
            ->will($this->returnValue($this->_yLongitude));
        $this->_xyz->expects($this->any())
            ->method('getZ')
            ->will($this->returnValue($this->_zHeight));
    }


    public function testInstantiate()
    {
        $latLongObject = new Geodetic_LatLong();
        //    Must return an object...
        $this->assertTrue(is_object($latLongObject));
        //    ... of the correct type
        $this->assertTrue(is_a($latLongObject, 'Geodetic_LatLong'));

        $latitude = $latLongObject->getLatitude();
        $this->assertTrue(is_object($latitude));
        $this->assertTrue(is_a($latitude, 'Geodetic_Angle'));
        $this->assertEquals(0.0, $latitude->getValue());

        $longitude = $latLongObject->getLongitude();
        $this->assertTrue(is_object($longitude));
        $this->assertTrue(is_a($longitude, 'Geodetic_Angle'));
        $this->assertEquals(0.0, $longitude->getValue());

        $height = $latLongObject->getHeight();
        $this->assertTrue(is_object($height));
        $this->assertTrue(is_a($height, 'Geodetic_Distance'));
        $this->assertEquals(0.0, $height->getValue());
    }

    public function testInstantiateWithValues()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $latitudeValue = $latLongObject->getLatitude()->getValue();
        $this->assertEquals(0.93215644417122, $latitudeValue);

        $longitudeValue = $latLongObject->getLongitude()->getValue();
        $this->assertEquals(-0.052215829673181, $longitudeValue);

        $heightValue = $latLongObject->getHeight()->getValue();
        $this->assertEquals(1.0, $heightValue);
    }

    public function testSetLatitude()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setLatitude($this->_angle);
        $latitudeValue = $latLongObject->getLatitude();
        $this->assertTrue(is_object($latitudeValue));
        $this->assertTrue(is_a($latitudeValue, 'Geodetic_Angle'));
        $this->assertEquals(12345.67890, $latitudeValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_LatLong'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetLatitudeValueInvalid()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setlatitude();
    }

    public function testSetYValue()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setLongitude($this->_angle);
        $longitudeValue = $latLongObject->getLongitude();
        $this->assertTrue(is_object($longitudeValue));
        $this->assertTrue(is_a($longitudeValue, 'Geodetic_Angle'));
        $this->assertEquals(12345.67890, $longitudeValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_LatLong'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetYValueInvalid()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setLongitude();
    }

    public function testSetZValue()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setHeight($this->_distance);
        $heightValue = $latLongObject->getHeight();
        $this->assertTrue(is_object($heightValue));
        $this->assertTrue(is_a($heightValue, 'Geodetic_Distance'));
        $this->assertEquals(12345.67890, $heightValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_LatLong'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetZValueInvalid()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setHeight();
    }

    public function testValidateLatitude()
    {
        $radians = Geodetic_LatLong::validateLatitude(-90);
        $this->assertEquals(-M_PI / 2, $radians);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testValidateLatitudeInvalid()
    {
        $radians = Geodetic_LatLong::validateLatitude(180, Geodetic_Angle::RADIANS);
    }

    public function testValidateLongitude()
    {
        $radians = Geodetic_LatLong::validateLongitude(-180);
        $this->assertEquals(-M_PI, $radians);
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testValidateLongitudeInvalid()
    {
        $radians = Geodetic_LatLong::validateLongitude(360, Geodetic_Angle::RADIANS);
    }

    public function testConvertToECEF()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $datum = new Geodetic_Datum(Geodetic_Datum::WGS84);
        $ecef = $latLongObject->toECEF($datum);
        $this->assertTrue(is_object($ecef));
        $this->assertTrue(is_a($ecef, 'Geodetic_ECEF'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testConvertToECEFNoDatum()
    {
        $latLongObject = new Geodetic_LatLong($this->_xyz);

        $ecef = $latLongObject->toECEF();
    }

}
