$key = 'the quick brown fox jumps over the lazy ';
$string = 'Hey we are testing encryption';

echo enc_encrypt($string, $key)."\n";
echo enc_decrypt(enc_encrypt($string, $key), $key)."\n";

function enc_encrypt($string, $key) {
    $result = '';
    for($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
}

function enc_decrypt($string, $key) {
    $result = '';
    $string = base64_decode($string);

    for($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }

    return $result;
}
