<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$result = 0;
$fs = []; // filesystem tree
$ptr = []; // pointer

if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        if($line[0] === '$') {
            // go up
            if($line === '$ cd ..') {
                array_pop($ptr);
            }

            // go down
            preg_match('/^\$ cd ([a-zA-Z0-9]+)/', $line, $cdDir);
            if(!empty($cdDir)) {
                $ptr[] = $cdDir[1];
            }
        }
        // file/dir creation
        else {
            writeFsArray($fs, $ptr, $line);
        }
    }
}

processFsArray($fs, $result);

echo sprintf( "Answer: %s\n", $result);

/**
 * helper functions:
 */

// writing to fs array
function writeFsArray(&$fs, $ptr, $data): void
{

    if(empty($ptr)) {
        $explodedLine = explode(' ', $data );

        if(!isset($fs[$explodedLine[1]])) {
            if($explodedLine[0] === 'dir') {
                $fs[$explodedLine[1]] = [];
            }
            else  {
                $fs[$explodedLine[1]] = $explodedLine[0];
            }
        }
    }
    else {
        // reverse array to get current pointer (not last)
        $ptr = array_reverse($ptr);
        $dir = array_pop($ptr);
        $ptr = array_reverse($ptr);
        writeFsArray($fs[$dir], $ptr, $data);
    }
}

// processing fs array
function processFsArray($fs, &$result)
{
    $size = 0;
    foreach($fs as $item) {
        if(is_array($item)) {
            $size += processFsArray($item, $result);
        }
        else {
            $size += $item;
        }
    }
    if($size < 100000) {
        $result += $size;
    }
    return $size;
}

//$fs = [
//    'a' => [
//        'e' => [
//            'i' => 584
//        ],
//        'f' => 29116,
//        'g' => 2557,
//        'h.lst' => 62596
//    ],
//    'b.txt' => 14848514,
//    'c.dat' => 8504156,
//    'd' => [
//        'j' => 4060174,
//        'd.log' => 8033020,
//        'd.ext' => 5626152,
//        'k' => 7214296
//    ]
//];
