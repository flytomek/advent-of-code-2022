<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$currentElfNumber = 1;
$currentElfCaloriesCount = 0;
$winningElfNumber = 1;
$winningElfCaloriesCount = 0;

if($fh) {
    while (($line = fgets($fh)) !== false) {
        if($line === PHP_EOL) {
            if($currentElfCaloriesCount > $winningElfCaloriesCount) {
                $winningElfNumber = $currentElfNumber;
                $winningElfCaloriesCount = $currentElfCaloriesCount;
            }
            $currentElfNumber++;
            $currentElfCaloriesCount = 0;
        }
        else {
            $currentElfCaloriesCount += (int) $line;
        }
    }
    fclose($fh);
}

echo sprintf( "Answer: %s\n", $winningElfCaloriesCount);
