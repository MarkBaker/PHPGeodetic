<?php


class ReferenceEllipsoidTest extends PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid();
        //    Must return an object...
        $this->assertTrue(is_object($referenceEllipsoidObject));
        //    ... of the correct type
        $this->assertTrue(is_a($referenceEllipsoidObject, 'Geodetic_ReferenceEllipsoid'));

        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('WGS 1984', $referenceEllipsoidName);
    }

    public function testInstantiateWithNull()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(NULL);
        //    Must return an object...
        $this->assertTrue(is_object($referenceEllipsoidObject));
        //    ... of the correct type
        $this->assertTrue(is_a($referenceEllipsoidObject, 'Geodetic_ReferenceEllipsoid'));

        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertNull($referenceEllipsoidName);
    }

    public function testSetEllipsoid()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid();

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::AIRY_1830);
        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('Airy (1830)', $referenceEllipsoidName);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);
        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('Airy Modified', $referenceEllipsoidName);
    }

    public function testGetSemiMajorAxis()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $semiMajorAxis = $referenceEllipsoidObject->getSemiMajorAxis();
        $this->assertEquals(6377340.189, $semiMajorAxis, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $semiMajorAxis = $referenceEllipsoidObject->getSemiMajorAxis();
        $this->assertEquals(6378137.0, $semiMajorAxis, '', 0.1e-8);
    }

    public function testSetSemiMajorAxis()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setSemiMajorAxis(6378137.2);
        $semiMajorAxis = $referenceEllipsoidObject->getSemiMajorAxis();
        $this->assertEquals(6378137.2, $semiMajorAxis, '', 0.1e-8);
    }

    public function testGetSemiMinorAxis()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $semiMinorAxis = $referenceEllipsoidObject->getSemiMinorAxis();
        $this->assertEquals(6356034.448, $semiMinorAxis, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $semiMinorAxis = $referenceEllipsoidObject->getSemiMinorAxis();
        $this->assertEquals(6356752.3142, $semiMinorAxis, '', 0.1e-8);
    }

    public function testSetSemiMinorAxis()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setSemiMinorAxis(6356752.5);
        $semiMinorAxis = $referenceEllipsoidObject->getSemiMinorAxis();
        $this->assertEquals(6356752.5, $semiMinorAxis, '', 0.1e-8);
    }

    public function testGetInverseFlattening()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $inverseFlattening = $referenceEllipsoidObject->getInverseFlattening();
        $this->assertEquals(299.32496546352854, $inverseFlattening, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $inverseFlattening = $referenceEllipsoidObject->getInverseFlattening();
        $this->assertEquals(298.2572229328697, $inverseFlattening, '', 0.1e-8);
    }

    public function testSetInverseFlattening()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setInverseFlattening(298);
        $inverseFlattening = $referenceEllipsoidObject->getInverseFlattening();
        $this->assertEquals(298, $inverseFlattening, '', 0.1e-8);
    }

    public function testGetFlattening()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(0.0033408506414971, $flattening, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(0.0033528106647475, $flattening, '', 0.1e-8);
    }

    public function testSetFlattening()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setFlattening(298);
        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(298, $flattening, '', 0.1e-8);
    }

    public function testGetFirstEccentricity()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $firstEccentricity = $referenceEllipsoidObject->getFirstEccentricity();
        $this->assertEquals(0.081673373874142, $firstEccentricity, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $firstEccentricity = $referenceEllipsoidObject->getFirstEccentricity();
        $this->assertEquals(0.081819190842621, $firstEccentricity, '', 0.1e-8);
    }

    public function testGetFirstEccentricitySquared()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $firstEccentricitySquared = $referenceEllipsoidObject->getFirstEccentricitySquared();
        $this->assertEquals(0.0066705399999854, $firstEccentricitySquared, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $firstEccentricitySquared = $referenceEllipsoidObject->getFirstEccentricitySquared();
        $this->assertEquals(0.0066943799901413, $firstEccentricitySquared, '', 0.1e-8);
    }

    public function testGetSecondEccentricity()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $secondEccentricity = $referenceEllipsoidObject->getSecondEccentricity();
        $this->assertEquals(0.081947147052943, $secondEccentricity, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $secondEccentricity = $referenceEllipsoidObject->getSecondEccentricity();
        $this->assertEquals(0.082094437949696, $secondEccentricity, '', 0.1e-8);
    }

    public function testGetSecondEccentricitySquared()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::MODIFIED_AIRY);

        $secondEccentricitySquared = $referenceEllipsoidObject->getSecondEccentricitySquared();
        $this->assertEquals(0.0067153349101166, $secondEccentricitySquared, '', 0.1e-8);

        $referenceEllipsoidObject->setEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $secondEccentricitySquared = $referenceEllipsoidObject->getSecondEccentricitySquared();
        $this->assertEquals(0.0067394967422764, $secondEccentricitySquared, '', 0.1e-8);
    }

    public function testGetRadiusOfCurvatureMeridian()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $testDataSet = array(
            -90 => 6399.593625804,
            -75 => 6395.2623228431,
            -60 => 6383.4538572402,
            -45 => 6367.3818155967,
            -30 => 6351.3771036589,
            -15 => 6339.7032989627,
             +0 => 6335.4393272028,
            +15 => 6339.7032989627,
            +30 => 6351.3771036589,
            +45 => 6367.3818155967,
            +60 => 6383.4538572402,
            +75 => 6395.2623228431,
            +90 => 6399.593625804,
        );

        foreach($testDataSet as $latitude => $expectedResult) {
            $radiusOfCurvatureMeridian = $referenceEllipsoidObject->getRadiusOfCurvatureMeridian(
                $latitude,
                Geodetic_Angle::DEGREES,
                Geodetic_Distance::KILOMETRES
            );
            $this->assertEquals($expectedResult, $radiusOfCurvatureMeridian, '', 0.1e-8);
        }

    }

    public function testGetRadiusOfCurvaturePrimeVertical()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $testDataSet = array(
            -90 => 6399.593625804,
            -75 => 6398.1495323095,
            -60 => 6394.2091738819,
            -45 => 6388.8382901438,
            -30 => 6383.4809177014,
            -15 => 6379.567582032,
             +0 => 6378.137,
            +15 => 6379.567582032,
            +30 => 6383.4809177014,
            +45 => 6388.8382901438,
            +60 => 6394.2091738819,
            +75 => 6398.1495323095,
            +90 => 6399.593625804,
        );

        foreach($testDataSet as $latitude => $expectedResult) {
            $radiusOfCurvaturePrimeVertical = $referenceEllipsoidObject->getRadiusOfCurvaturePrimeVertical(
                $latitude,
                Geodetic_Angle::DEGREES,
                Geodetic_Distance::KILOMETRES
            );
            $this->assertEquals($expectedResult, $radiusOfCurvaturePrimeVertical, '', 0.1e-8);
        }

    }

    public function testGetMeanRadius()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $meanRadius = $referenceEllipsoidObject->getMeanRadius();
        $this->assertEquals(6371008.771400, $meanRadius, '', 0.1e-6);
    }

    public function testGetVolumetricRadius()
    {
        $referenceEllipsoidObject = new Geodetic_ReferenceEllipsoid(Geodetic_ReferenceEllipsoid::WGS_1984);

        $volumetricRadius = $referenceEllipsoidObject->getVolumetricRadius();
        $this->assertEquals(6371000.789994, $volumetricRadius, '', 0.1e-6);
    }

    public function testGetEllipsoidNames()
    {
        $referenceEllipsoidNames = Geodetic_ReferenceEllipsoid::getEllipsoidNames();

        $this->assertGreaterThan(0, count($referenceEllipsoidNames));
        $this->assertTrue(in_array('Airy (1830)', $referenceEllipsoidNames));
    }

}
