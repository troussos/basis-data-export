<?php


namespace troussos\basis;

use troussos\basis\DataParser;

/**
 * Class DataParserTest
 * @package troussos\basis
 */
class DataParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var $dataParser DataParser - Data Parse object to test against
     */
    private $dataParser;

    /**
     * @var $rawData array - Array of raw data that can be used to make DataParser objects
     */
    private $rawData;

    /**
     * Setup the initial dataparser and raw data object based on some test data
     * @coversNothing
     */
    public function __construct()
    {
        //This huge array is a same of the type of data that the My Basis API will return. We are using it
        //to run unit tests against.
        $this->rawData = array(
            "metrics" => array(
                "skin_temp" => array(
                    "min" => 80.9,
                    "max" => 94.1,
                    "sum" => 127504.5,
                    "summary" => array(
                        "max_skin_temp_per_minute" => '',
                        "min_skin_temp_per_minute" => ''
                    ),
                    "values" => array(
                        88.1,
                        88.2,
                        88.2,
                        88.3,
                        88.3,
                        88.2,
                        88.4,
                        88.5,
                        88.7,
                        88.7,
                        88.7
                    ),
                    "stdev" => 2.4,
                    "avg" => 88.7
                ),
                "heartrate" => array(
                    "min" => 30,
                    "max" => 135,
                    "sum" => 74628,
                    "summary" => array(
                        "max_heartrate_per_minute" => '',
                        "min_heartrate_per_minute" => ''
                    ),
                    "values" => array(
                        72,
                        73,
                        76,
                        72,
                        74,
                        72,
                        72,
                        71,
                        71,
                        82,
                        74
                    ),
                    "stdev" => 12,
                    "avg" => 75
                ),
                "air_temp" => array(
                    "min" => 71.3,
                    "max" => 93.2,
                    "sum" => 119084.2,
                    "summary" => array(
                        "max_air_temp_per_minute" => '',
                        "min_air_temp_per_minute" => ''
                    ),
                    "values" => array(
                        81.1,
                        81.1,
                        81.1,
                        81.1,
                        81.1,
                        81.1,
                        81.1,
                        81.1,
                        81.2,
                        81.5,
                        81.5
                    ),
                    "stdev" => 3.9,
                    "avg" => 82.8
                ),
                "calories" => array(
                    "min" => 1.3,
                    "max" => 14,
                    "sum" => 2959.9,
                    "summary" => array (
                        "min_calories_per_minute" => '',
                        "max_calories_per_minute" => ''
                    ),
                    "values" => array(
                        1.6,
                        1.6,
                        1.8,
                        1.6,
                        1.4,
                        1.5,
                        1.5,
                        1.5,
                        1.6,
                        1.6
                    ),
                    "stdev" => 1.1,
                    "avg" => 2.1
                ),
                "gsr" => array(
                    "min" => 0.000103,
                    "max" => 15.4,
                    "sum" => 894,
                    "summary" => array(
                        "max_gsr_per_minute" => '',
                        "min_gsr_per_minute" => ''
                    ),
                    "values" => array(
                        0.00102,
                        0.00103,
                        0.000995,
                        0.0011,
                        0.000944,
                        0.00102,
                        0.00108,
                        0.00118,
                        0.00118,
                        0.00121,
                        0.00114
                    ),
                    "stdev" => 2.72,
                    "avg" => 0.621
                ),
                "steps" => array(
                    "min" => 0,
                    "max" => 106,
                    "sum" => 3100,
                    "summary" => array(
                        "max_steps_per_minute" => '',
                        "min_steps_per_minute" => ''
                    ),
                    "values" => array(
                        14,
                        53,
                        67,
                        21,
                        63,
                        23,
                        31,
                        43,
                        15,
                        12
                    ),
                    "stdev" => 10.2,
                    "avg" => 2
                )
            ),
            "endtime" => 1380427140,
            "interval" => 60,
            "starttime" => 1380340800,
            "bodystates" => array(
                array(
                    1380427140,
                    1380427680,
                    "light_activity"
                ),
                array(
                    1380426780,
                    1380427140,
                    "inactive"
                ),
                array(
                    1380426240,
                    1380426780,
                    "light_activity"
                ),
                array(
                    1380424140,
                    1380426240,
                    "moderate_activity"
                ),
                array(
                    1380423720,
                    1380424140,
                    "light_activity"
                ),
            ),
            "timezone_history" => array(
                array(
                    "timezone" => "America/New_York",
                    "start" => 1380340800,
                    "offset" => -4
                )
            )
        );

        //Create a data parser object and toss it in the class variable
        $this->dataParser = new DataParser(json_encode($this->rawData));
    }

    //Unit Tests below this comment are not completed, or properly commented. Beware!

    public function testGetAirTemp()
    {
        $airTemp = $this->dataParser->getAirTemp();
        $this->assertInstanceOf('troussos\basis\assessments\AirTemp', $airTemp);
        //TEST THAT THE VALUES OF AIR TEMP ARE GOOD
    }

    public function testGetCalories()
    {
        $calories = $this->dataParser->getCalories();
        $this->assertInstanceOf('troussos\basis\assessments\Calories', $calories);
        //TEST THAT THE VALUES OF AIR TEMP ARE GOOD
    }

    public function testGetGSR()
    {
        $gsr = $this->dataParser->getGsr();
        $this->assertInstanceOf('troussos\basis\assessments\GSR', $gsr);
        //Check that GSR is good
    }

    public function testGetHeartrate()
    {
        $heartRate = $this->dataParser->getHeartrate();
        $this->assertInstanceOf('troussos\basis\assessments\HeartRate', $heartRate);
        //Check that heart rate is good
    }

    public function testGetSkinTemp()
    {
        $skinTemp = $this->dataParser->getSkinTemp();
        $this->assertInstanceOf('troussos\basis\assessments\SkinTemp', $skinTemp);
        //Check that skin temp is good
    }

    public function testGetSteps()
    {
        $steps = $this->dataParser->getSteps();
        $this->assertInstanceOf('troussos\basis\assessments\Steps', $steps);
        //Check that steps is good
    }

    public function testGetTimezone()
    {

    }

    public function testGetStartTime()
    {

    }

    public function testGetInterval()
    {

    }

    public function testGetEndTime()
    {

    }

    public function testGetBodyState()
    {

    }

}
