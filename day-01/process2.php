<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$currentElfNumber = 1;
$currentElfCaloriesCount = 0;
$elves = [];

if($fh) {
    while (($line = fgets($fh)) !== false) {
        if($line === PHP_EOL) {
            $elves[$currentElfNumber] = $currentElfCaloriesCount;
            $currentElfNumber++;
            $currentElfCaloriesCount = 0;
        }
        else {
            $currentElfCaloriesCount += (int) $line;
        }
    }
    fclose($fh);
}

asort($elves);
$top3Elves = array_slice($elves, -3, 3, true);
$top3ElvesCaloriesCount = array_sum($top3Elves);

echo sprintf( "Answer: %s\n", $top3ElvesCaloriesCount);
