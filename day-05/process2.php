<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

//$cratesSample = [
//    1 => ['Z', 'N'],
//    2 => ['M', 'C', 'D'],
//    3 => ['P']
//];

$cratesSample = [
    1 => ['Z', 'T', 'F', 'R', 'W', 'J', 'G'],
    2 => ['G', 'W', 'M'],
    3 => ['J', 'N', 'H', 'G'],
    4 => ['J', 'R', 'C', 'N', 'W'],
    5 => ['W', 'F', 'S', 'B', 'G', 'Q', 'V', 'M'],
    6 => ['S', 'R', 'T', 'D', 'V', 'W', 'C'],
    7 => ['H', 'B', 'N', 'C', 'D', 'Z', 'G', 'V'],
    8 => ['S', 'J', 'N', 'M', 'G', 'C'],
    9 => ['G', 'P', 'N', 'W', 'C', 'J', 'D', 'L']
];

$result = '';

if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        preg_match('/move (\d+) from (\d+) to (\d+)/', $line, $procedure);

        $moves = $procedure[1];
        $source = $procedure[2];
        $destination = $procedure[3];

        $crateStack = array_slice($cratesSample[$source], 0 - $moves);
        $cratesSample[$source] = array_slice($cratesSample[$source], 0, count($cratesSample[$source]) - $moves);
        $cratesSample[$destination] = array_merge($cratesSample[$destination], $crateStack);
    }
    fclose($fh);
}

for($i=1; $i<=count($cratesSample); $i++) {
    $result .= array_pop($cratesSample[$i]);
}

echo sprintf( "Answer: %s\n", $result);
