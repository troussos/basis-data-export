<?php
/**
 * Class to represent Steps
 *
 * This class is the base for the Steps Assessment. It extends the
 * AssessmentBase Class.
 *
 * PHP version 5.3
 *
 * LICENSE: Licensed under the GPLv2. Avalible from
 * http://opensource.org/licenses/GPL-2.0
 *
 * @category Biosensors
 * @package  Basisexport
 * @author   Tyler Roussos <tylerroussos@gmail.com>
 * @license  http://opensource.org/licenses/GPL-2.0 GPLv2
 * @version  GIT: $Id$
 * @link     http://github.com/troussos/basis-export
 */
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