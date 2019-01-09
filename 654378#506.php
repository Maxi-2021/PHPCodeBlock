<?php 
$cdate = mktime(0, 0, 0, 12, 31, 2009, 0);
$today = time();
$difference = $cdate - $today;
if ($difference < 0) { $difference = 0; }
echo "There are ". floor($difference/60/60/24)." days remaining";
?>
