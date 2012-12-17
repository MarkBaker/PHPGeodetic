<?php


class UTMTest extends PHPUnit_Framework_TestCase
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
        $utmObject = new Geodetic_UTM();
        //    Must return an object...
        $this->assertTrue(is_object($utmObject));
        //    ... of the correct type
        $this->assertTrue(is_a($utmObject, 'Geodetic_UTM'));

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
        $utmObject = new Geodetic_UTM(
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
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setNorthing($this->_northing);
        $northing = $utmObject->getNorthing();
        $this->assertEquals($this->_northing, $northing);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_UTM'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetNorthingValueInvalid()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setNorthing('invalid');
    }

    public function testSetEastingValue()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setEasting($this->_easting);
        $easting = $utmObject->getEasting();
        $this->assertEquals($this->_easting, $easting);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_UTM'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetEastingValueInvalid()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setEasting('invalid');
    }

    public function testSetLatitudeZoneValue()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setLatitudeZone($this->_latitudeZone);
        $latitudeZone = $utmObject->getLatitudeZone();
        $this->assertEquals($this->_latitudeZone, $latitudeZone);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_UTM'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetLatitudeZoneValueInvalid()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setLatitudeZone('invalid');
    }

    public function testSetLongitudeZoneValue()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setLongitudeZone($this->_longitudeZone);
        $longitudeZone = $utmObject->getLongitudeZone();
        $this->assertEquals($this->_longitudeZone, $longitudeZone);

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic_UTM'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testSetLongitudeZoneValueInvalid()
    {
        $utmObject = new Geodetic_UTM();

        $fluidReturn = $utmObject->setLongitudeZone('invalid');
    }

    public function testConvertToLatLong()
    {
        $utmObject = new Geodetic_UTM(
            $this->_northing,
            $this->_easting,
            $this->_latitudeZone,
            $this->_longitudeZone
        );

        $datum = new Geodetic_Datum(Geodetic_Datum::WGS84);
        $latLong = $utmObject->toLatLong($datum);
        $this->assertTrue(is_object($latLong));
        $this->assertTrue(is_a($latLong, 'Geodetic_LatLong'));
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testConvertToLatLongNoDatum()
    {
        $utmObject = new Geodetic_UTM(
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

        $zone = Geodetic_UTM::identifyLongitudeZone($latitude, $longitude) ;
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
            $zone = Geodetic_UTM::identifyLongitudeZone($latitude, $longitude) ;
            $this->assertEquals($expectedResult, $zone);
        }
    }

}
