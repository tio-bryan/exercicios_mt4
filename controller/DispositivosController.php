<?php

require_once 'model/Dispositivos.php';

class DispositivosController {

    public static $instance;

    private function __construct() {
        $this->dispositivos = new Dispositivos();
    }

    // Singleton
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DispositivosController();
        }

        return self::$instance;
    }

    public function listar() {
        $lista = $this->dispositivos->listAll();
        
        $_REQUEST['dispositivos'] = $lista;
        
        require_once 'view/dispositivos_view.php';
    }

    public function salvar() {
        // Mudar de GET para POST
        $hostname = $_GET['hostname'];
        $ip = $_GET['ip'];
        $tipo = $_GET['tipo'];
        $fabricante = $_GET['fabricante'];

        if ($this->dispositivos->save($hostname, $ip, $tipo, $fabricante) === TRUE) {
            header("Location:index.php?classe=Dispositivos&metodo=listar");
        } else {
            echo "Erro ao salvar esse dispositivo: " . $this->dispositivos->conn->error;
        }
    }

    public function preAtualizar() {
        $lista = $this->dispositivos->listAll();

        $_REQUEST['dispositivos'] = $lista;

        require_once 'view/dispositivos_view_update.php';
    }

    public function atualizar() {
        // Mudar de GET para POST
        $hostname = $_GET['hostname'];
        $ip = $_GET['ip'];
        $tipo = $_GET['tipo'];
        $fabricante = $_GET['fabricante'];
        $ip_original = $_GET['ip_original'];

        if ($this->dispositivos->update($hostname, $ip, $ip_original, $tipo, $fabricante) === TRUE) {
            header("Location:index.php?classe=Dispositivos&metodo=listar");
        } else {
            echo "Erro ao atualizar esse dispositivo: " . $this->dispositivos->conn->error;
        }
    }

    public function remover() {
        // Mudar de GET para POST
        $ip = $_GET['ip'];
        
        if ($this->dispositivos->remove($ip) === TRUE) {
            header("Location:index.php?classe=Dispositivos&metodo=listar");
        } else {
            echo "Erro ao remover esse dispositivo: " . $this->dispositivos->conn->error;
        }
    }
}

?>