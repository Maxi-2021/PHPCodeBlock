$sql = "SELECT count(*) FROM `table` WHERE foo = bar"; 
$result = $con->prepare($sql); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
