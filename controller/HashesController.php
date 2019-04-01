<?php

class HashesController {

    public static $instance;

    private function __construct() {
        
    }

    // Singleton
    public static function getInstance() {
        
        if (!isset(self::$instance)) {
            self::$instance = new HashesController();
        }

        return self::$instance;
    }

    public function listar() {
        
        require_once 'view/hashes_view.php';
    }
}

?>