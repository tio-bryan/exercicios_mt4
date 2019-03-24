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

            $this->dispositivos->save($hostname, $ip, $tipo, $fabricante);
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

            $this->dispositivos->update($hostname, $ip, $ip_original, $tipo, $fabricante);
        }

        public function remover() {
            // Mudar de GET para POST
            $ip = $_GET['ip'];
            
            $this->dispositivos->remove($ip);
        }
    }
?>