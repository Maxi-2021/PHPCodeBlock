$file = escapeshellarg( $filename );
$mime = shell_exec("file -bi " . $file);
$filename should probably include the absolute path.
