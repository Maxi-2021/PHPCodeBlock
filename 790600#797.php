<?php
$text = 'This is an example text, it contains commas and full stops. Exclamation marks, too! Question marks? All punctuation marks you know.';
$delim = ' \n\t,.!?:;';

$tok = strtok($text, $delim);

while ($tok !== false) {
    echo "Word=$tok<br />";
    $tok = strtok($delim);
}
?>
