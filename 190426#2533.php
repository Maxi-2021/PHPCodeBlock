$trace = debug_backtrace();
$caller = $trace[1];

echo "Called by {$caller['function']}";
if (isset($caller['class']))
    echo " in {$caller['class']}";
