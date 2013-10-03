<?php

namespace troussos\basis\assessments;

use troussos\basis\AssessmentBase;

/**
 * Class SkinTemp
 *
 * A class to represent the skin tempature. This extends the Assessment Base class
 * and adds skin tempature specific methods.
 *
 * @uses AssessmentBase
 * @see AssessmentBase Assessment Base Class
 *
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license GNU Public License
 * @license http://opensource.org/licenses/GPL-2.0
 * @package troussos\basis\assessments
 */
class SkinTemp extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent constructor to parse the data.
     *
     * @param int $startTime The epoch start time of the assessment
     * @param int $interval The interval at which the assessments are spaced in seconds
     * @param array $rawData The raw data from My Basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Degrees Fahrenheit";
    }
}