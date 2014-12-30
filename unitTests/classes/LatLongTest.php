<?php

namespace Geodetic;

class LatLongTest extends \PHPUnit_Framework_TestCase
{

    protected $_angle;
    protected $_distance;

    protected function setUp()
    {
        $this->_distance = $this->getMock('Geodetic\\Distance');
        $this->_distance->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(12345.67890));

        $this->_angle = $this->getMock('Geodetic\\Angle');
        $this->_angle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(12345.67890));

        $this->_xLatitude = $this->getMock('Geodetic\\Angle');
        $this->_xLatitude->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.93215644417122));
        $this->_yLongitude = $this->getMock('Geodetic\\Angle');
        $this->_yLongitude->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-0.052215829673181));
        $this->_zHeight = $this->getMock('Geodetic\\Distance');
        $this->_zHeight->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(1.0));

        $this->_xyz = $this->getMock('Geodetic\\LatLong\\CoordinateValues');
        $this->_xyz->expects($this->any())
            ->method('getX')
            ->will($this->returnValue($this->_xLatitude));
        $this->_xyz->expects($this->any())
            ->method('getY')
            ->will($this->returnValue($this->_yLongitude));
        $this->_xyz->expects($this->any())
            ->method('getZ')
            ->will($this->returnValue($this->_zHeight));

        $this->_zyx = $this->getMock('Geodetic\\LatLong\\CoordinateValues');
        $this->_zyx->expects($this->any())
            ->method('getY')
            ->will($this->returnValue($this->_xLatitude));
        $this->_zyx->expects($this->any())
            ->method('getX')
            ->will($this->returnValue($this->_yLongitude));
        $this->_zyx->expects($this->any())
            ->method('getZ')
            ->will($this->returnValue($this->_zHeight));
    }


    public function testInstantiate()
    {
        $latLongObject = new LatLong();
        //    Must return an object...
        $this->assertTrue(is_object($latLongObject));
        //    ... of the correct type
        $this->assertTrue(is_a($latLongObject, 'Geodetic\\LatLong'));

        $latitude = $latLongObject->getLatitude();
        $this->assertTrue(is_object($latitude));
        $this->assertTrue(is_a($latitude, 'Geodetic\\Angle'));
        $this->assertEquals(0.0, $latitude->getValue());

        $longitude = $latLongObject->getLongitude();
        $this->assertTrue(is_object($longitude));
        $this->assertTrue(is_a($longitude, 'Geodetic\\Angle'));
        $this->assertEquals(0.0, $longitude->getValue());

        $height = $latLongObject->getHeight();
        $this->assertTrue(is_object($height));
        $this->assertTrue(is_a($height, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $height->getValue());
    }

    public function testInstantiateWithValues()
    {
        $latLongObject = new LatLong($this->_xyz);

        $latitudeValue = $latLongObject->getLatitude()->getValue();
        $this->assertEquals(0.93215644417122, $latitudeValue);

        $longitudeValue = $latLongObject->getLongitude()->getValue();
        $this->assertEquals(-0.052215829673181, $longitudeValue);

        $heightValue = $latLongObject->getHeight()->getValue();
        $this->assertEquals(1.0, $heightValue);
    }

    public function testSetLatitude()
    {
        $latLongObject = new LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setLatitude($this->_angle);
        $latitudeValue = $latLongObject->getLatitude();
        $this->assertTrue(is_object($latitudeValue));
        $this->assertTrue(is_a($latitudeValue, 'Geodetic\\Angle'));
        $this->assertEquals(12345.67890, $latitudeValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\LatLong'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetLatitudeValueInvalid()
    {
        $latLongObject = new LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setlatitude();
    }

    public function testSetYValue()
    {
        $latLongObject = new LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setLongitude($this->_angle);
        $longitudeValue = $latLongObject->getLongitude();
        $this->assertTrue(is_object($longitudeValue));
        $this->assertTrue(is_a($longitudeValue, 'Geodetic\\Angle'));
        $this->assertEquals(12345.67890, $longitudeValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\LatLong'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetYValueInvalid()
    {
        $latLongObject = new LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setLongitude();
    }

    public function testSetZValue()
    {
        $latLongObject = new LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setHeight($this->_distance);
        $heightValue = $latLongObject->getHeight();
        $this->assertTrue(is_object($heightValue));
        $this->assertTrue(is_a($heightValue, 'Geodetic\\Distance'));
        $this->assertEquals(12345.67890, $heightValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\LatLong'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetZValueInvalid()
    {
        $latLongObject = new LatLong($this->_xyz);

        $fluidReturn = $latLongObject->setHeight();
    }

    public function testValidateLatitude()
    {
        $radians = LatLong::validateLatitude(-90);
        $this->assertEquals(-M_PI / 2, $radians);
    }

    /**
     * @expectedException Exception
     */
    public function testValidateLatitudeInvalid()
    {
        $radians = LatLong::validateLatitude(180, Angle::RADIANS);
    }

    public function testValidateLongitude()
    {
        $radians = LatLong::validateLongitude(-180);
        $this->assertEquals(-M_PI, $radians);
    }

    /**
     * @expectedException Exception
     */
    public function testValidateLongitudeInvalid()
    {
        $radians = LatLong::validateLongitude(360, Angle::RADIANS);
    }

    public function testConvertToECEF()
    {
        $latLongObject = new LatLong($this->_xyz);

        $datum = new Datum(Datum::WGS84);
        $ecef = $latLongObject->toECEF($datum);
        $this->assertTrue(is_object($ecef));
        $this->assertTrue(is_a($ecef, 'Geodetic\\ECEF'));
    }

    /**
     * @expectedException Exception
     */
    public function testConvertToECEFNoDatum()
    {
        $latLongObject = new LatLong($this->_xyz);

        $ecef = $latLongObject->toECEF();
    }

    public function testConvertToUTM()
    {
        $latLongObject = new LatLong($this->_xyz);

        $datum = new Datum(Datum::WGS84);
        $utm = $latLongObject->toUTM($datum);
        $this->assertTrue(is_object($utm));
        $this->assertTrue(is_a($utm, 'Geodetic\\UTM'));
    }

    /**
     * @expectedException Exception
     */
    public function testConvertToUTMNoDatum()
    {
        $latLongObject = new LatLong($this->_xyz);

        $utm = $latLongObject->toUTM();
    }

    public function testGetDistanceHaversine()
    {
        $latLongObject = new LatLong($this->_xyz);
        $destinationObject = new LatLong($this->_zyx);

        $distance = $latLongObject->getDistanceHaversine($destinationObject);
        $this->assertTrue(is_object($distance));
        $this->assertTrue(is_a($distance, 'Geodetic\\Distance'));
    }

    public function testGetDistanceHaversineWithEllipsoid()
    {
        $latLongObject = new LatLong($this->_xyz);
        $destinationObject = new LatLong($this->_zyx);

        $ellipsoid = new ReferenceEllipsoid(ReferenceEllipsoid::AIRY_1830);
        $distance = $latLongObject->getDistanceHaversine($destinationObject, $ellipsoid);
        $this->assertTrue(is_object($distance));
        $this->assertTrue(is_a($distance, 'Geodetic\\Distance'));
    }

    public function testGetDistanceVincenty()
    {
        $latLongObject = new LatLong($this->_xyz);
        $destinationObject = new LatLong($this->_zyx);

        $distance = $latLongObject->getDistanceVincenty($destinationObject);
        $this->assertTrue(is_object($distance));
        $this->assertTrue(is_a($distance, 'Geodetic\\Distance'));
    }

    public function testGetInitialBearing()
    {
        $latLongObject = new LatLong($this->_xyz);
        $destinationObject = new LatLong($this->_zyx);

        $bearing = $latLongObject->getInitialBearing($destinationObject);
        $this->assertTrue(is_object($bearing));
        $this->assertTrue(is_a($bearing, 'Geodetic\\Angle'));
    }

    public function testGetFinalBearing()
    {
        $latLongObject = new LatLong($this->_xyz);
        $destinationObject = new LatLong($this->_zyx);

        $bearing = $latLongObject->getFinalBearing($destinationObject);
        $this->assertTrue(is_object($bearing));
        $this->assertTrue(is_a($bearing, 'Geodetic\\Angle'));
    }

    public function testGetMidpoint()
    {
        $latLongObject = new LatLong($this->_xyz);
        $destinationObject = new LatLong($this->_zyx);

        $position = $latLongObject->getMidpoint($destinationObject);
        $this->assertTrue(is_object($position));
        $this->assertTrue(is_a($position, 'Geodetic\\LatLong'));
    }

    public function testGetDestination()
    {
        $latLongObject = new LatLong($this->_xyz);

        $position = $latLongObject->getDestination($this->_angle, $this->_distance);
        $this->assertTrue(is_object($position));
        $this->assertTrue(is_a($position, 'Geodetic\\LatLong'));
    }

}
