<?php

namespace troussos\basis\assessments;

use troussos\basis\AssessmentBase;

/**
 * Class Steps
 *
 * A class to represent steps. This extends the AssessmentBase Class and adds
 * step specific methods.
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
class Steps extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent
     * constructor to parse the data.
     *
     * @param int   $startTime The start time of the assessment as an epoch
     * @param int   $interval  The interval at which the assessments are
     *                         spaced in seconds
     * @param array $rawData   Raw data from My Basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Steps Taken";
    }
}