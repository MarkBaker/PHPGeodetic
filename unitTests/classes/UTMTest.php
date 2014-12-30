<?php

namespace Geodetic;

class UTMTest extends \PHPUnit_Framework_TestCase
{

    protected $_northing;
    protected $_easting;
    protected $_latitudeZone;
    protected $_longitudeZone;


    protected function setUp()
    {
        $this->_northing = 20000;
        $this->_easting = 10000;
        $this->_latitudeZone = 'W';
        $this->_longitudeZone = 30;
    }


    public function testInstantiate()
    {
        $utmObject = new UTM();
        //    Must return an object...
        $this->assertTrue(is_object($utmObject));
        //    ... of the correct type
        $this->assertTrue(is_a($utmObject, 'Geodetic\\UTM'));

        $northing = $utmObject->getNorthing();
        $this->assertEquals(0.0, $northing);

        $easting = $utmObject->getEasting();
        $this->assertEquals(0.0, $easting);

        $latitudeZone = $utmObject->getLatitudeZone();
        $this->assertEquals(0.0, $latitudeZone);

        $longitudeZone = $utmObject->getLongitudeZone();
        $this->assertEquals(0.0, $longitudeZone);
    }

    public function testInstantiateWithValues()
    {
        $utmObject = new UTM(
            $this->_northing,
            $this->_easting,
            $this->_latitudeZone,
            $this->_longitudeZone
        );

        $northing = $utmObject->getNorthing();
        $this->assertEquals($this->_northing, $northing);

        $easting = $utmObject->getEasting();
        $this->assertEquals($this->_easting, $easting);

        $latitudeZone = $utmObject->getLatitudeZone();
        $this->assertEquals($this->_latitudeZone, $latitudeZone);

        $longitudeZone = $utmObject->getLongitudeZone();
        $this->assertEquals($this->_longitudeZone, $longitudeZone);
    }

    public function testSetNorthingValue()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setNorthing($this->_northing);
        $northing = $utmObject->getNorthing();
        $this->assertEquals($this->_northing, $northing);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\UTM'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetNorthingValueInvalid()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setNorthing('invalid');
    }

    public function testSetEastingValue()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setEasting($this->_easting);
        $easting = $utmObject->getEasting();
        $this->assertEquals($this->_easting, $easting);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\UTM'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetEastingValueInvalid()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setEasting('invalid');
    }

    public function testSetLatitudeZoneValue()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setLatitudeZone($this->_latitudeZone);
        $latitudeZone = $utmObject->getLatitudeZone();
        $this->assertEquals($this->_latitudeZone, $latitudeZone);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\UTM'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetLatitudeZoneValueInvalid()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setLatitudeZone('invalid');
    }

    public function testSetLongitudeZoneValue()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setLongitudeZone($this->_longitudeZone);
        $longitudeZone = $utmObject->getLongitudeZone();
        $this->assertEquals($this->_longitudeZone, $longitudeZone);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\UTM'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetLongitudeZoneValueInvalid()
    {
        $utmObject = new UTM();

        $fluidReturn = $utmObject->setLongitudeZone('invalid');
    }

    public function testConvertToLatLong()
    {
        $utmObject = new UTM(
            $this->_northing,
            $this->_easting,
            $this->_latitudeZone,
            $this->_longitudeZone
        );

        $datum = new Datum(Datum::WGS84);
        $latLong = $utmObject->toLatLong($datum);
        $this->assertTrue(is_object($latLong));
        $this->assertTrue(is_a($latLong, 'Geodetic\\LatLong'));
    }

    /**
     * @expectedException Exception
     */
    public function testConvertToLatLongNoDatum()
    {
        $utmObject = new UTM(
            $this->_northing,
            $this->_easting,
            $this->_latitudeZone,
            $this->_longitudeZone
        );

        $latLong = $utmObject->toLatLong();
    }

    public function testLongitudeZoneNorway()
    {
        $latitude = 60;
        $longitude = 6;

        $zone = UTM::identifyLongitudeZone($latitude, $longitude) ;
        $this->assertEquals(32, $zone);
    }

    public function testLongitudeZoneSvalbard()
    {
        $latitude = 75;
        $longitudeSet = array(
            8 => 31,
            16 => 33,
            24 => 35,
            40 => 37,
        );

        foreach($longitudeSet as $longitude => $expectedResult) {
            $zone = UTM::identifyLongitudeZone($latitude, $longitude) ;
            $this->assertEquals($expectedResult, $zone);
        }
    }

}
