<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$rangeWithPriorities = array_flip(array_merge(range('a', 'z'), range('A', 'Z')));
$sumOfPriorities = 0;

if($fh) {
    $i=0;
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        $middle = strlen($line) / 2;
        $firstCompartment = str_split(substr($line, 0, $middle));
        $secondCompartment = str_split(substr($line, $middle));

        $uniqueItem = '';
        foreach($firstCompartment as $item) {
            if (in_array($item, $secondCompartment)) {
                $uniqueItem = $item;
                break;
            }
        }
        $sumOfPriorities += ($rangeWithPriorities[$uniqueItem] + 1);
        $i++;
    }
    fclose($fh);
}

echo sprintf( "Answer: %s\n", $sumOfPriorities);
