<?php

namespace Geodetic;

class TranslationVectorValuesTest extends \PHPUnit_Framework_TestCase
{

    protected $_xDdistance;
    protected $_yDistance;
    protected $_zDistance;

    protected function setUp()
    {
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
    }


    public function testInstantiate()
    {
        $matrixObject = new TranslationVectorValues();
        //    Must return an object...
        $this->assertTrue(is_object($matrixObject));
        //    ... of the correct type
        $this->assertTrue(is_a($matrixObject, 'Geodetic\\TranslationVectorValues'));

        $matrixDefaultX = $matrixObject->getX();
        $this->assertTrue(is_object($matrixDefaultX));
        $this->assertTrue(is_a($matrixDefaultX, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $matrixDefaultX->getValue());

        $matrixDefaultXValue = $matrixObject->getX()->getValue();
        $this->assertEquals(0.0, $matrixDefaultXValue);

        $matrixDefaultY = $matrixObject->getY();
        $this->assertTrue(is_object($matrixDefaultY));
        $this->assertTrue(is_a($matrixDefaultY, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $matrixDefaultY->getValue());

        $matrixDefaultYValue = $matrixObject->getY()->getValue();
        $this->assertEquals(0.0, $matrixDefaultYValue);

        $matrixDefaultZ = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixDefaultZ));
        $this->assertTrue(is_a($matrixDefaultZ, 'Geodetic\\Distance'));
        $this->assertEquals(0.0, $matrixDefaultZ->getValue());

        $matrixDefaultZValue = $matrixObject->getZ()->getValue();
        $this->assertEquals(0.0, $matrixDefaultZValue);
    }

    public function testInstantiateWithValues()
    {
        $matrixObject = new TranslationVectorValues(
            $this->_xDistance,
            $this->_yDistance,
            $this->_zDistance
        );

        $matrixXValue = $matrixObject->getX();
        $matrixDefaultX = $matrixObject->getX();
        $this->assertTrue(is_object($matrixDefaultX));
        $this->assertTrue(is_a($matrixDefaultX, 'Geodetic\\Distance'));
        $this->assertEquals(15.0, $matrixDefaultX->getValue());

        $matrixYValue = $matrixObject->getY()->getValue();
        $matrixDefaultY = $matrixObject->getY();
        $this->assertTrue(is_object($matrixDefaultY));
        $this->assertTrue(is_a($matrixDefaultY, 'Geodetic\\Distance'));
        $this->assertEquals(30.0, $matrixDefaultY->getValue());

        $matrixZValue = $matrixObject->getZ()->getValue();
        $matrixDefaultZ = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixDefaultZ));
        $this->assertTrue(is_a($matrixDefaultZ, 'Geodetic\\Distance'));
        $this->assertEquals(45.0, $matrixDefaultZ->getValue());
    }

}
