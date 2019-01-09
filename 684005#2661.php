$matches = false;
foreach ($pattern_array as $pattern)
{
  if (preg_match($pattern, $page))
  {
    $matches = true;
  } 
}
