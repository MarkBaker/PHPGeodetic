<?php


class DatumTest extends PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $datumObject = new Geodetic_Datum();
        //    Must return an object...
        $this->assertTrue(is_object($datumObject));
        //    ... of the correct type
        $this->assertTrue(is_a($datumObject, 'Geodetic_Datum'));

        $datumName = $datumObject->getDatumName();
        $this->assertEquals('WGS84', $datumName);
    }

    public function testInstantiateWithNull()
    {
        $datumObject = new Geodetic_Datum(NULL);
        //    Must return an object...
        $this->assertTrue(is_object($datumObject));
        //    ... of the correct type
        $this->assertTrue(is_a($datumObject, 'Geodetic_Datum'));

        $datumName = $datumObject->getDatumName();
        $this->assertNull($datumName);
    }

    public function testSetDatum()
    {
        $datumObject = new Geodetic_Datum();

        $datumObject->setDatum(Geodetic_Datum::OSGB36);
        $datumName = $datumObject->getDatumName();
        $this->assertEquals('Ordnance Survey - Great Britain (1936)', $datumName);

        $datumObject->setDatum(Geodetic_Datum::WGS1984);
        $datumName = $datumObject->getDatumName();
        $this->assertEquals('WGS84', $datumName);
    }

    public function testGetDatumNames()
    {
        $datumNames = Geodetic_Datum::getDatumNames();

        $this->assertGreaterThan(0, count($datumNames));
        $this->assertTrue(in_array('Ordnance Survey - Great Britain (1936)', $datumNames));
    }

    public function testGetRegionName()
    {
        $datumObject = new Geodetic_Datum();

        $datumObject->setDatum(Geodetic_Datum::OSGB36);
        $regionName = $datumObject->getRegionName();
        $this->assertEquals('GB - Great Britain', $regionName);
    }

    public function testGetRegionNamesForDatum()
    {
        $regionNames = Geodetic_Datum::getRegionNamesForDatum(Geodetic_Datum::OSGB36);

        $this->assertGreaterThan(0, count($regionNames));
        $this->assertTrue(in_array('GB - Great Britain', $regionNames));
    }

    public function testGetReferenceEllipsoidName()
    {
        $datumObject = new Geodetic_Datum();

        $datumObject->setDatum(Geodetic_Datum::OSGB36);
        $ellipsoidName = $datumObject->getReferenceEllipsoidName();
        $this->assertEquals('Airy (1830)', $ellipsoidName);
    }

    public function testGetReferenceEllipsoid()
    {
        $datumObject = new Geodetic_Datum();

        $datumObject->setDatum(Geodetic_Datum::OSGB36);
        $ellipsoid = $datumObject->getReferenceEllipsoid();
        //    Must return an object...
        $this->assertTrue(is_object($ellipsoid));
        //    ... of the correct type
        $this->assertTrue(is_a($ellipsoid, 'Geodetic_ReferenceEllipsoid'));
    }

    public function testGetBursaWolfParameters()
    {
        $datumObject = new Geodetic_Datum();

        $datumObject->setDatum(Geodetic_Datum::OSGB36);
        $bursaWolfParameters = $datumObject->getBursaWolfParameters();
        //    Must return an object...
        $this->assertTrue(is_object($bursaWolfParameters));
        //    ... of the correct type
        $this->assertTrue(is_a($bursaWolfParameters, 'Geodetic_BursaWolfParameters'));
    }

}
