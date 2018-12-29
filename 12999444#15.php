<?php 
session_start();
define('SECURE_KEY',$_SERVER['SERVER_NAME']);

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_SESSION['security_key']) && isset($_SESSION['security'])){
        //Decrypt
        list($servername,$userip) = explode('X',decrypt(base64_decode($_SESSION['security'])));

        //Check the decrypted values
        if($servername == $_SERVER['SERVER_NAME'] && $userip == $_SERVER['REMOTE_ADDR']){
            /* forms post is from domain as session would
            not have been started and security would not have been set */
            echo 'good';
        }else{
            echo 'bad';
        }

    }else{
        /* forms post is not from domain */
        echo 'bad';
    }

    $_SESSION['security_key'] = sha1(microtime(true));
    $_SESSION['security'] = base64_encode(encrypt($_SERVER['SERVER_NAME'].'X'.$_SERVER['REMOTE_ADDR']));
}else{
    $_SESSION['security_key'] = sha1(microtime(true));
    $_SESSION['security'] = base64_encode(encrypt($_SERVER['SERVER_NAME'].'X'.$_SERVER['REMOTE_ADDR']));
}

function encrypt($string, $key = 'PrivateKey', $secret = 'SecretKey', $method = 'AES-256-CBC') {
    // hash
    $key = hash('sha256', $key);
    // create iv - encrypt method AES-256-CBC expects 16 bytes
    $iv = substr(hash('sha256', $secret), 0, 16);
    // encrypt
    $output = openssl_encrypt($string, $method, $key, 0, $iv);
    // encode
    return base64_encode($output);
}

function decrypt($string, $key = 'PrivateKey', $secret = 'SecretKey', $method = 'AES-256-CBC') {
    // hash
    $key = hash('sha256', $key);
    // create iv - encrypt method AES-256-CBC expects 16 bytes
    $iv = substr(hash('sha256', $secret), 0, 16);
    // decode
    $string = base64_decode($string);
    // decrypt
    return openssl_decrypt($string, $method, $key, 0, $iv);
}
?>

<form method="POST" action="">
  <input type="hidden" name="<?=$_SESSION['security_key'];?>" value="<?=$_SESSION['security'];?>"/>
  <p><input type="text" name="Text" size="20"><input type="submit" value="Submit"></p>
</form>
