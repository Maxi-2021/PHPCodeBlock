foreach ($strings_to_match as $string_to_match)
{
  if (strpos($page, $string_to_match) !== false))
  {
    // etc.
    break;
  }
}
foreach ($pattern_array as $pattern)
{
  if (preg_match($pattern, $page))
  {
    // etc.
    break;
  } 
}
