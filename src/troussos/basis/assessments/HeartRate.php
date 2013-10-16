<?php
/**
 * Class to represent Heart Rate
 *
 * This class is the base for the heart rate assessment. It extends the
 * AssessmentBase class.
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