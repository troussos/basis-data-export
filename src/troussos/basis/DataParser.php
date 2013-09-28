<?php

namespace troussos\basis;

use troussos\basis\assessments\AirTemp;
use troussos\basis\assessments\Calories;
use troussos\basis\assessments\GSR;
use troussos\basis\assessments\HeartRate;
use troussos\basis\assessments\SkinTemp;
use troussos\basis\assessments\Steps;

/**
 * Class DataParser
 * @package troussos\basis
 */
class DataParser
{
    /**
     * @var - Begining point of the assessments
     */
    private $startTime;

    /**
     * @var - End point of the assessments
     */
    private $endTime;

    /**
     * @var - How many seconds each index equals.
     *
     * For example if interval is set to 60, each assessment is taken 60 seconds apart.
     * So, in the value array, an index of 1 means $startTime + 60.
     * An index of 2 means $startTime + 120.
     */
    private $interval;

    /**
     * @var - Copy of the timezone array from the response.
     *        Only need if the device's offset is important since the start and stop times are epoch.
     */
    private $timezone;

    /**
     * @var - Body State Object. Hold a a list of the different active states amongst other things.
     */
    private $bodystates;

    /**
     * @var null - HearRate object, if hearRate was retrieved.
     */
    private $heartrate = null;

    /**
     * @var null - Steps Object, if steps were retrieved.
     */
    private $steps = null;

    /**
     * @var null - Skin Temperature object if skin temperature was retrieved.
     */
    private $skinTemp = null;

    /**
     * @var null - Air Temperature object if air temperature was retrieved.
     */
    private $airTemp = null;

    /**
     * @var null - Calorie object if calories were retrieved
     */
    private $calories = null;

    /**
     * @var null - Galvanic Skin response object if GSR was retrieved.
     */
    private $gsr = null;

    /**
     * Sets up the parsedData object
     *
     * @param $rawData
     */
    public function __construct($rawData)
    {
        //Parse the JSON into a PHP Array
        $rawArray = json_decode($rawData, true);

        //Pull the standard data out of the raw data array
        $this->startTime = $rawArray['starttime'];
        $this->endTime = $rawArray['endtime'];
        $this->interval = $rawArray['interval'];
        $this->timezone = $rawArray['timezone_history'];
        $this->bodystates = $rawArray['bodystates']; //TODO - Parse Body States

        //Parse the retrieved metrics
        $this->parseMetrics($rawArray);
    }

    /**
     * Parses the Metrics into the appropriate objects, if that metrics has been retrieved
     *
     * @param array $rawArray
     */
    private function parseMetrics(array $rawArray)
    {
        //If hearrate was pulled, then process the hearrate data
        if(isset($rawArray['metrics']['heartrate']))
        {
            $this->heartrate = new HeartRate($this->startTime, $this->interval, $rawArray['metrics']['heartrate']);
        }

        //If steps was pulled, then process the steps data
        if(isset($rawArray['metrics']['steps']))
        {
            $this->steps = new Steps($this->startTime, $this->interval, $rawArray['metrics']['steps']);
        }

        //If gsr was pulled, then process the gsr data
        if(isset($rawArray['metrics']['gsr']))
        {
            $this->gsr = new GSR($this->startTime, $this->interval, $rawArray['metrics']['gsr']);
        }

        //If skintemp was pulled, then process the skintemp data
        if(isset($rawArray['metrics']['skin_temp']))
        {
            $this->skinTemp = new SkinTemp($this->startTime, $this->interval, $rawArray['metrics']['skin_temp']);
        }

        //If airtemp was pulled, then process the airtemp data
        if(isset($rawArray['metrics']['air_temp']))
        {
            $this->airTemp = new AirTemp($this->startTime, $this->interval, $rawArray['metrics']['air_temp']);
        }

        //If calories was pulled, then process the calories data
        if(isset($rawArray['metrics']['calories']))
        {
            $this->calories = new Calories($this->startTime, $this->interval, $rawArray['metrics']['calories']);
        }
    }
}