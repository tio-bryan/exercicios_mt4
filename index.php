<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$classe = $_GET['classe'];
$metodo = $_GET['metodo'];

$classe .= 'Controller';

require_once 'controller/'.$classe.'.php';

// getInstance do Singleton
$obj = $classe::getInstance();
$obj->$metodo();

?>