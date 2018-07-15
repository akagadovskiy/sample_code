<?php

function swapLongestToFirstPosition(string $a, string $b) {
    if (strlen($b) > strlen($a)) {
        $tmp = $a;
        $a = $b;
        $b = $tmp;
    }

    return [$a, $b];
}

function addTwoNumbers(string $a, string $b) {
    $result = '';
    $a = strrev($a);
    $b = strrev($b);

    list($a, $b) = swapLongestToFirstPosition($a, $b);

    $isOverflow = 0;
    for ($i = 0; $i < strlen($a); $i++) {
        $top = $a[$i];
        $bottom = isset($b[$i]) ? $b[$i] : 0;

        $value = $top + $bottom;
        if ($isOverflow) {
            $value++;
            $isOverflow = false;
        }
        if ($value > 9) {
            $value = substr($value, 1, 1);
            $isOverflow = true;
        }
        $result .= $value;
    }

    if ($isOverflow) {
        $result .= 1;
    }

    // it's possible to avoid string reverse but it's more handy
    return strrev($result);
}


$a = "9945769345798943589435893458934583458345834999";
$b = "2531999125127561287368971268461287512756781265871268573124124";

$sum = addTwoNumbers($a, $b);

var_dump($sum == ($a + $b));