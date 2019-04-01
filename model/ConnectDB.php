<?php

class ConnectDB {

    public $conn;

    public static $instance;

    private function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = 'root', $dbname = 'senhasegura', $charset = 'utf8') {
        
        $this->conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        
		if ($this->conn->connect_error) {
			die('Failed to connect to MySQL - ' . $this->conn->connect_error);
		}
		$this->conn->set_charset($charset);
	}

    // Singleton
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ConnectDB();
        }

        return self::$instance;
    }
}
 
?>