$ more multi.php
<?php

$a = array(1 => 'a',2 => 'b',3 => array(1,2,3));
$b = array(1 => 'a',2 => 'b');
$c = array(1 => 'a',2 => 'b','foo' => array(1,array(2)));

function is_multi($a) {
    $rv = array_filter($a,'is_array');
    if(count($rv)>0) return true;
    return false;
}

function is_multi2($a) {
    foreach ($a as $v) {
        if (is_array($v)) return true;
    }
    return false;
}

function is_multi3($a) {
    $c = count($a);
    for ($i=0;$i<$c;$i++) {
        if (is_array($a[$i])) return true;
    }
    return false;
}
$iters = 500000;
$time = microtime(true);
for ($i = 0; $i < $iters; $i++) {
    is_multi($a);
    is_multi($b);
    is_multi($c);
}
$end = microtime(true);
echo "is_multi  took ".($end-$time)." seconds in $iters times\n";

$time = microtime(true);
for ($i = 0; $i < $iters; $i++) {
    is_multi2($a);
    is_multi2($b);
    is_multi2($c);
}
$end = microtime(true);
echo "is_multi2 took ".($end-$time)." seconds in $iters times\n";
$time = microtime(true);
for ($i = 0; $i < $iters; $i++) {
    is_multi3($a);
    is_multi3($b);
    is_multi3($c);
}
$end = microtime(true);
echo "is_multi3 took ".($end-$time)." seconds in $iters times\n";
?>

$ php multi.php
is_multi  took 7.53565130424 seconds in 500000 times
is_multi2 took 4.56964588165 seconds in 500000 times
is_multi3 took 9.01706600189 seconds in 500000 times
