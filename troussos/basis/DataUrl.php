<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tylerroussos
 * Date: 9/27/13
 * Time: 10:02 PM
 * To change this template use File | Settings | File Templates.
 */

namespace troussos\basis;


class DataUrl {

    private $baseURL = 'https://app.mybasis.com/api/v1/chart/';

    private $baseURLExtension = '.json?summary=true,units=s';

    private $interval;

    private $start_date;

    private $start_offset;

    private $end_offset;

    private $assessments = array(
        'heartrate'  => true,
        'steps'      => true,
        'calories'   => true,
        'gsr'        => true,
        'skin_temp'  => true,
        'air_temp'   => true,
        'bodystates' => true
    );

    public function generateRequestURL($userId)
    {
        //Make the request URL here using the userID
    }

    /**
     * @param array $assessments
     */
    public function setAssessments(array $assessments)
    {
        $validKeys = array('heartrate' => 0, 'steps' => 0, 'calories' => 0, 'gsr' => 0, 'skin_temp' => 0, 'air_temp' => 0, 'bodystates' => 0);
        foreach($assessments as $key => $item)
        {
            if(!array_key_exists($key, $validKeys))
            {
                throw new \OutOfBoundsException(
                    'Assessment '.$key.' is not a valid assessment. Valid assessments are ' .
                    implode(', ', array_keys($validKeys))
                );
            }
        }
        $this->assessments = $assessments;
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





/*
 * $dataurl = 'https://app.mybasis.com/api/v1/chart/' . $basis_userid . '.json?'
         . 'summary=true'
         . '&interval=' . $import_interval
         . '&units=s'
         . '&start_date=' . $import_date
         . '&start_offset=' . $import_offset
         . '&end_offset=' . $import_offset
         . '&heartrate=true'
         . '&steps=true'
         . '&calories=true'
         . '&gsr=true'
         . '&skin_temp=true'
         . '&air_temp=true'
         . '&bodystates=true';
 */