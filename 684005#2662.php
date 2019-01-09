foreach ($patterns as $pattern)
{
  $grouped_patterns[] = "(" . $pattern . ")";
}
$master_pattern = implode($grouped_patterns, "|");
