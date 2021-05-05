<?php
/**
 * Created by PhpStorm.
 * User: WQ
 * Date: 2021/5/5
 * Time: 15:11
 */

// generator one
function xrange($start,$limit,$step = 0) {
    if ($start <= $limit) {
        if ($step <= 0) {
            throw new Exception("Step of negertive or zero is not allowed");
        }
        for ($i = $start; $i <=$limit; $i+=$step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new Exception("Step of positive or zero is not allowed");
        }
        for ($i = $start; $i > $limit; $i+=$step) {
            yield $i;
        }
    }
}

try {
    foreach (xrange(1,10,2) as $value) {
        echo $value;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


// generator two
function getFileContent($filename) {
    $fd = fopen($filename,"rd");
    if (!$fd) {
        throw new Exception("open file failed");
    }
    while ($line = fgets($fd)) {
        yield $line;
    }
    fclose($fd);
}

try {
    foreach (getFileContent("a.txt") as $value) {
        echo $value."<br>";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}