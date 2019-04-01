<?php

class Ssh {

    public $conn;
    public $user;
    public $ip;

    public static $instance;

    private function __construct() {}

    // Singleton
    public static function getInstance() {
        
        if (!isset(self::$instance)) {
            self::$instance = new Ssh();
        }
        
        return self::$instance;
    }

    // public function login($user, $ip) {

    //     $this->user = $user;
    //     $this->ip = $ip;
    
    //     return $this->conn = ssh2_connect($ip, 22);
    // }

    public function auth($ip, $user, $senha) {
        
        $this->conn = ssh2_connect($ip, 22);
        ssh2_auth_password($this->conn, $user, $senha);

        return $this->conn;
    }

    public function sendCommand($command) {

        $stream = ssh2_exec($this->auth($_SESSION['ip'], $_SESSION['user'], $_SESSION['senha']), $command);
        stream_set_blocking($stream, true);
        $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
        echo "<pre>" . stream_get_contents($stream_out) . "</pre>";
    }
}
 
?>