<?php

namespace Geodetic;

class RotationMatrixTest extends \PHPUnit_Framework_TestCase
{

    protected $_angle;
    protected $_xDangle;
    protected $_yAngle;
    protected $_zAngle;
    protected $_xyz;


    protected function setUp()
    {
        $this->_angle = $this->getMock('Geodetic\\Angle');
        $this->_angle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(12345.0));

        $this->_xAngle = $this->getMock('Geodetic\\Angle');
        $this->_xAngle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(15.0));
        $this->_yAngle = $this->getMock('Geodetic\\Angle');
        $this->_yAngle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(30.0));
        $this->_zAngle = $this->getMock('Geodetic\\Angle');
        $this->_zAngle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(45.0));

        $this->_xyz = $this->getMock('Geodetic\\RotationMatrixValues');
        $this->_xyz->expects($this->any())
            ->method('getX')
            ->will($this->returnValue($this->_xAngle));
        $this->_xyz->expects($this->any())
            ->method('getY')
            ->will($this->returnValue($this->_yAngle));
        $this->_xyz->expects($this->any())
            ->method('getZ')
            ->will($this->returnValue($this->_zAngle));
    }


    public function testInstantiate()
    {
        $matrixObject = new RotationMatrix();
        //    Must return an object...
        $this->assertTrue(is_object($matrixObject));
        //    ... of the correct type
        $this->assertTrue(is_a($matrixObject, 'Geodetic\\RotationMatrix'));

        $matrixDefaultX = $matrixObject->getX();
        $this->assertTrue(is_object($matrixDefaultX));
        $this->assertTrue(is_a($matrixDefaultX, 'Geodetic\\Angle'));
        $this->assertEquals(0.0, $matrixDefaultX->getValue());

        $matrixDefaultY = $matrixObject->getY();
        $this->assertTrue(is_object($matrixDefaultY));
        $this->assertTrue(is_a($matrixDefaultY, 'Geodetic\\Angle'));
        $this->assertEquals(0.0, $matrixDefaultY->getValue());

        $matrixDefaultZ = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixDefaultZ));
        $this->assertTrue(is_a($matrixDefaultZ, 'Geodetic\\Angle'));
        $this->assertEquals(0.0, $matrixDefaultZ->getValue());
    }

    public function testInstantiateWithValues()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $matrixXValue = $matrixObject->getX()->getValue();
        $this->assertEquals(15.0, $matrixXValue);

        $matrixYValue = $matrixObject->getY()->getValue();
        $this->assertEquals(30.0, $matrixYValue);

        $matrixZValue = $matrixObject->getZ()->getValue();
        $this->assertEquals(45.0, $matrixZValue);
    }

    public function testSetXValue()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $fluidReturn = $matrixObject->setX($this->_angle);
        $matrixXValue = $matrixObject->getX();
        $this->assertTrue(is_object($matrixXValue));
        $this->assertTrue(is_a($matrixXValue, 'Geodetic\\Angle'));
        $this->assertEquals(12345.0, $matrixXValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\RotationMatrix'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetXValueInvalid()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $fluidReturn = $matrixObject->setX();
    }

    public function testSetYValue()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $fluidReturn = $matrixObject->setY($this->_angle);
        $matrixYValue = $matrixObject->getY();
        $this->assertTrue(is_object($matrixYValue));
        $this->assertTrue(is_a($matrixYValue, 'Geodetic\\Angle'));
        $this->assertEquals(12345.0, $matrixYValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\RotationMatrix'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetYValueInvalid()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $fluidReturn = $matrixObject->setY();
    }

    public function testSetZValue()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $fluidReturn = $matrixObject->setZ($this->_angle);
        $matrixZValue = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixZValue));
        $this->assertTrue(is_a($matrixZValue, 'Geodetic\\Angle'));
        $this->assertEquals(12345.0, $matrixZValue->getValue());

        //    Test fluid return object
        $this->assertTrue(is_object($fluidReturn));
        //    ... of the correct type
        $this->assertTrue(is_a($fluidReturn, 'Geodetic\\RotationMatrix'));
    }

    /**
     * @expectedException Exception
     */
    public function testSetZValueInvalid()
    {
        $matrixObject = new RotationMatrix($this->_xyz);

        $fluidReturn = $matrixObject->setZ();
    }

}
