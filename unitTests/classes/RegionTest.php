<?php

namespace Geodetic;

class RegionTest extends \PHPUnit_Framework_TestCase
{

    protected $_angle;
    protected $_distance;

    protected function setUp()
    {
        $this->_xLatitude1 = $this->getMock('Geodetic\\Angle');
        $this->_xLatitude1->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(53.401345));
        $this->_yLongitude1 = $this->getMock('Geodetic\\Angle');
        $this->_yLongitude1->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-2.985535));
        $this->_zHeight1 = $this->getMock('Geodetic\\Distance');
        $this->_zHeight1->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.0));

        $this->_xyz1 = $this->getMock('Geodetic\\LatLong');
        $this->_xyz1->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue($this->_xLatitude1));
        $this->_xyz1->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue($this->_yLongitude1));
        $this->_xyz1->expects($this->any())
            ->method('getHeight')
            ->will($this->returnValue($this->_zHeight1));

        $this->_xLatitude2 = $this->getMock('Geodetic\\Angle');
        $this->_xLatitude2->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(53.477831));
        $this->_yLongitude2 = $this->getMock('Geodetic\\Angle');
        $this->_yLongitude2->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-2.242584));
        $this->_zHeight2 = $this->getMock('Geodetic\\Distance');
        $this->_zHeight2->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.0));

        $this->_xyz2 = $this->getMock('Geodetic\\LatLong');
        $this->_xyz2->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue($this->_xLatitude2));
        $this->_xyz2->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue($this->_yLongitude2));
        $this->_xyz2->expects($this->any())
            ->method('getHeight')
            ->will($this->returnValue($this->_zHeight2));

        $this->_xLatitude3 = $this->getMock('Geodetic\\Angle');
        $this->_xLatitude3->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(53.760484));
        $this->_yLongitude3 = $this->getMock('Geodetic\\Angle');
        $this->_yLongitude3->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-2.704010));
        $this->_zHeight3 = $this->getMock('Geodetic\\Distance');
        $this->_zHeight3->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.0));

        $this->_xyz3 = $this->getMock('Geodetic\\LatLong');
        $this->_xyz3->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue($this->_xLatitude3));
        $this->_xyz3->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue($this->_yLongitude3));
        $this->_xyz3->expects($this->any())
            ->method('getHeight')
            ->will($this->returnValue($this->_zHeight3));

        $this->_xLatitude4 = $this->getMock('Geodetic\\Angle');
        $this->_xLatitude4->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(53.540307));
        $this->_yLongitude4 = $this->getMock('Geodetic\\Angle');
        $this->_yLongitude4->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-2.635345));
        $this->_zHeight4 = $this->getMock('Geodetic\\Distance');
        $this->_zHeight4->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.0));

        $this->_xyz4 = $this->getMock('Geodetic\\LatLong');
        $this->_xyz4->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue($this->_xLatitude4));
        $this->_xyz4->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue($this->_yLongitude4));
        $this->_xyz4->expects($this->any())
            ->method('getHeight')
            ->will($this->returnValue($this->_zHeight4));

        $this->_xLatitude5 = $this->getMock('Geodetic\\Angle');
        $this->_xLatitude5->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(53.574773));
        $this->_yLongitude5 = $this->getMock('Geodetic\\Angle');
        $this->_yLongitude5->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(-3.073683));
        $this->_zHeight5 = $this->getMock('Distance');
        $this->_zHeight5->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(0.0));

        $this->_xyz5 = $this->getMock('Geodetic\\LatLong');
        $this->_xyz5->expects($this->any())
            ->method('getLatitude')
            ->will($this->returnValue($this->_xLatitude5));
        $this->_xyz5->expects($this->any())
            ->method('getLongitude')
            ->will($this->returnValue($this->_yLongitude5));
        $this->_xyz5->expects($this->any())
            ->method('getHeight')
            ->will($this->returnValue($this->_zHeight5));
    }


    public function testInstantiate()
    {
        $regionObject = new Region();
        //    Must return an object...
        $this->assertTrue(is_object($regionObject));
        //    ... of the correct type
        $this->assertTrue(is_a($regionObject, 'Geodetic\\Region'));
	}

    public function testInstantiateWithValues()
    {
        $regionObject = new Region(
            array(
            	$this->_xyz1,
            	$this->_xyz2,
            	$this->_xyz3
            )
        );
        //    Must return an object...
        $this->assertTrue(is_object($regionObject));
        //    ... of the correct type
        $this->assertTrue(is_a($regionObject, 'Geodetic\\Region'));

		$pointSet = $regionObject->getPerimeterPoints();
        $this->assertTrue(is_array($pointSet));
        $this->assertEquals(4, count($pointSet));
    }

    /**
     * @expectedException Exception
     */
    public function testInstantiateWithInvalidValues()
    {
        $regionObject = new Region(
            array(
            	$this->_xyz1,
            	$this->_xyz2,
            	'Strings are invalid'
            )
        );
    }

    /**
     * @expectedException Exception
     */
    public function testInstantiateWithInvalidValueCount()
    {
        $regionObject = new Region(
            array(
            	$this->_xyz1,
            	$this->_xyz2
            )
        );
    }

    public function testPointInsideRegion()
    {
        $regionObject = new Region(
            array(
            	$this->_xyz1,
            	$this->_xyz2,
            	$this->_xyz3
            )
        );
        //    Must return an object...
		$pointInRegion = $regionObject->isInRegion($this->_xyz4);
        $this->assertTrue($pointInRegion);
    }

    public function testPointOutsideRegion()
    {
        $regionObject = new Region(
            array(
            	$this->_xyz1,
            	$this->_xyz2,
            	$this->_xyz3
            )
        );
        //    Must return an object...
		$pointInRegion = $regionObject->isInRegion($this->_xyz5);
        $this->assertFalse($pointInRegion);
    }

}
