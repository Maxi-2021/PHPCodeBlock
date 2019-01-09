<?
    define('CONST1', 'value'   );
define   (CONST2, 'value2');
define(   'CONST3', time());
  define('define', 'define');
    define("test", VALUE4);
define('const5', //

'weird declaration'
)    ;
define('CONST7', 3.14);
define ( /* comment */ 'foo', 'bar');
$defn = 'blah';
define($defn, 'foo');
define( 'CONST4', define('CONST5', 6));

header('Content-Type: text/plain');

$defines = array();
$state = 0;
$key = '';
$value = '';

$file = file_get_contents('test.php');
$tokens = token_get_all($file);
$token = reset($tokens);
while ($token) {
//    dump($state, $token);
    if (is_array($token)) {
        if ($token[0] == T_WHITESPACE || $token[0] == T_COMMENT || $token[0] == T_DOC_COMMENT) {
            // do nothing
        } else if ($token[0] == T_STRING && strtolower($token[1]) == 'define') {
            $state = 1;
        } else if ($state == 2 && is_constant($token[0])) {
            $key = $token[1];
            $state = 3;
        } else if ($state == 4 && is_constant($token[0])) {
            $value = $token[1];
            $state = 5;
        }
    } else {
        $symbol = trim($token);
        if ($symbol == '(' && $state == 1) {
            $state = 2;
        } else if ($symbol == ',' && $state == 3) {
            $state = 4;
        } else if ($symbol == ')' && $state == 5) {
            $defines[strip($key)] = strip($value);
            $state = 0;
        }
    }
    $token = next($tokens);
}

foreach ($defines as $k => $v) {
    echo "'$k' => '$v'\n";
}

function is_constant($token) {
    return $token == T_CONSTANT_ENCAPSED_STRING || $token == T_STRING ||
        $token == T_LNUMBER || $token == T_DNUMBER;
}

function dump($state, $token) {
    if (is_array($token)) {
        echo "$state: " . token_name($token[0]) . " [$token[1]] on line $token[2]\n";
    } else {
        echo "$state: Symbol '$token'\n";
    }
}

function strip($value) {
    return preg_replace('!^([\'"])(.*)\1$!', '$2', $value);
}
?>
