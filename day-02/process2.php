<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$totalScore = 0;

$rulesMap = [
    ['opponentMove' => 'A',  'myMove' => 'R',  'scoreForResult' => 3, 'scoreForShape' => 1],
    ['opponentMove' => 'A',  'myMove' => 'P',  'scoreForResult' => 6, 'scoreForShape' => 2],
    ['opponentMove' => 'A',  'myMove' => 'S',  'scoreForResult' => 0, 'scoreForShape' => 3],
    ['opponentMove' => 'B',  'myMove' => 'R',  'scoreForResult' => 0, 'scoreForShape' => 1],
    ['opponentMove' => 'B',  'myMove' => 'P',  'scoreForResult' => 3, 'scoreForShape' => 2],
    ['opponentMove' => 'B',  'myMove' => 'S',  'scoreForResult' => 6, 'scoreForShape' => 3],
    ['opponentMove' => 'C',  'myMove' => 'R',  'scoreForResult' => 6, 'scoreForShape' => 1],
    ['opponentMove' => 'C',  'myMove' => 'P',  'scoreForResult' => 0, 'scoreForShape' => 2],
    ['opponentMove' => 'C',  'myMove' => 'S',  'scoreForResult' => 3, 'scoreForShape' => 3],
];

$resultMap = [
    'X' => 0,
    'Y' => 3,
    'Z' => 6,
];

if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        if($line !== PHP_EOL) {
            $score = $resultMap[explode(' ', $line)[1]];
            $opponentShape =  explode(' ', $line)[0];

            $game = array_values(array_filter($rulesMap, function($v) use ($score, $opponentShape) {
                return ($v['scoreForResult'] === $score && $v['opponentMove'] === $opponentShape);
            }));

            $totalScore += $score + $game[0]['scoreForShape'];
        }
    }
    fclose($fh);
}

echo sprintf( "Answer: %s\n", $totalScore);
