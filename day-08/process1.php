<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$result = 0;
$visibleTreesCoords = []; // excl. trees on border
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

// scan left to right
for($x=1; $x <= count($grid) -2; $x++) {
    $tempHighest = $grid[$x][0]; // height from the border (left)
    for($y=1; $y <= count($grid[$x]) - 2; $y++) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}
// scan right to left
for($x=1; $x <= count($grid) - 2; $x++) {
    $tempHighest = $grid[$x][ count($grid[$x]) -1 ]; // height from the border (right)
    for($y = count($grid[$x]) - 2; $y >= 1; $y--) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}
// scan top to bottom
for($y=1; $y <= count($grid[0]) -2; $y++) {
    $tempHighest = $grid[0][$y]; // height from the border (top)
    for($x=1; $x <= count($grid) -2; $x++) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}
// scan bottom to top
for($y=1; $y <= count($grid[0]) -2; $y++) {
    $tempHighest = $grid[count($grid)-1][$y]; // height from the border (bottom)
    for($x = count($grid[0]) -2; $x >= 1; $x--) {
        $currentTree = $grid[$x][$y];
        if($currentTree > $tempHighest) {
            $tempHighest = $currentTree;
            $visibleTreesCoords[] = "[$x, $y] ($currentTree)";
        }
    }
}
$result = (2 * count($grid)) + (2 * count($grid[0])) - 4; // add trees from the borders
$result += count(array_unique($visibleTreesCoords)); // remove duplicates

echo sprintf( "Answer: %s\n", $result);
