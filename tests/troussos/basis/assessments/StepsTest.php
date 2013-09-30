<?php


namespace troussos\basis\assessments;

/**
 * Class StepsTest
 * @package troussos\basis\assessments
 */
class StepsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the creation of a new steps object.
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
        $steps = new Steps($startTime, $interval, $rawArray);

        //Validate the basic assessment parameters
        $this->assertEquals('Steps Taken', $steps->getUnits());
        $this->assertEquals(80.5, $steps->getMin());
        $this->assertEquals(110, $steps->getMax());
        $this->assertEquals(567, $steps->getSum());
        $this->assertEquals(85, $steps->getAvg());
        $this->assertEquals(4.4, $steps->getStdev());

        //Grab the Raw Value Array from the object
        $values = $steps->getSummary();

        //Make sure that the keys have been updated to reflect the actual time the assessment was taken
        $this->assertEquals(83, $values[1234567890]);
        $this->assertEquals(84, $values[1234567950]);
        $this->assertEquals(82, $values[1234568010]);
        $this->assertEquals(97, $values[1234568070]);
        $this->assertEquals(85, $values[1234568130]);
        $this->assertEquals(91, $values[1234568190]);
    }
}