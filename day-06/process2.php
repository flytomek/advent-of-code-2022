<?php

declare(strict_types=1);

$buff = file_get_contents('input.txt');
$buff = str_split($buff);

$result = 0;
for($i=0; $i < count($buff); $i++) {
    $tempBuff = array_slice($buff, $i,14);
    if(count(array_unique((array)$tempBuff)) === 14) {
        $result = $i + 14;
        break;
    }
}

echo sprintf( "Answer: %s\n", $result);
