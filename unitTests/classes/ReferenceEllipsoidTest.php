<?php

namespace Geodetic;

class ReferenceEllipsoidTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiate()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid();
        //    Must return an object...
        $this->assertTrue(is_object($referenceEllipsoidObject));
        //    ... of the correct type
        $this->assertTrue(is_a($referenceEllipsoidObject, 'Geodetic\\ReferenceEllipsoid'));

        $referenceEllipsoidReference = $referenceEllipsoidObject->getEllipsoidReference();
        $this->assertEquals('WGS_84', $referenceEllipsoidReference);
    }

    public function testInstantiateWithNull()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(NULL);
        //    Must return an object...
        $this->assertTrue(is_object($referenceEllipsoidObject));
        //    ... of the correct type
        $this->assertTrue(is_a($referenceEllipsoidObject, 'Geodetic\\ReferenceEllipsoid'));

        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertNull($referenceEllipsoidName);
    }

    public function testSetEllipsoid()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid();

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::AIRY_1830);
        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('Airy (1830)', $referenceEllipsoidName);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);
        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('Airy Modified (1849)', $referenceEllipsoidName);
    }

    public function testSetEllipsoidSynonym()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid('MODIFIED_AIRY');

        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('Airy Modified (1849)', $referenceEllipsoidName);
    }

    /**
     * @expectedException Exception
     */
    public function testSetEllipsoidInvalid()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid();

        $referenceEllipsoidObject->setEllipsoid('Invalid');
    }

    public function testGetEllipsoidId()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $ellipsoidId = $referenceEllipsoidObject->getEllipsoidID();
        $this->assertEquals('7002', $ellipsoidId);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $ellipsoidId = $referenceEllipsoidObject->getEllipsoidID();
        $this->assertEquals('7030', $ellipsoidId);
    }

    public function testGetSemiMajorAxis()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $semiMajorAxis = $referenceEllipsoidObject->getSemiMajorAxis();
        $this->assertEquals(6377340.189, $semiMajorAxis, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $semiMajorAxis = $referenceEllipsoidObject->getSemiMajorAxis();
        $this->assertEquals(6378137.0, $semiMajorAxis, '', 0.1e-6);
    }

    public function testSetSemiMajorAxis()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setSemiMajorAxis(6378137.2);
        $semiMajorAxis = $referenceEllipsoidObject->getSemiMajorAxis();
        $this->assertEquals(6378137.2, $semiMajorAxis, '', 0.1e-6);
    }

    public function testGetSemiMinorAxis()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $semiMinorAxis = $referenceEllipsoidObject->getSemiMinorAxis();
        $this->assertEquals(6356034.4479385, $semiMinorAxis, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $semiMinorAxis = $referenceEllipsoidObject->getSemiMinorAxis();
        $this->assertEquals(6356752.3142452, $semiMinorAxis, '', 0.1e-6);
    }

    public function testSetSemiMinorAxis()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setSemiMinorAxis(6356752.5);
        $semiMinorAxis = $referenceEllipsoidObject->getSemiMinorAxis();
        $this->assertEquals(6356752.5, $semiMinorAxis, '', 0.1e-6);
    }

    public function testGetInverseFlattening()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $inverseFlattening = $referenceEllipsoidObject->getInverseFlattening();
        $this->assertEquals(299.3249646, $inverseFlattening, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $inverseFlattening = $referenceEllipsoidObject->getInverseFlattening();
        $this->assertEquals(298.257223563, $inverseFlattening, '', 0.1e-6);
    }

    public function testSetInverseFlattening()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setInverseFlattening(298);
        $inverseFlattening = $referenceEllipsoidObject->getInverseFlattening();
        $this->assertEquals(298, $inverseFlattening, '', 0.1e-6);
    }

    public function testGetFlattening()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(0.0033408506414971, $flattening, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(0.0033528106647475, $flattening, '', 0.1e-6);
    }

    public function testSetFlattening()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $referenceEllipsoidObject->setFlattening(298);
        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(298, $flattening, '', 0.1e-6);
    }

    public function testGetFirstEccentricity()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $firstEccentricity = $referenceEllipsoidObject->getFirstEccentricity();
        $this->assertEquals(0.081673373874142, $firstEccentricity, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $firstEccentricity = $referenceEllipsoidObject->getFirstEccentricity();
        $this->assertEquals(0.081819190842621, $firstEccentricity, '', 0.1e-6);
    }

    public function testGetFirstEccentricitySquared()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $firstEccentricitySquared = $referenceEllipsoidObject->getFirstEccentricitySquared();
        $this->assertEquals(0.0066705399999854, $firstEccentricitySquared, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $firstEccentricitySquared = $referenceEllipsoidObject->getFirstEccentricitySquared();
        $this->assertEquals(0.0066943799901413, $firstEccentricitySquared, '', 0.1e-6);
    }

    public function testGetSecondEccentricity()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $secondEccentricity = $referenceEllipsoidObject->getSecondEccentricity();
        $this->assertEquals(0.081947147052943, $secondEccentricity, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $secondEccentricity = $referenceEllipsoidObject->getSecondEccentricity();
        $this->assertEquals(0.082094437949696, $secondEccentricity, '', 0.1e-6);
    }

    public function testGetSecondEccentricitySquared()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::MODIFIED_AIRY);

        $secondEccentricitySquared = $referenceEllipsoidObject->getSecondEccentricitySquared();
        $this->assertEquals(0.0067153349101166, $secondEccentricitySquared, '', 0.1e-6);

        $referenceEllipsoidObject->setEllipsoid(ReferenceEllipsoid::WGS_1984);

        $secondEccentricitySquared = $referenceEllipsoidObject->getSecondEccentricitySquared();
        $this->assertEquals(0.0067394967422764, $secondEccentricitySquared, '', 0.1e-6);
    }

    public function testGetRadiusOfCurvatureMeridian()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

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
                Angle::DEGREES,
                Distance::KILOMETRES
            );
            $this->assertEquals($expectedResult, $radiusOfCurvatureMeridian, '', 0.1e-6);
        }

    }

    public function testGetRadiusOfCurvaturePrimeVertical()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

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
                Angle::DEGREES,
                Distance::KILOMETRES
            );
            $this->assertEquals($expectedResult, $radiusOfCurvaturePrimeVertical, '', 0.1e-6);
        }

    }

    public function testGetMeanRadius()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $meanRadius = $referenceEllipsoidObject->getMeanRadius();
        $this->assertEquals(6371008.7714151, $meanRadius, '', 0.1e-6);
    }

    public function testGetAuthalicRadius()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $authalicRadius = $referenceEllipsoidObject->getAuthalicRadius();
        $this->assertEquals(6371007.1809185, $authalicRadius, '', 0.1e-6);
    }

    public function testGetVolumetricRadius()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid(ReferenceEllipsoid::WGS_1984);

        $volumetricRadius = $referenceEllipsoidObject->getVolumetricRadius();
        $this->assertEquals(6371000.7900092, $volumetricRadius, '', 0.1e-6);
    }

    public function testSphere()
    {
        $referenceEllipsoidObject = new ReferenceEllipsoid('AUTHALIC_SPHERE');

        $referenceEllipsoidName = $referenceEllipsoidObject->getEllipsoidName();
        $this->assertEquals('Authalic Sphere', $referenceEllipsoidName);

        $flattening = $referenceEllipsoidObject->getFlattening();
        $this->assertEquals(INF, $flattening);

        $authalicRadius = $referenceEllipsoidObject->getAuthalicRadius();
        $this->assertEquals(6371000.0, $authalicRadius, '', 0.1e-6);
    }

    public function testGetEllipsoidNames()
    {
        $referenceEllipsoidNames = ReferenceEllipsoid::getEllipsoidNames();

        $this->assertGreaterThan(0, count($referenceEllipsoidNames));
        $this->assertTrue(in_array('Airy (1830)', $referenceEllipsoidNames));
    }

}
