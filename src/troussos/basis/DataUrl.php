<?php
/**
 * Class to handle various URL formats and parameters.
 *
 * This class will hold the various parameters that can be used when
 * construting a URL to interact with the My Basis API.
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


/**
 * Class DataUrl
 *
 * A class that holds the parameters for the various types of requests that
 * we can make to My Basis. This class will setup a URL that will pull data
 * down the the My Basis API.
 *
 * @see BasisReceiver Basis Receiver
 *
 * @used-by BasisReceiver Basis Receiver
 *
 */
class DataUrl
{

    /**
     * @var string The Base URL for the request
     *      (this part comes before the userId)
     */
    private $_baseURL = 'https://app.mybasis.com/api/v1/chart/';

    /**
     * @var string The static extension for the URL
     *      (this part comes after userId)
     */
    private $_baseURLExtension = '.json?summary=true&units=s';

    /**
     * @var int Data Granularity (60 = 1 per minute, 1 = 1 per second, etc.)
     *      Value should not be below 60, no additional detail gets passed back
     *      at that level.
     */
    private $_interval = 60;

    /**
     * @var string The start date to get assessments from.
     *      This will run from the start date until now.
     */
    private $_start_date = null;

    /**
     * @var int The offset from midnight in seconds to start pulling data
     */
    private $_start_offset = 0;

    /**
     * @var int The offset from midnight in seconds to stop pulling data
     */
    private $_end_offset = 0;

    /**
     * @var array Array of all of the assessments and their status
     */
    private $_assessments = array(
        'heartrate'  => TRUE,
        'steps'      => TRUE,
        'calories'   => TRUE,
        'gsr'        => TRUE,
        'skin_temp'  => TRUE,
        'air_temp'   => TRUE,
        'bodystates' => TRUE
    );

    /**
     * Generates a URL based on the class parameters.
     * The URL will have the following format.
     *
     * BaseURL - UserId - BaseURLExtension - Other Parameters
     *
     * The order of the other parameters dose not matter since they are
     * just URL parameters. The first three variables must be in that order,
     * however, since they are forming the root URL.
     *
     * @param string $userId The userid whose data we want to get
     *
     * @throws \LogicException Start Date has not been set
     * @return string URL for the request that the class represents
     */
    public function generateRequestURL($userId)
    {
        //Have all of the time intervals and limits been set?
        if(is_null($this->_start_date))
        {
            //If they haven't, throw an exception
            throw new \LogicException(
                'Start Date must be set prior to generating a URL', 45
            );
        }

        //Run through the assessment array and concat the assessments into
        //a set of URL parameters
        $assessments = '';
        foreach ($this->_assessments as $key => $item)
        {
            //Need to do this tenary operation because PHP dose not have true
            //booleans and the url parameter expects it
            $val = ($item) ? 'true' : 'false';
            $assessments .= '&' . $key . '=' . $val;
        }

        //Form the URl and return it back to the calling function
        return
            $this->_baseURL .
            $userId .
            $this->_baseURLExtension .
            "&start_date=" . $this->_start_date .
            "&start_offset=" . $this->_start_offset .
            "&end_offset=" . $this->_end_offset .
            $assessments;
    }

    /**
     * Validate and set the assessments. This will also maintain any assessments
     * that have not been change with their current values.
     *
     * @param array $assessments An array of the assessments to get
     *
     * @throws \OutOfBoundsException The assessment is not a valid
     *                               My Bais Assessment
     * @return $this
     */
    public function setAssessments(array $assessments)
    {
        //Saving the current assessments so we can maintain the settings of
        //assessments that don't change
        $oldAssessments = $this->_assessments;

        //List out the valid keys
        $validKeys = array(
            'heartrate'  => FALSE,
            'steps'      => FALSE,
            'calories'   => FALSE,
            'gsr'        => FALSE,
            'skin_temp'  => FALSE,
            'air_temp'   => FALSE,
            'bodystates' => FALSE
        );

        //Loop through the passed in array and make sure that all of the
        //assessments are listed in the $validKeys
        foreach(array_keys($assessments) as $key)
        {
            //Check if the array key exists in $validKeys
            if(!array_key_exists($key, $validKeys))
            {
                //If it dose not, throw and exception
                throw new \OutOfBoundsException(
                    'Assessment ' .
                    $key .
                    ' is not a valid assessment. Valid assessments are ' .
                    implode(', ', array_keys($validKeys))
                );
            }
            //If the assessment has been updated, remove it from the
            //old assessments
            unset($oldAssessments[$key]);
        }
        //If all is good, then set the class property and merge the keys
        //that were not set with the previous values
        $this->_assessments = array_merge($assessments, $oldAssessments);

        return $this;
    }

    /**
     * Get the current list of assessments and their getting status
     * (true or false)
     *
     * @return array Array of assessments
     */
    public function getAssessments()
    {
        return $this->_assessments;
    }

    /**
     * Set the interval and make sure that it is both above 60 and is numeric
     *
     * @param int $interval Interval of seconds between each data point
     *
     * @throws \InvalidArgumentException The parameter passed is not valid
     * @return $this
     */
    public function setInterval($interval)
    {
        //Make sure that the interval is numeric
        if(!is_numeric($interval))
        {
            throw new \InvalidArgumentException(
                'Interval must be set to an integer'
            );
        }

        //Make sure that the interval is above 60, anything less that 60
        //provides not additional detail
        if($interval < 60)
        {
            throw new \InvalidArgumentException(
                'Interval must be greater than 60'
            );
        }

        $this->_interval = $interval;

        return $this;
    }

    /**
     * Get the interval of seconds between each assessment
     *
     * @return int Interval of seconds between each assessment
     */
    public function getInterval()
    {
        return $this->_interval;
    }

    /**
     * Sets the start date and validates it as ISO 8601
     *
     * @param string $start_date ISO 8601 date string
     *
     * @throws \InvalidArgumentException Passed string is not ISO 8601
     * @return $this
     */
    public function setStartDate($start_date)
    {
        //Parse the date
        $date = date_parse($start_date);
        if (!(checkdate($date["month"], $date["day"], $date["year"])))
        {
            throw new \InvalidArgumentException(
                'Start Date must be an ISO 8601 date string'
            );
        }
        $this->_start_date = $start_date;

        return $this;
    }

    /**
     * Get the start date
     *
     * @return string ISO 8601 string
     */
    public function getStartDate()
    {
        return $this->_start_date;
    }
}