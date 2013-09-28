<?php


namespace troussos\basis;


abstract class AssessmentBase
{

    private $min;

    private $max;

    private $sum;

    private $summary;

    public function __construct($startTime, $interval, array $rawData)
    {
        $this->min = $rawData['min'];
        $this->max = $rawData['max'];
        $this->sum = $rawData['sum'];
        foreach ($rawData['values'] as $key => $item)
        {
            $this->summary[$startTime + ($key * $interval)] = $item;
        }
    }
}