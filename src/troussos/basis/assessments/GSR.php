<?php

namespace troussos\basis\assessments;

use troussos\basis\AssessmentBase;

/**
 * Class GSR
 *
 * A class to represent glavanic skin response.
 * This class extends the AssessmentBase class and implements
 * GSR specific methods.
 *
 * @see AssessmentBase Assessment Base Class
 * @link http://en.wikipedia.org/wiki/Skin_conductance Galvanic Skin Response
 *
 * @uses AssessmentBase Assessment Base
 *
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license GNU Public License
 * @license http://opensource.org/licenses/GPL-2.0
 * @package troussos\basis\assessments
 */
class GSR extends AssessmentBase
{

    /**
     * Set the units for the assessment and call the parent constructor
     * to parse the data.
     *
     * @param int   $startTime Epoch of the start time of the assessment
     * @param int   $interval  Interval to how far apart each assessment is
     *                         (e.g. 60 means they are 1 minute apart)
     * @param array $rawData   The raw data from the reciever
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Microsiemens";
    }
}