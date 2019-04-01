<?php

// Bibliotecas que não existem no PHP 5.6 mas existem no PHP 7
require_once '../random_compat-2.0.18/lib/random.php';
require_once '../sodium_compat-1.9.1/autoload.php';

$array = array_fill(0, 3, null);

function decode_caesar_cipher() {
    $string = str_split($_POST['text']);

    global $array;
    
    foreach ($string as $char) {

        if ($char != ' ') {
            $tmp = ord($char) - 97 - 3;
            $tmp2 = $tmp >= 0 ? $tmp : $tmp + 26;
            $array[0] .= chr($tmp2 + 97);
        } else {
            $array[0] .= ' ';
        }
    }
}

// https://stackoverflow.com/questions/16952245/encrypt-decrypt-a-string-based-on-a-salt-key/16953626
function decode_aes256_salt() {

    $password = 'opensesame';

    // Parse iv and encrypted string segments
    $components = explode(':', $_POST['text']);;

    $salt          = $components[0];
    $iv            = $components[1];
    $encrypted_msg = $components[2];

    $decrypted_msg = openssl_decrypt("$encrypted_msg", 'aes-256-cbc', "$salt:$password", null, $iv);

    global $array;

    if ($decrypted_msg === false) {
        $array[1] = 'Impossível descriptografar';
    } else {
        $array[1] = $decrypted_msg;
    }
}

function decode_sodium() {

    $text = $_POST['text'];

    $array = explode(':', $text);

    $message = base64_decode($array[0]);
    $key = base64_decode($array[1]);
    $nonce = base64_decode($array[2]);

    $plaintext = sodium_crypto_secretbox_open($message, $nonce, $key);

    global $array;

    if ($plaintext === false) {
        $array[2] = 'Impossível descriptografar';
    } else {
        $array[2] = $plaintext;
    }
}

if ($_POST['text'] == '') {
    echo json_encode($array); 
} else {
    decode_caesar_cipher();
    decode_aes256_salt();
    decode_sodium();

    echo json_encode($array);
}
?>