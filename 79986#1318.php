if (strlen($string) > $your_desired_width) 
{
    $string = wordwrap($string, $your_desired_width);
    $string = substr($string, 0, strpos($string, "\n"));
}
