<?php

namespace App\Entities;

class Point
{
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function createNewPoint(Turn $turn, Walk $walk)
    {
        $newX = $this->x + ($walk->getDistance() * cos($turn->getDegrees() * pi() / 180));
        $newY = $this->y + ($walk->getDistance() * sin($turn->getDegrees() * pi() / 180));

        return new Point($newX, $newY);
    }
}
