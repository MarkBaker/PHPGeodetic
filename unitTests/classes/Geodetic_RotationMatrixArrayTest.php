<?php


class RotationMatrixArrayTest extends PHPUnit_Framework_TestCase
{

    protected $_xAngle;
    protected $_yAngle;
    protected $_zAngle;

    protected function setUp()
    {
        $this->_xAngle = $this->getMock('Geodetic_Angle');
        $this->_xAngle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(15.0));
        $this->_yAngle = $this->getMock('Geodetic_Angle');
        $this->_yAngle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(30.0));
        $this->_zAngle = $this->getMock('Geodetic_Angle');
        $this->_zAngle->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue(45.0));
    }


    public function testInstantiate()
    {
        $matrixObject = new Geodetic_RotationMatrixArray(
            array(
                $this->_xAngle,
                $this->_yAngle,
                $this->_zAngle
            )
        );
        //    Must return an object...
        $this->assertTrue(is_object($matrixObject));
        //    ... of the correct type
        $this->assertTrue(is_a($matrixObject, 'Geodetic_RotationMatrixArray'));

        $matrixXValue = $matrixObject->getX();
        $matrixDefaultX = $matrixObject->getX();
        $this->assertTrue(is_object($matrixDefaultX));
        $this->assertTrue(is_a($matrixDefaultX, 'Geodetic_Angle'));
        $this->assertEquals(15.0, $matrixDefaultX->getValue());

        $matrixYValue = $matrixObject->getY()->getValue();
        $matrixDefaultY = $matrixObject->getY();
        $this->assertTrue(is_object($matrixDefaultY));
        $this->assertTrue(is_a($matrixDefaultY, 'Geodetic_Angle'));
        $this->assertEquals(30.0, $matrixDefaultY->getValue());

        $matrixZValue = $matrixObject->getZ()->getValue();
        $matrixDefaultZ = $matrixObject->getZ();
        $this->assertTrue(is_object($matrixDefaultZ));
        $this->assertTrue(is_a($matrixDefaultZ, 'Geodetic_Angle'));
        $this->assertEquals(45.0, $matrixDefaultZ->getValue());
    }

    /**
     * @expectedException Geodetic_Exception
     */
    public function testInstantiateWithInvalidArray()
    {
        $matrixObject = new Geodetic_RotationMatrixArray(
            array(
                $this->_xAngle,
                $this->_yAngle
            )
        );
    }

}
