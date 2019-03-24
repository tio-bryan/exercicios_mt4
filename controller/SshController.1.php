<?php

require_once 'model/Ssh.php';

class SshController {

    public static $instance;

    private function __construct() {

        $this->ssh = Ssh::getInstance();
    }

    // Singleton
    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new SshController();
        }
 
        return self::$instance;
    }

    public function conecta() {

        $hostname = $_GET['hostname'];
        $ip = $_GET['ip'];

        $this->ssh->login($hostname, $ip);
    }

    public function autenticacao() {

        $senha = $_POST['senha'];
        $this->ssh->auth($senha);
    }

    public function envia_comando() {
        
        $this->ssh->sendCommand();
    }

}

?>