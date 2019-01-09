$filename = "style.css";

if (!file_exists($filename) || !($info = stat($filename))) {
  header("HTTP/1.1 404 Not Found");
  die();
}

header("Date: ".gmdate("D, j M Y H:i:s e", time()));
header("Cache-Control: max-age=2592000");
header("Last-Modified: ".gmdate("D, j M Y H:i:s e", $info['mtime']));
header("ETag: ".sprintf("\"%x-%x-%x\"", $info['ino'], $info['size'], $info['mtime']));
header("Accept-Ranges: bytes");
header("Expires: ".gmdate("D, j M Y H:i:s e", $info['mtime']+2592000));
header("Content-Type: text/css"); // note: this was text/html for some reason?

ob_start();
ob_start("ob_gzhandler");
echo file_get_contents($filename);
ob_end_flush();
header('Content-Length: '.ob_get_length());
ob_end_flush();
