<?php
/**
 * @category biosensors
 * @package Basisexport
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GPLv2
 * @version GIT: 0d175b2a66a129694395f99971bf6600fc053374
 * @link http://github.com/troussos/basis-export
 */
namespace troussos\basis\assessments;

use troussos\basis\AssessmentBase;

/**
 * Class Calories
 *
 * A class for the calorie assessment.
 * This class extends the AssessmentBase class and implements
 * calorie specific methods.
 *
 * @see AssessmentBase Assessment Base Class
 *
 * @uses AssessmentBase Assessment Base
 *
 */
class Calories extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent
     * constructor to parse the data.
     *
     * @param int   $startTime Epoch of the start time of the assessment
     * @param int   $interval  Interval representing how many seconds apart
     *                         each assessment is
     * @param array $rawData   The raw data recieved from the reciever
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Calories Burned";
    }
}