ob_start();
ob_start('ob_gzhandler');

  ... output the page content...

ob_end_flush();  // The ob_gzhandler one

header('Content-Length: '.ob_get_length());

ob_end_flush();  // The main one
