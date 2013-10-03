<?php

namespace troussos\basis;

/**
 * Class AssessmentBase
 *
 * The base assessment class which is extended to create a more sepecifc assessments.
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
 * @author Tyler Roussos <tylerroussos@gmail.com>
 * @license GNU Public License
 * @license http://opensource.org/licenses/GPL-2.0
 * @package troussos\basis
 */
abstract class AssessmentBase
{

    /**
     * @var float Minimum Value Recorded
     */
    private $min;

    /**
     * @var float Maximum Value Recorded
     */
    private $max;

    /**
     * @var float Sum of the Values
     */
    private $sum;

    /**
     * @var float Standard Deviation of the Values
     */
    private $stdev;

    /**
     * @var float Average of the values
     */
    private $avg;

    /**
     * @var array Array of readings. Key is the epoch timestamp of when the reading was taken
     */
    private $summary;

    /**
     * @var string Units that the assessment is measured in.
     */
    protected $units;

    /**
     * Creates the assessment object with the common elements.
     *
     * @param int $startTime Start time of assessment as an Epoch timestamp
     * @param int $interval Interval at which the assessments are spread in seconds.
     * @param array $rawData Raw data that was recieved from My Basis
     */
    public function __construct($startTime, $interval, array $rawData)
    {
        $this->min = $rawData['min'];
        $this->max = $rawData['max'];
        $this->sum = $rawData['sum'];
        $this->avg = $rawData['avg'];
        $this->stdev = $rawData['stdev'];

        //Loop through the raw value array and set the keys to the epoch time, based on the start time and offset
        foreach ($rawData['values'] as $key => $item)
        {
            $this->summary[$startTime + ($key * $interval)] = $item;
        }
    }

    /**
     * Get the maximum assessment value
     *
     * @return float
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Get the minimum assessment value
     *
     * @return float
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Get the sum of all of the assessments
     *
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Get the summary of all of the assessment readings. The timestamp of the reading is the key of the array.
     *
     * @return array
     */
    public function getSummary()
    {
        return $this->summary;
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
        return $this->avg;
    }

    /**
     * Get the standard deviaton of the assessment readings
     *
     * @return Standard Deviation of the assessment values
     */
    public function getStdev()
    {
        return $this->stdev;
    }
}