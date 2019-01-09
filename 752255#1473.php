<?
define('WANT_PROCESSORS', 5);
define('PROCESSOR_EXECUTABLE', '/path/to/your/processor');
set_time_limit(0);
$cycles = 0;
$run = true;
$reload = false;
declare(ticks = 30);

function signal_handler($signal) {
    switch($signal) {
    case SIGTERM :
        global $run;
        $run = false;
        break;
    case SIGHUP  :
        global $reload;
        $reload = true;
        break;
    }   
}

pcntl_signal(SIGTERM, 'signal_handler');
pcntl_signal(SIGHUP, 'signal_handler');

function spawn_processor() {
    $pid = pcntl_fork();
    if($pid) {
        global $processors;
        $processors[] = $pid;
    } else {
        if(posix_setsid() == -1)
            die("Forked process could not detach from terminal\n");
        fclose(stdin);
        fclose(stdout);
        fclose(stderr);
        pcntl_exec(PROCESSOR_EXECUTABLE);
        die('Failed to fork ' . PROCESSOR_EXECUTABLE . "\n");
    }
}

function spawn_processors() {
    global $processors;
    if($processors)
        kill_processors();
    $processors = array();
    for($ix = 0; $ix < WANT_PROCESSORS; $ix++)
        spawn_processor();
}

function kill_processors() {
    global $processors;
    foreach($processors as $processor)
        posix_kill($processor, SIGTERM);
    foreach($processors as $processor)
        pcntl_waitpid($processor);
    unset($processors);
}

function check_processors() {
    global $processors;
    $valid = array();
    foreach($processors as $processor) {
        pcntl_waitpid($processor, $status, WNOHANG);
        if(posix_getsid($processor))
            $valid[] = $processor;
    }
    $processors = $valid;
    if(count($processors) > WANT_PROCESSORS) {
        for($ix = count($processors) - 1; $ix >= WANT_PROCESSORS; $ix--)
            posix_kill($processors[$ix], SIGTERM);
        for($ix = count($processors) - 1; $ix >= WANT_PROCESSORS; $ix--)
            pcntl_waitpid($processors[$ix]);
    } elseif(count($processors) < WANT_PROCESSORS) {
        for($ix = count($processors); $ix < WANT_PROCESSORS; $ix++)
            spawn_processor();
    }
}

spawn_processors();

while($run) {
    $cycles++;
    if($reload) {
        $reload = false;
        kill_processors();
        spawn_processors();
    } else {
        check_processors();
    }
    usleep(150000);
}
kill_processors();
pcntl_wait();
?>
