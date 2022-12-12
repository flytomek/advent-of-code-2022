<?php

declare(strict_types=1);

$buff = file_get_contents('input.txt');
$buff = str_split($buff);

$result = 0;
for($i=0; $i < count($buff); $i++) {
    if(
        count(array_unique([
            $buff[$i], $buff[$i+1], $buff[$i+2], $buff[$i+3],
        ])) === 4
    ) {
        $result = $i+3;
        break;
    }
}

$result++;

echo sprintf( "Answer: %s\n", $result);
