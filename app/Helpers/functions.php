<?php
function sort_by_score($a, $b)
{
    $a = $a['points'];
    $b = $b['points'];

    if ($a == $b) return 0;
    return ($a > $b) ? -1 : 1;
}


function autoIncrement()
{
    for($i = 0; $i < 5000; $i++) {
        yield $i;
    }
}