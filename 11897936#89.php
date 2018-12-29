<?php 
// how NOT to construct your SQL....
$query = 'SELECT * FROM user WHERE login=$1 and password=md5($2) LIMIT '. $_POST['limit']; -- injection!
$result = pg_prepare($dbconn, "", $query);
$result = pg_execute($dbconn, "", array($_POST["user"], $_POST["password"]));
if (pg_num_rows($result) < 1) {
  die ("failure");
}
?>
