<?php

session_start();

require_once 'view/header.php';

$classe = $_GET['classe'];
$metodo = $_GET['metodo'];

$classe .= 'Controller';

require_once 'controller/'.$classe.'.php';

// getInstance do Singleton
$obj = $classe::getInstance();
$obj->$metodo();

?>