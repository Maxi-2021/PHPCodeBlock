$ more multi.php
<?php

$a = array(1 => 'a',2 => 'b',3 => array(1,2,3));
$b = array(1 => 'a',2 => 'b');

function is_multi($a) {
    $rv = array_filter($a,'is_array');
    if(count($rv)>0) return true;
    return false;
}

var_dump(is_multi($a));
var_dump(is_multi($b));
?>

$ php multi.php
bool(true)
bool(false)
