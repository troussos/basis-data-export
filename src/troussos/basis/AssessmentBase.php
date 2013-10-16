<?php
/**
 * @category biosensors
 * @package Basisexport
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license http://opensource.org/licenses/GPL-2.0 GPLv2
 * @version GIT: 0d175b2a66a129694395f99971bf6600fc053374
 * @link http://github.com/troussos/basis-export
 */
namespace troussos\basis;

/**
 * Class AssessmentBase
 *
 * The base assessment class which is extended to create a more
 * sepecifc assessments.
 *
 * @see AirTemp Air Tempature
 * @see Calories Calories
 * @see GSR Galvanic Skin Response
 * @see HeartRate Heart Rate
 * @see SkinTemp Skin Tempature
 * @see Steps Steps
 *
 * @used-by AirTemp Calories GSR HearRate SkinTemp Steps
 *
 */
abstract class AssessmentBase
{

    /**
     * @var float Minimum Value Recorded
     */
    private $_min;

    /**
     * @var float Maximum Value Recorded
     */
    private $_max;

    /**
     * @var float Sum of the Values
     */
    private $_sum;

    /**
     * @var float Standard Deviation of the Values
     */
    private $_stdev;

    /**
     * @var float Average of the values
     */
    private $_avg;

    /**
     * @var array Array of readings.
     *      Key is the epoch timestamp of when the reading was taken
     */
    private $_summary;

    /**
     * @var string Units that the assessment is measured in.
     */
    protected $units;

    /**
     * Creates the assessment object with the common elements.
     *
     * @param int   $startTime Start time of assessment as an Epoch timestamp
     * @param int   $interval  Interval which the assessments are spread, second
     * @param array $rawData   Raw data that was recieved from My Basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        $this->_min = $rawData['min'];
        $this->_max = $rawData['max'];
        $this->_sum = $rawData['sum'];
        $this->_avg = $rawData['avg'];
        $this->_stdev = $rawData['stdev'];

        //Loop through the raw value array and set the keys to the epoch time,
        //based on the start time and offset
        foreach ($rawData['values'] as $key => $item)
        {
            $this->_summary[$startTime + ($key * $interval)] = $item;
        }
    }

    /**
     * Get the maximum assessment value
     *
     * @return float
     */
    public function getMax()
    {
        return $this->_max;
    }

    /**
     * Get the minimum assessment value
     *
     * @return float
     */
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * Get the sum of all of the assessments
     *
     * @return float
     */
    public function getSum()
    {
        return $this->_sum;
    }

    /**
     * Get the summary of all of the assessment readings. The timestamp of the
     * reading is the key of the array.
     *
     * @return array
     */
    public function getSummary()
    {
        return $this->_summary;
    }

    /**
     * Get the units that the readings are in
     *
     * @return Units of the assessment
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Get the avergae value of the assessments
     *
     * @return Average of the assessment values
     */
    public function getAvg()
    {
        return $this->_avg;
    }

    /**
     * Get the standard deviaton of the assessment readings
     *
     * @return Standard Deviation of the assessment values
     */
    public function getStdev()
    {
        return $this->_stdev;
    }
}