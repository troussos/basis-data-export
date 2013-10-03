<?php

namespace troussos\basis\assessments;

use troussos\basis\AssessmentBase;

/**
 * Class Calories
 *
 * A class fo the calorie assessment. This class extends the AssessmentBase class
 * and implements calorie specific methods.
 *
 * @see AssessmentBase Assessment Base Class
 *
 * @uses AssessmentBase Assessment Base
 *
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license GNU Public License
 * @license http://opensource.org/licenses/GPL-2.0
 * @package troussos\basis\assessments
 */
class Calories extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent constructor to parse the data.
     *
     * @param int $startTime Epoch of the start time of the assessment
     * @param int $interval Interval representing how many seconds apart each assessment is
     * @param array $rawData The raw data recieved from the reciever
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Calories Burned";
    }
}