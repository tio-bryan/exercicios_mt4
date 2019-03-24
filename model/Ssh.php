<?php

class Ssh {

    public $conn;
    public $hostname;

    public static $instance;

    private function __construct() {
        
    }

    // Singleton
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Ssh();
        }
 
        return self::$instance;
    }

    public function login($hostname, $ip) {
        $this->hostname = $hostname;
    
        $this->conn = ssh2_connect($ip, 22);
        !$this->conn ? require_once 'view/ssh_login_failed.php' : require_once 'view/ssh_login_success.php';
    }

    public function auth($senha) {
        ssh2_auth_password($this->conn, $this->hostname, $senha);
        require_once 'view/ssh_command.php';
    }

    public function sendCommand() {

        $stream = ssh2_exec($this->conn, 'ls -l');
        stream_set_blocking($stream, true);
        $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
        echo "<pre>" . stream_get_contents($stream_out) . "</pre>";
    }
}
 
?>