<?php
/**
 * Class to represent Skin Tempature
 *
 * This class is the base for the Skin Tempature assessment. It extends the
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
 * Class SkinTemp
 *
 * A class to represent the skin tempature. This extends the
 * Assessment Base class and adds skin tempature specific methods.
 *
 * @uses AssessmentBase
 * @see AssessmentBase Assessment Base Class
 *
 */
class SkinTemp extends AssessmentBase
{
    /**
     * Set the units for the assessment and call the parent constructor
     * to parse the data.
     *
     * @param int   $startTime The epoch start time of the assessment
     * @param int   $interval  The interval at which the assessments are
     *                         spaced in seconds
     * @param array $rawData   The raw data from My Basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        parent::__construct($startTime, $interval, $rawData);
        $this->units = "Degrees Fahrenheit";
    }
}