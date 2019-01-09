  $whitelist = array('home', 'page');

  if (in_array($_GET['page'], $whitelist)) {
        include($_GET['page'].'.php');
  } else {
        include('home.php');
  }
