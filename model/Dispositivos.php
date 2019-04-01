<?php

require_once 'model/ConnectDB.php';

class Dispositivos {

    public $conn;

    public function __construct() {
        
        $this->conn = ConnectDB::getInstance()->conn;
	}

    public function listAll() {

        $sql = 'SELECT * FROM senhasegura.dispositivos ORDER BY hostname;';
        $result = $this->conn->query($sql);

        $array_total = [];
        
        while($row = $result->fetch_assoc()) {
            $array = [
                        'hostname' => $row['hostname'],
                        'ip' => $row['ip'],
                        'tipo' => $row['tipo'],
                        'fabricante' => $row['fabricante']
                    ];

            array_push($array_total, $array);
        }

        return $array_total;
    }
    
    public function save($hostname, $ip, $tipo, $fabricante) {

        $sql = "INSERT INTO `senhasegura`.`dispositivos`
                (`hostname`,
                `ip`,
                `tipo`,
                `fabricante`)
                VALUES
                ('$hostname',
                '$ip',
                '$tipo',
                '$fabricante');";

        return $this->conn->query($sql);
    }
    
    public function update($hostname, $ip, $ip_original, $tipo, $fabricante) {

        $sql = "UPDATE `senhasegura`.`dispositivos`
                SET
                `hostname` = '$hostname',
                `ip` = '$ip',
                `tipo` = '$tipo',
                `fabricante` = '$fabricante'
                WHERE `ip` = '$ip_original';
                ";

        return $this->conn->query($sql);
    }
    
    public function remove($ip) {
        
        $sql = "DELETE FROM `senhasegura`.`dispositivos` WHERE ip='$ip'";

        return $this->conn->query($sql);
    }
}
 
?>