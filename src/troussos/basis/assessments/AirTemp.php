<?php
/**
 * Class to represent Air Tempature
 *
 * This class is the base for the air tempature assessment. It extends the
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