<?php

namespace App\Services;

class FileParser
{
    protected $directions = [];

    public function __construct(string $filePath)
    {
        $content = file($filePath);
        $case = 0;

        foreach ($content as $line) {
            $line = trim($line);

            if (filter_var($line, FILTER_VALIDATE_INT) !== false) {
                $case++;
            } else {
                $this->directions[$case][] = $line;
            }
        }
    }

    public function getDirections(): array
    {
        return $this->directions;
    }
}
