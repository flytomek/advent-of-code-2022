<?php

declare(strict_types=1);

$fh = fopen("input.txt", "r");

$result = 0;

$i = 0;
if($fh) {
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);

        $pair = explode(',', $line);
        $pair1 = explode('-', $pair[0]);
        $pair2 = explode('-', $pair[1]);

        if(
            ($pair1[1] < $pair2[0])
            ||
            ($pair2[1] < $pair1[0])
        ) {
            var_dump([$pair1, $pair2]);
            $result++;
        }
        $i++;
    }
    fclose($fh);
}

$result = $i - $result;

echo sprintf( "Answer: %s\n", $result);
