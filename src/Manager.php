<?php

namespace App;

use App\Entities\Point;
use App\Entities\ActionSequence;
use App\Entities\Turn;

class Manager
{
    private $directions;
    private $points = [];

    public function __construct($directions)
    {
        $this->directions = $directions;

        foreach ($directions as $inputLine) {
            $matches = null;
            preg_match('/([-+]?[0-9]*\.?[0-9]+) ([-+]?[0-9]*\.?[0-9]+)/', $inputLine, $matches);
            $startPoint = new Point((float) $matches[1], (float) $matches[2]);

            $matches = null;
            preg_match('/start ([-+]?[0-9]*\.?[0-9]+)/', $inputLine, $matches);
            $startTurn = new Turn((float) $matches[1]);

            $matches = null;
            preg_match_all('/(walk|turn) [-+]?[0-9]*\.?[0-9]+/', $inputLine, $matches);

            $actionSequence = new ActionSequence($matches[0]);

            $this->points[] = $actionSequence->applyActions($startPoint, $startTurn);
        }
    }

    public function getAveragePoint(): Point
    {
        $midX = 0;
        $midY = 0;

        /**
         * @var $point Point
         */
        foreach ($this->points as $point) {
            $midX += $point->getX();
            $midY += $point->getY();
        }

        $totalPoints = count($this->points);

        $midX = round($midX / $totalPoints, 4);
        $midY = round($midY / $totalPoints, 4);

        return new Point($midX, $midY);
    }

    public function getWorstDistance(Point $averagePoint): float
    {
        $worstDistance = 0;

        /**
         * @var $point Point
         */
        foreach ($this->points as $point) {
            $distance = sqrt(($point->getX() - $averagePoint->getX()) ** 2
                + ($point->getY() - $averagePoint->getY()) ** 2);

            if ($distance > $worstDistance) {
                $worstDistance = $distance;
            }
        }

        return round($worstDistance, 5);
    }
}
