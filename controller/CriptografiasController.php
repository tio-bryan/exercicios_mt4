<?php

class CriptografiasController {

    public static $instance;

    private function __construct() {
        
    }

    // Singleton
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new CriptografiasController();
        }

        return self::$instance;
    }

    public function listar() {
        
        require_once 'view/criptografias_view.php';
    }
}

?>