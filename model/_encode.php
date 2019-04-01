<?php

// Bibliotecas que não existem no PHP 5.6 mas existem no PHP 7
require_once '../random_compat-2.0.18/lib/random.php';
require_once '../sodium_compat-1.9.1/autoload.php';

$array = array_fill(0, 3, null);

function encode_caesar_cipher() {
    $string = str_split($_POST['text']);

    foreach ($string as $char) {

        global $array;
        $array[0] .= $char != ' ' ? chr((ord($char) - 97 + 3) % 26 + 97) : ' ';
    }
}

// https://stackoverflow.com/questions/16952245/encrypt-decrypt-a-string-based-on-a-salt-key/16953626
function encode_aes256_salt() {

    $message = $_POST['text'];

    $max_msg_size = 10000;
    $message = substr($message, 0, $max_msg_size);

    $password = 'opensesame';

    $salt = sha1(mt_rand());

    $iv = substr(sha1(mt_rand()), 0, 16);

    $encrypted = openssl_encrypt("$message", 'aes-256-cbc', "$salt:$password", null, $iv);

    global $array;
    $array[1] = "$salt:$iv:$encrypted";
}

// https://blog.zend.com/2018/11/06/modern-cryptography-in-php-7-2-with-sodium/#.XKFq7NtKi01
// https://paragonie.com/book/pecl-libsodium/read/04-secretkey-crypto.md
function encode_sodium() {
    $msg = $_POST['text'];
 
    // Generating an encryption key and a nonce
    $key   = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256 bit
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // 24 bytes
    
    // Encrypt
    $ciphertext = sodium_crypto_secretbox($msg, $nonce, $key);

    // Tive que usar o base64_encode pois a string retornada pela sodium_crypto_secretbox possui um monte de caracteres estranhos
    global $array;
    $array[2] = base64_encode($ciphertext) . ':' . base64_encode($key) . ':' . base64_encode($nonce);
}

if ($_POST['text'] == '') {
    echo json_encode($array); 
} else {
    encode_caesar_cipher();
    encode_aes256_salt();
    encode_sodium();

    echo json_encode($array);
}

?>