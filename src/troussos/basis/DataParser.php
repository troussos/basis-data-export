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
 *
 * A class which parses the data recieved from the data reciever.
 *
 * @see AirTemp Air Tempature
 * @see Calories Calories
 * @see GSR Galvanic Skin Response
 * @see HeartRate Heart Rate
 * @see SkinTemp Skin Tempature
 * @see Steps Steps
 *
 * @uses AirTemp Air Tempature
 * @uses Calories Calories
 * @uses GSR GSR
 * @uses HearRate Heart Rate
 * @uses SkinTemp Skin Tempature
 * @uses Steps Steps
 *
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license GNU Public License
 * @license http://opensource.org/licenses/GPL-2.0
 * @package troussos\basis
 */
class DataParser
{
    /**
     * @var int Begining point of the assessments as an epoch timestamp
     */
    private $startTime;

    /**
     * @var int End point of the assessments as an epoch timestamp
     */
    private $endTime;

    /**
     * @var int How many seconds each index equals.
     *
     * For example if interval is set to 60, each assessment is taken 60 seconds apart.
     * So, in the value array, an index of 1 means $startTime + 60.
     * An index of 2 means $startTime + 120.
     */
    private $interval;

    /**
     * @var array Copy of the timezone array from the response.
     *            Only need if the device's offset is important since the start and stop times are epoch.
     */
    private $timezone;

    /**
     * @var array Body State Object. Hold a a list of the different active states amongst other things.
     */
    private $bodystates;

    /**
     * @var HeartRate HearRate object, if hearRate was retrieved.
     */
    private $heartrate = null;

    /**
     * @var Steps Steps Object, if steps were retrieved.
     */
    private $steps = null;

    /**
     * @var SkinTemp Skin Temperature object if skin temperature was retrieved.
     */
    private $skinTemp = null;

    /**
     * @var AirTemp Air Temperature object if air temperature was retrieved.
     */
    private $airTemp = null;

    /**
     * @var Calories Calorie object if calories were retrieved
     */
    private $calories = null;

    /**
     * @var GSR Galvanic Skin response object if GSR was retrieved.
     */
    private $gsr = null;

    /**
     * Sets up the parsedData object
     *
     * @param string $rawData Raw JSON string recieved from My Basis
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

        //Initalize a new array to hold the body states
        $bodyStateArray = array();

        //Loop through the exisitng body states and switch the keys
        foreach($rawArray['bodystates'] as $bodyState)
        {
            $formattedBodyState = array(
                "startTime" => $bodyState[0],
                "endTime" => $bodyState[1],
                "activityLevel" => $bodyState[2]
            );
            //Push the new body state array onto the overall array
            array_push($bodyStateArray, $formattedBodyState);
        }
        //Set the body state property to the body state array
        $this->bodystates = $bodyStateArray;

        //Parse the retrieved metrics
        $this->parseMetrics($rawArray);
    }

    /**
     * Parses the Metrics into the appropriate objects, if that metrics has been retrieved
     *
     * @param array $rawArray Raw array from My Basis. Basically their JSON decoded into a php array
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

    /**
     * Get the air tempature object
     *
     * @return AirTemp Air Temp Object
     */
    public function getAirTemp()
    {
        return $this->airTemp;
    }

    /**
     * Get the body states array
     *
     * @return array Body State Array
     */
    public function getBodystates()
    {
        return $this->bodystates;
    }

    /**
     * Get the calories object
     *
     * @return Calories Calorie Object
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * Get the end time
     *
     * @return int End Time
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Get the GSR Object
     *
     * @return GSR GSR Object
     */
    public function getGsr()
    {
        return $this->gsr;
    }

    /**
     * Get the heart rate object
     *
     * @return HeartRate Heart Rate Object
     */
    public function getHeartrate()
    {
        return $this->heartrate;
    }

    /**
     * Get the assessment interval
     *
     * @return int Interval
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Get the skin tempature object
     *
     * @return SkinTemp Skin Temp Object
     */
    public function getSkinTemp()
    {
        return $this->skinTemp;
    }

    /**
     * Get the start time
     *
     * @return int Start Time
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Get the steps object
     *
     * @return Steps Steps Object
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Get the timezoen array
     *
     * @return array Timezone Array
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}