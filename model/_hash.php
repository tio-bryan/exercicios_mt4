<?php

$array = array_fill(0, 3, null);

function sha512() {

    global $array;
    $array[0] = crypt($_POST['text'], '$6$');
}

function hmac() {
    // $key = base64_encode(openssl_random_pseudo_bytes(64));
    $key = 'secretkey';

    global $array;
    $array[1] = hash_hmac('sha512', $_POST['text'], $key);
}

function phash() {
    global $array;
    $array[2] = password_hash($_POST['text'], PASSWORD_DEFAULT);
}

sha512();
hmac();
phash();

echo json_encode($array);

?>