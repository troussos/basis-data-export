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
 * Class AirTemp
 *
 * This class represents the air tempature assessment.
 * It extends the base assessment class and implements
 * air tempature specific methods.
 *
 * @see AssessmentBase Assessment Base Class
 *
 * @uses AssessmentBase Assessment Base
 *
 */
class AirTemp extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent
     * constructor to parse the data.
     *
     * @param int   $startTime Epoch representation of
     *                         the start time of the assessment
     * @param int   $interval  Interval representing how
     *                         far apart each assessment is taken in seconds
     * @param array $rawData   The raw data from my basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Degrees Fahrenheit";
    }
}