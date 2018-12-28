<?php

require __DIR__ . "/vendor/autoload.php";

$dataFile = __DIR__ . "/data.txt";

$parser = new App\Services\FileParser($dataFile);
$directions = $parser->getDirections();

foreach ($directions as $direction) {
    $manager = new App\Manager($direction);
    $manager->getAveragePoint();

    $averagePoint = $manager->getAveragePoint();
    $worstDistance = $manager->getWorstDistance($averagePoint);

    print $averagePoint->getX() . ' ';
    print $averagePoint->getY() . ' ';
    print $worstDistance;
    print PHP_EOL;
}


