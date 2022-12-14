<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$result = 0;
$fs = []; // filesystem tree
$ptr = []; // pointer
$totalFsSize = 0;
$directoriesSizeMap = []; // directories and its sizes

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
getSizeOfFsArray($fs,$totalFsSize);

$freeFsSize = 70000000 - $totalFsSize;
$requiredFsSize = 30000000 - $freeFsSize;

mapFsDirectories($fs, $directoriesSizeMap, $requiredFsSize);
sort($directoriesSizeMap);
$result = $directoriesSizeMap[0];

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

// get size of fs array
function getSizeOfFsArray($fs, &$totalFsSize): void
{
    foreach($fs as $item) {
        if(is_array($item)) {
            getSizeOfFsArray($item, $totalFsSize);
        }
        else {
            $totalFsSize += $item;
        }
    }
}

// map fs directories
function mapFsDirectories($fs, &$directoriesSizeMap, &$requiredFsSize)
{
    $size = 0;
    foreach($fs as $item) {
        if(is_array($item)) {
            $size += mapFsDirectories($item, $directoriesSizeMap, $requiredFsSize);
        }
        else {
            $size += $item;
        }
    }
    if($size > $requiredFsSize) {
        $directoriesSizeMap[] = $size;
    }
    return $size;
}
