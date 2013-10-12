<?php


namespace troussos\basis\assessments;

use troussos\basis\assessments\AirTemp;

/**
 * Class AirTempTest
 * @package troussos\basis\assessments
 */
class AirTempTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the creation of a new Air temp object.
     *
     * @covers troussos\basis\assessments\AirTemp::__construct
     * @covers troussos\basis\AssessmentBase::__construct
     */
    public function testConstruct()
    {
        //Define the assessment parameters
        $startTime = 1234567890;
        $interval = 60;
        $rawArray = array(
            "min" => 80.5,
            "max" => 110,
            "sum" => 567,
            "values" => array(83, 84, 82, 97, 85, 91),
            "avg" => 85,
            "stdev" => 4.4
        );
        $airTemp = new AirTemp($startTime, $interval, $rawArray);

        //Validate the basic assessment parameters
        $this->assertEquals('Degrees Fahrenheit', $airTemp->getUnits());
        $this->assertEquals(80.5, $airTemp->getMin());
        $this->assertEquals(110, $airTemp->getMax());
        $this->assertEquals(567, $airTemp->getSum());
        $this->assertEquals(85, $airTemp->getAvg());
        $this->assertEquals(4.4, $airTemp->getStdev());

        //Grab the Raw Value Array from the object
        $values = $airTemp->getSummary();

        //Make sure that the keys have been updated to reflect the actual time the assessment was taken
        $this->assertEquals(83, $values[1234567890]);
        $this->assertEquals(84, $values[1234567950]);
        $this->assertEquals(82, $values[1234568010]);
        $this->assertEquals(97, $values[1234568070]);
        $this->assertEquals(85, $values[1234568130]);
        $this->assertEquals(91, $values[1234568190]);
    }
}