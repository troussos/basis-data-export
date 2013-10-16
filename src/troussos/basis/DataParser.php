<?php
/**
 * Class to the return from the My Basis API
 *
 * This class serves as a data parser. It will pull in data from the My Basis
 * API and parse it out into a usable array.
 *
 * PHP version 5.3
 *
 * LICENSE: Licensed under the GPLv2. Avalible from
 * http://opensource.org/licenses/GPL-2.0
 *
 * @category Biosensors
 * @package  Basisexport
 * @author   Tyler Roussos <tylerroussos@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GPLv2
 * @version  GIT: $Id$
 * @link     http://github.com/troussos/basis-export
 */
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
 */
class DataParser
{
    /**
     * @var int Begining point of the assessments as an epoch timestamp
     */
    private $_startTime;

    /**
     * @var int End point of the assessments as an epoch timestamp
     */
    private $_endTime;

    /**
     * @var int How many seconds each index equals.
     *
     * For example if interval is set to 60, each assessment is taken
     * 60 seconds apart. So, in the value array,
     * an index of 1 means $startTime + 60.
     * An index of 2 means $startTime + 120.
     */
    private $_interval;

    /**
     * @var array Copy of the timezone array from the response.
     *            Only need if the device's offset is important
     *            since the start and stop times are epoch.
     */
    private $_timezone;

    /**
     * @var array Body State Object. Hold a a list of the different
     *            active states amongst other things.
     */
    private $_bodystates;

    /**
     * @var HeartRate HearRate object, if hearRate was retrieved.
     */
    private $_heartrate = null;

    /**
     * @var Steps Steps Object, if steps were retrieved.
     */
    private $_steps = null;

    /**
     * @var SkinTemp Skin Temperature object if skin temperature was retrieved.
     */
    private $_skinTemp = null;

    /**
     * @var AirTemp Air Temperature object if air temperature was retrieved.
     */
    private $_airTemp = null;

    /**
     * @var Calories Calorie object if calories were retrieved
     */
    private $_calories = null;

    /**
     * @var GSR Galvanic Skin response object if GSR was retrieved.
     */
    private $_gsr = null;

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
        $this->_startTime = $rawArray['starttime'];
        $this->_endTime = $rawArray['endtime'];
        $this->_interval = $rawArray['interval'];
        $this->_timezone = $rawArray['timezone_history'];

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
        $this->_bodystates = $bodyStateArray;

        //Parse the retrieved metrics
        $this->_parseMetrics($rawArray);
    }

    /**
     * Parses the Metrics into the appropriate objects,
     * if that metrics has been retrieved
     *
     * @param array $rawArray Raw array from My Basis.
     *                        Basically their JSON decoded into a php array
     *
     * @return $this
     */
    private function _parseMetrics(array $rawArray)
    {
        //If hearrate was pulled, then process the hearrate data
        if(isset($rawArray['metrics']['heartrate']))
        {
            $this->_heartrate = new HeartRate(
                $this->_startTime,
                $this->_interval,
                $rawArray['metrics']['heartrate']
            );
        }

        //If steps was pulled, then process the steps data
        if(isset($rawArray['metrics']['steps']))
        {
            $this->_steps = new Steps(
                $this->_startTime,
                $this->_interval,
                $rawArray['metrics']['steps']
            );
        }

        //If gsr was pulled, then process the gsr data
        if(isset($rawArray['metrics']['gsr']))
        {
            $this->_gsr = new GSR(
                $this->_startTime,
                $this->_interval,
                $rawArray['metrics']['gsr']
            );
        }

        //If skintemp was pulled, then process the skintemp data
        if(isset($rawArray['metrics']['skin_temp']))
        {
            $this->_skinTemp = new SkinTemp(
                $this->_startTime,
                $this->_interval,
                $rawArray['metrics']['skin_temp']
            );
        }

        //If airtemp was pulled, then process the airtemp data
        if(isset($rawArray['metrics']['air_temp']))
        {
            $this->_airTemp = new AirTemp(
                $this->_startTime,
                $this->_interval,
                $rawArray['metrics']['air_temp']
            );
        }

        //If calories was pulled, then process the calories data
        if(isset($rawArray['metrics']['calories']))
        {
            $this->_calories = new Calories(
                $this->_startTime,
                $this->_interval,
                $rawArray['metrics']['calories']
            );
        }
        return $this;
    }

    /**
     * Get the air tempature object
     *
     * @return AirTemp Air Temp Object
     */
    public function getAirTemp()
    {
        return $this->_airTemp;
    }

    /**
     * Get the body states array
     *
     * @return array Body State Array
     */
    public function getBodystates()
    {
        return $this->_bodystates;
    }

    /**
     * Get the calories object
     *
     * @return Calories Calorie Object
     */
    public function getCalories()
    {
        return $this->_calories;
    }

    /**
     * Get the end time
     *
     * @return int End Time
     */
    public function getEndTime()
    {
        return $this->_endTime;
    }

    /**
     * Get the GSR Object
     *
     * @return GSR GSR Object
     */
    public function getGsr()
    {
        return $this->_gsr;
    }

    /**
     * Get the heart rate object
     *
     * @return HeartRate Heart Rate Object
     */
    public function getHeartrate()
    {
        return $this->_heartrate;
    }

    /**
     * Get the assessment interval
     *
     * @return int Interval
     */
    public function getInterval()
    {
        return $this->_interval;
    }

    /**
     * Get the skin tempature object
     *
     * @return SkinTemp Skin Temp Object
     */
    public function getSkinTemp()
    {
        return $this->_skinTemp;
    }

    /**
     * Get the start time
     *
     * @return int Start Time
     */
    public function getStartTime()
    {
        return $this->_startTime;
    }

    /**
     * Get the steps object
     *
     * @return Steps Steps Object
     */
    public function getSteps()
    {
        return $this->_steps;
    }

    /**
     * Get the timezoen array
     *
     * @return array Timezone Array
     */
    public function getTimezone()
    {
        return $this->_timezone;
    }
}