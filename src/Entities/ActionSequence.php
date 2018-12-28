<?php

namespace App\Entities;

class ActionSequence
{
    private $sequence = [];

    public function __construct(array $actions)
    {
        foreach ($actions as $action) {
            list($type, $number) = explode(' ', $action);

            if ($type === 'walk') {
                $this->sequence[] = new Walk((float) $number);
            } else {
                $this->sequence[] = new Turn((float) $number);
            }
        }
    }

    public function applyActions(Point $startPoint, Turn $startTurn): Point
    {
        $newPoint = clone $startPoint;

        foreach ($this->sequence as $action) {
            if ($action instanceof Turn) {
                $startTurn->add($action);
            }

            if ($action instanceof Walk) {
                $newPoint = $newPoint->createNewPoint($startTurn, $action);
            }
        }

        return $newPoint;
    }
}
