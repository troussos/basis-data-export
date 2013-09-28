<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tylerroussos
 * Date: 9/27/13
 * Time: 10:02 PM
 * To change this template use File | Settings | File Templates.
 */

namespace troussos\basis;


/**
 * Class DataUrl
 * @package troussos\basis
 */
class DataUrl {

    /**
     * @var string - The Base URL for the request (this part comes before the userId)
     */
    private $baseURL = 'https://app.mybasis.com/api/v1/chart/';

    /**
     * @var string - The static extension for the URL (this part comes after userId)
     */
    private $baseURLExtension = '.json?summary=true&units=s';

    /**
     * @var null
     */
    private $interval = null;

    /**
     * @var null
     */
    private $start_date = null;

    /**
     * @var null
     */
    private $start_offset = null;

    /**
     * @var null
     */
    private $end_offset = null;

    /**
     * @var array - Array of all of the assessments and their status
     */
    private $assessments = array(
        'heartrate'  => true,
        'steps'      => true,
        'calories'   => true,
        'gsr'        => true,
        'skin_temp'  => true,
        'air_temp'   => true,
        'bodystates' => true
    );

    /**
     * Generates a URL based on the class parameters. The URL will have the following format.
     *
     * BaseURL - UserId - BaseURLExtension - Other Parameters
     *
     * The order of the other parameters dose not matter since they are just URL parameters. The first
     * three variables must be in that order, however, since they are forming the root URL.
     *
     * @param $userId
     * @return string
     * @throws \LogicException
     */
    public function generateRequestURL($userId)
    {
        //Have all of the time intervals and limits been set?
        if(
            is_null($this->interval) ||
            is_null($this->start_date) ||
            is_null($this->start_offset) ||
            is_null($this->end_offset)
        ){
            //If they haven't, throw an exception
            throw new \LogicException('All of the data url parameters must be set before generating a URL');
        }

        //Run through the assessment array and concat the assessments into a set of URL parameters
        $assessments = '';
        foreach ($this->assessments as $key => $item)
        {
            //Need to do this tenary operation because PHP dose not have true booleans and the url parameter expects it
            $val = ($item) ? 'true' : 'false';
            $assessments .= '&' . $key . '=' . $val;
        }

        //Form the URl and return it back to the calling function
        return
            $this->baseURL .
            $userId .
            $this->baseURLExtension .
            "&start_date=" . $this->start_date .
            "&start_offset=" . $this->start_offset .
            "&end_offset=" . $this->end_offset .
            $assessments;
    }

    /**
     * Validate and set the assessments. This will also maintain any assessments that have not been change with
     * their current values.
     *
     * @param array $assessments
     * @throws \OutOfBoundsException
     */
    public function setAssessments(array $assessments)
    {
        //Saving the current assessments so we can maintain the settings of assessments that don't change
        $oldAssessments = $this->assessments;

        //List out the valid keys
        $validKeys = array(
            'heartrate'  => false,
            'steps'      => false,
            'calories'   => false,
            'gsr'        => false,
            'skin_temp'  => false,
            'air_temp'   => false,
            'bodystates' => false);

        //Loop through the passed in array and make sure that all of the assessments are listed in the $validKeys
        foreach($assessments as $key => $item)
        {
            //Check if the array key exists in $validKeys
            if(!array_key_exists($key, $validKeys))
            {
                //If it dose not, throw and exception
                throw new \OutOfBoundsException(
                    'Assessment '.$key.' is not a valid assessment. Valid assessments are ' .
                    implode(', ', array_keys($validKeys))
                );
            }
            //If the assessment has been updated, remove it from the old assessments
            unset($oldAssessments[$key]);
        }
        //If all is good, then set the class property and merge the keys that were not set with the previous values
        $this->assessments = array_merge($assessments, $oldAssessments);
    }

    /**
     * @return array
     */
    public function getAssessments()
    {
        return $this->assessments;
    }

    /**
     * @param mixed $end_offset
     */
    public function setEndOffset($end_offset)
    {
        //TODO: Validate the End Offset
        $this->end_offset = $end_offset;
    }

    /**
     * @return mixed
     */
    public function getEndOffset()
    {
        return $this->end_offset;
    }

    /**
     * @param mixed $interval
     */
    public function setInterval($interval)
    {
        //TODO: Validate the Interval
        $this->interval = $interval;
    }

    /**
     * @return mixed
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        //TODO: Validate the start Date
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_offset
     */
    public function setStartOffset($start_offset)
    {
        //TODO: Validate the start offset
        $this->start_offset = $start_offset;
    }

    /**
     * @return mixed
     */
    public function getStartOffset()
    {
        return $this->start_offset;
    }
}