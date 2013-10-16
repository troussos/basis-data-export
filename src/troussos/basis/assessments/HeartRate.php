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
 * Class HeartRate
 *
 * A class to represent heart rate. This extends the Assessment Base class and
 * adds heartrate specific methods.
 *
 * @see AssessmentBase Assessment Base Class
 *
 * @uses AssessmentBase Assessment Base
 *
 */
class HeartRate extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent constructor
     * to parse the data.
     *
     * @param int   $startTime Epoch Representation of the start time
     * @param int   $interval  Interval at which the assessments are spaced
     *                         in seconds
     * @param array $rawData   The raw data from My Basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Beats per Minute";
    }
}