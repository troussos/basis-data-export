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
     * @var $dataParser DataParser Data Parse object to test against
     */
    private $dataParser;

    /**
     * @var $rawData array Array of raw data that can
     *       be used to make DataParser objects
     */
    private $rawData;

    /**
     * Setup the initial dataparser and raw data object based on some test data
     * @coversNothing
     */
    public function __construct()
    {
        //This huge array is a same of the type of data that the My
        //Basis API will return. We are using it to run unit tests against.
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

    /**
     * Test the constructor and the private _parseMetrics method. Thiw will
     * ensure that the object is being setup properly when it is constructed.
     *
     * @covers troussos\basis\DataParser::__construct
     * @covers troussos\basis\DataParser::_parseMetrics
     */
    public function testConstruct()
    {
        $functionParser = new DataParser(json_encode($this->rawData));

        $this->assertInstanceOf(
            'troussos\basis\assessments\AirTemp',
            $functionParser->getAirTemp()
        );

        $this->assertInstanceOf(
            'troussos\basis\assessments\Calories',
            $functionParser->getCalories()
        );

        $this->assertInstanceOf(
            'troussos\basis\assessments\GSR',
            $functionParser->getGsr()
        );

        $this->assertInstanceOf(
            'troussos\basis\assessments\HeartRate',
            $functionParser->getHeartrate()
        );

        $this->assertInstanceOf(
            'troussos\basis\assessments\SkinTemp',
            $functionParser->getSkinTemp()
        );

        $this->assertInstanceOf(
            'troussos\basis\assessments\Steps',
            $functionParser->getSteps()
        );
    }

    /**
     * Ensure that the air tempature object that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getAirTemp
     */
    public function testGetAirTemp()
    {
        $airTemp = $this->dataParser->getAirTemp();

        $this->assertInstanceOf(
            'troussos\basis\assessments\AirTemp',
            $airTemp
        );

        $this->assertEquals('82.8', $airTemp->getAvg());
        $this->assertEquals('71.3', $airTemp->getMin());
        $this->assertEquals('93.2', $airTemp->getMax());
        $this->assertEquals('119084.2', $airTemp->getSum());
        $this->assertEquals('3.9', $airTemp->getStdev());
        $this->assertEquals('Degrees Fahrenheit', $airTemp->getUnits());

        $testArray = array(
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
        );

        $summaryArray = $airTemp->getSummary();
        $testArrayi = 0;

        foreach($summaryArray as $entry)
        {
            $this->assertEquals($testArray[$testArrayi], $entry);
            $testArrayi++;
        }

    }

    /**
     * Ensure that the calories object that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getCalories
     */
    public function testGetCalories()
    {
        $calories = $this->dataParser->getCalories();

        $this->assertInstanceOf(
            'troussos\basis\assessments\Calories',
            $calories
        );

        $this->assertEquals('2.1', $calories->getAvg());
        $this->assertEquals('1.3', $calories->getMin());
        $this->assertEquals('14', $calories->getMax());
        $this->assertEquals('2959.9', $calories->getSum());
        $this->assertEquals('1.1', $calories->getStdev());
        $this->assertEquals('Calories Burned', $calories->getUnits());

        $testArray = array(
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
        );

        $summaryArray = $calories->getSummary();
        $testArrayi = 0;

        foreach($summaryArray as $entry)
        {
            $this->assertEquals($testArray[$testArrayi], $entry);
            $testArrayi++;
        }
    }

    public function testGetGSR()
    {
        $gsr = $this->dataParser->getGsr();
        $this->assertInstanceOf('troussos\basis\assessments\GSR', $gsr);
        $this->assertEquals('0.621', $gsr->getAvg());
        $this->assertEquals('0.000103', $gsr->getMin());
        $this->assertEquals('15.4', $gsr->getMax());
        $this->assertEquals('894', $gsr->getSum());
        $this->assertEquals('2.72', $gsr->getStdev());
        $this->assertEquals('Microsiemens', $gsr->getUnits());

        $testArray = array(
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
        );

        $summaryArray = $gsr->getSummary();
        $testArrayi = 0;

        foreach($summaryArray as $entry)
        {
            $this->assertEquals($testArray[$testArrayi], $entry);
            $testArrayi++;
        }
    }

    /**
     * Ensure that the heart rate object that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getHeartrate
     */
    public function testGetHeartrate()
    {
        $heartRate = $this->dataParser->getHeartrate();

        $this->assertInstanceOf(
            'troussos\basis\assessments\HeartRate',
            $heartRate
        );

        $this->assertEquals('75', $heartRate->getAvg());
        $this->assertEquals('30', $heartRate->getMin());
        $this->assertEquals('135', $heartRate->getMax());
        $this->assertEquals('74628', $heartRate->getSum());
        $this->assertEquals('12', $heartRate->getStdev());
        $this->assertEquals('Beats per Minute', $heartRate->getUnits());

        $testArray = array(
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
        );

        $summaryArray = $heartRate->getSummary();
        $testArrayi = 0;

        foreach($summaryArray as $entry)
        {
            $this->assertEquals($testArray[$testArrayi], $entry);
            $testArrayi++;
        }
    }

    /**
     * Ensure that the skin tempature object that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getSkinTemp
     */
    public function testGetSkinTemp()
    {
        $skinTemp = $this->dataParser->getSkinTemp();

        $this->assertInstanceOf(
            'troussos\basis\assessments\SkinTemp',
            $skinTemp
        );

        $this->assertEquals('88.7', $skinTemp->getAvg());
        $this->assertEquals('80.9', $skinTemp->getMin());
        $this->assertEquals('94.1', $skinTemp->getMax());
        $this->assertEquals('127504.5', $skinTemp->getSum());
        $this->assertEquals('2.4', $skinTemp->getStdev());
        $this->assertEquals('Degrees Fahrenheit', $skinTemp->getUnits());

        $testArray = array(
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
        );
        $testArrayi = 0;

        $summaryArray = $skinTemp->getSummary();
        foreach($summaryArray as $entry)
        {
            $this->assertEquals($testArray[$testArrayi], $entry);
            $testArrayi++;
        }
    }

    /**
     * Ensure that the steps object that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getSteps
     */
    public function testGetSteps()
    {
        $steps = $this->dataParser->getSteps();
        $this->assertInstanceOf('troussos\basis\assessments\Steps', $steps);
        $this->assertEquals('2', $steps->getAvg());
        $this->assertEquals('0', $steps->getMin());
        $this->assertEquals('106', $steps->getMax());
        $this->assertEquals('3100', $steps->getSum());
        $this->assertEquals('10.2', $steps->getStdev());
        $this->assertEquals('Steps Taken', $steps->getUnits());

        $testArray = array(
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
        );

        $summaryArray = $steps->getSummary();
        $testArrayi = 0;

        foreach($summaryArray as $entry)
        {
            $this->assertEquals($testArray[$testArrayi], $entry);
            $testArrayi++;
        }
    }

    /**
     * Ensure that the timezone that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getTimezone
     */
    public function testGetTimezone()
    {
        $timezone = $this->dataParser->getTimezone();

        $this->assertEquals(1380340800, $timezone[0]['start']);
        $this->assertEquals(-4, $timezone[0]['offset']);
        $this->assertEquals('America/New_York', $timezone[0]['timezone']);
    }

    /**
     * Ensure that the start time that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getStartTime
     */
    public function testGetStartTime()
    {
        $this->assertEquals(1380340800, $this->dataParser->getStartTime());
    }

    /**
     * Ensure that the interval that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getInterval
     */
    public function testGetInterval()
    {
        $this->assertEquals(60, $this->dataParser->getInterval());
    }

    /**
     * Ensure that the end time that is automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getEndTime
     */
    public function testGetEndTime()
    {
        $this->assertEquals(1380427140, $this->dataParser->getEndTime());
    }

    /**
     * Ensure that the body states that are automtically created is
     * vaid.
     *
     * @covers troussos\basis\DataParser::getBodyStates
     */
    public function testGetBodyState()
    {
        $bodyStatesArray = $this->dataParser->getBodystates();

        $expectedBodyStates = array
        (
            array
            (
                'startTime' => 1380427140,
                'endTime' => 1380427680,
                'activityLevel' => 'light_activity'
            ),
            array
            (
                'startTime' => 1380426780,
                'endTime' => 1380427140,
                'activityLevel' => 'inactive'
            ),
            array
            (
                'startTime' => 1380426240,
                'endTime' => 1380426780,
                'activityLevel' => 'light_activity'
            ),
            array
            (
                'startTime' => 1380424140,
                'endTime' => 1380426240,
                'activityLevel' => 'moderate_activity'
            ),
            array
            (
                'startTime' => 1380423720,
                'endTime' => 1380424140,
                'activityLevel' => 'light_activity'
            )
        );

        for($i=0; $i < count($expectedBodyStates); $i++)
        {
            $this->assertEquals($expectedBodyStates[$i], $bodyStatesArray[$i]);
        }
    }
}
