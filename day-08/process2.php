<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$result = 0;
$grid = [];

//build grid
$i=0;
if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        $grid[$i] = str_split($line);
        $i++;
    }
}

// process each tree
for($x=0; $x <= count($grid) -1; $x++) {
    for($y=0; $y <= count($grid[$x]) -1; $y++) {

        [$xMatrix, $yMatrix] = getXYMatrix($grid, $x, $y);
        $currentTree = $grid[$x][$y];
        $currentTreeScore = 1; // each tree at least 2

        $rightTreeScore = 0;
        $leftTreeScore = 0;
        $topTreeScore = 0;
        $bottomTreeScore = 0;


        //right
        for($i=$y+1; $i<=count($xMatrix) -1; $i++) {
            $rightTreeScore++;
            if($xMatrix[$i] >= $currentTree) {
                break;
            }
        }

        //left
        for($i=$y-1; $i >= 0; $i--) {
            $leftTreeScore++;
            if($xMatrix[$i] >= $currentTree) {
                break;
            }
        }

        //top
        for($i=$x+1; $i<=count($yMatrix) -1; $i++) {
            $topTreeScore++;
            if($yMatrix[$i] >= $currentTree) {
                break;
            }
        }

        //bottom
        for($i=$x-1; $i >= 0; $i--) {
            $bottomTreeScore++;
            if($yMatrix[$i] >= $currentTree) {
                break;
            }
        }

        $currentTreeScore = $rightTreeScore != 0 ? $currentTreeScore * $rightTreeScore: $currentTreeScore;
        $currentTreeScore = $leftTreeScore != 0 ? $currentTreeScore * $leftTreeScore: $currentTreeScore;
        $currentTreeScore = $topTreeScore != 0 ? $currentTreeScore * $topTreeScore: $currentTreeScore;
        $currentTreeScore = $bottomTreeScore != 0 ? $currentTreeScore * $bottomTreeScore: $currentTreeScore;

        if($currentTreeScore > $result) {
            $result = $currentTreeScore;
        }
    }
}
echo sprintf( "Answer: %s\n", $result);

/**
 * helper functions:
 */

function getXYMatrix($grid, $x, $y): array
{
    $xMatrix = $grid[$x];
    $yMatrix = [];
    for($i=0; $i<=count($grid[$x]) -1; $i++) {
        $yMatrix[] = $grid[$i][$y];
    }

    return [$xMatrix, $yMatrix];
}
