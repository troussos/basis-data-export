<?php


namespace troussos\basis\assessments;


use troussos\basis\AssessmentBase;

/**
 * Class GSR
 * @package troussos\basis\assessments
 */
class GSR extends AssessmentBase
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
        $this->units = "Microsiemens";
    }
}