<?php

namespace Geodetic;

class TranslationVectorsTest extends \PHPUnit_Framework_TestCase
{

    protected $_distance;
    protected $_xDdistance;
    protected $_yDistance;
    protected $_zDistance;
    protected $_xyz;

    protected function setUp()
    {
        $this->_distance = $this->getMock('Geodetic\\Distance');
        $this->_distance->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(12345.0));

        $this->_xDistance = $this->getMock('Geodetic\\Distance');
        $this->_xDistance->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(15.0));
        $this->_yDistance = $this->getMock('Geodetic\\Distance');
        $this->_yDistance->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(30.0));
        $this->_zDistance = $this->getMock('Geodetic\\Distance');
        $this->_zDistance->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(45.0));

        $this->_xyz = $this->getMock('Geodetic\\TranslationVectorValues');
        $this->_xyz->expects($this->any())
            ->method('getX')
            ->will($this->returnValue($this->_xDistance));
        $this->_xyz->expects($this->any())
            ->method('getY')
            ->will($this->returnValue($this->_yDistance));
        $this->_xyz->expects($this->any())
            ->method('getZ')
            ->will($this->returnValue($this->_zDistance));
    }


    public function testInstantiate()
    {
        $matrixObject = new TranslationVectors();
        //    Must return an object...
        $this->assertTrue(is_object($matrixObject));
        //    ... of the correct type
        $this->assertTrue(is_a($matrixObject, 'Geodetic\\TranslationVectors'));

        $matrixDefaultX = $matrixObject->getX();
        $this->assertTrue(is_object($matrixDefaultX));
        $this->assertTrue(is_a($matrixDefaultX, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $matrixDefaultX->getValue());

        $matrixDefaultY = $matrixObject->getY();
        $this->assertTrue(is_object($matrixDefaultY));
        $this->assertTrue(is_a($matrixDefaultY, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $matrixDefaultY->getValue());

        $matrixDefaultZ = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixDefaultZ));
        $this->assertTrue(is_a($matrixDefaultZ, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $matrixDefaultZ->getValue());
    }

    public function testInstantiateWithValues()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $matrixXValue = $matrixObject->getX()->getValue();
        $this->assertEquals(15.0, $matrixXValue);

        $matrixYValue = $matrixObject->getY()->getValue();
        $this->assertEquals(30.0, $matrixYValue);

        $matrixZValue = $matrixObject->getZ()->getValue();
        $this->assertEquals(45.0, $matrixZValue);
    }

    public function testSetXValue()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $fluidReturn = $matrixObject->setX($this->_distance);
        $matrixXValue = $matrixObject->getX();
        $this->assertTrue(is_object($matrixXValue));
        $this->assertTrue(is_a($matrixXValue, 'Geodetic\\Distance'));
        $this->assertEquals(12345.0, $matrixXValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\TranslationVectors'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetXValueInvalid()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $fluidReturn = $matrixObject->setX();
    }

    public function testSetYValue()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $fluidReturn = $matrixObject->setY($this->_distance);
        $matrixYValue = $matrixObject->getY();
        $this->assertTrue(is_object($matrixYValue));
        $this->assertTrue(is_a($matrixYValue, 'Geodetic\\Distance'));
        $this->assertEquals(12345.0, $matrixYValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\TranslationVectors'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetYValueInvalid()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $fluidReturn = $matrixObject->setY();
    }

    public function testSetZValue()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $fluidReturn = $matrixObject->setZ($this->_distance);
        $matrixZValue = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixZValue));
        $this->assertTrue(is_a($matrixZValue, 'Geodetic\\Distance'));
        $this->assertEquals(12345.0, $matrixZValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\TranslationVectors'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetZValueInvalid()
    {
        $matrixObject = new TranslationVectors($this->_xyz);

        $fluidReturn = $matrixObject->setZ();
    }

}
