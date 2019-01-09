$nRows = $pdo->query('select count(*) from blah')->fetchColumn(); 
echo $nRows;
