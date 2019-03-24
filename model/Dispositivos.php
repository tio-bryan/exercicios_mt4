<?php

class Dispositivos {

    public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = 'root', $dbname = 'senhasegura', $charset = 'utf8') {
        
        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        
		if ($this->connection->connect_error) {
			die('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
		$this->connection->set_charset($charset);
	}

    public function listAll() {

        $sql = 'SELECT * FROM senhasegura.dispositivos ORDER BY hostname;';
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
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
        } else {
            echo "0 results";
        }
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

        if ($this->connection->query($sql) === TRUE) {
            header("Location:index.php?classe=Dispositivos&metodo=listar");
        } else {
            echo "Error: " . $sql . "<br>" . $this->connection->error;
        }
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

        if ($this->connection->query($sql) === TRUE) {
            header("Location:index.php?classe=Dispositivos&metodo=listar");
        } else {
            echo "Error updating record: " . $this->connection->error;
        }
    }
    
    public function remove($ip) {
        
        $sql = "DELETE FROM `senhasegura`.`dispositivos` WHERE ip='$ip'";

        if ($this->connection->query($sql) === TRUE) {
            header("Location:index.php?classe=Dispositivos&metodo=listar");
        } else {
            echo "Error deleting record: " . $this->connection->error;
        }
    }
}
 
?>