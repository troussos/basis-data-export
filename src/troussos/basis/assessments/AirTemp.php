<?php


namespace troussos\basis\assessments;


use troussos\basis\AssessmentBase;

/**
 * Class AirTemp
 * @package troussos\basis\assessments
 */
class AirTemp extends AssessmentBase
{

    /**
     * Set the units for the assessment and call the parent constructor to parse the data.
     *
     * @param $startTime
     * @param $interval
     * @param array $rawData
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Degrees Fahrenheit";
    }
}