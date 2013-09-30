<?php


namespace troussos\basis;

/**
 * Class AssessmentBase
 * @package troussos\basis
 */
abstract class AssessmentBase
{

    /**
     * @var Minimum Value Recorded
     */
    private $min;

    /**
     * @var Maximum Value Recorded
     */
    private $max;

    /**
     * @var Sum of the Values
     */
    private $sum;

    /**
     * @var Standard Deviation of the Values
     */
    private $stdev;

    /**
     * @var Average of the values
     */
    private $avg;

    /**
     * @var Array of readings. Key is the epoch timestamp of when the reading was taken
     */
    private $summary;

    /**
     * @var Units that the assessment is measured in.
     */
    protected $units;

    /**
     * Creates the assessment object with the common elements.
     *
     * @param $startTime
     * @param $interval
     * @param array $rawData
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
     * @return $max
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return $min
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return $sum
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @return $summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return Units of the assessment
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @return Average of the assessment values
     */
    public function getAvg()
    {
        return $this->avg;
    }

    /**
     * @return Standard Deviation of the assessment values
     */
    public function getStdev()
    {
        return $this->stdev;
    }
}