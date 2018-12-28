<?php
namespace App\Entities;

class Walk
{
    private $distance;

    public function __construct(float $distance)
    {
        $this->distance = $distance;
    }

    public function getDistance()
    {
        return $this->distance;
    }
}
