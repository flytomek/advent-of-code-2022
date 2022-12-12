<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$rangeWithPriorities = array_flip(array_merge(range('a', 'z'), range('A', 'Z')));
$sumOfPriorities = 0;

if($fh) {
    $i=0;
    $rucksacks = [];

    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        $rucksacks[$i % 3] = str_split($line);

        if($i > 0 && $i % 3 === 2) {
            $uniqueItem = '';

            foreach($rucksacks[0] as $item) {
                if(in_array($item, $rucksacks[1]) && in_array($item, $rucksacks[2])) {
                    $uniqueItem = $item;
                    break;
                }
            }

            if($uniqueItem !== '') {
                $sumOfPriorities += ($rangeWithPriorities[$uniqueItem] + 1);
            }
            $rucksacks = [];
        }

        $i++;
    }
    fclose($fh);

}

echo sprintf( "Answer: %s\n", $sumOfPriorities);
