<?php

require_once 'model/Ssh.php';

class SshController {

    public $ssh;

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

        require_once 'view/ssh_login_success.php';

        // $user = $_GET['user'];
        // $ip = $_GET['ip'];

        // $_SESSION['user'] = $user;
        // $_SESSION['ip'] = $ip;

        // !$this->ssh->login($user, $ip) ? require_once 'view/ssh_login_failed.php' : require_once 'view/ssh_login_success.php';
    }

    public function autenticacao() {

        $ip = $_POST['ip'];
        $user = $_POST['user'];
        $senha = $_POST['senha'];

        $_SESSION['ip'] = $_POST['ip'];
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['senha'] = $_POST['senha'];

        $this->ssh->auth($ip, $user, $senha);

        header("Location:index.php?classe=Ssh&metodo=envia_comando");
    }

    public function envia_comando() {
        require_once 'view/ssh_command.php';

        $comando = $_POST['comando'];
        $this->ssh->sendCommand($comando);
    }

}

?>