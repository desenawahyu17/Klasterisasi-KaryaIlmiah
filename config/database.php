<?php
class Database{
 
    private $host       = "localhost";
    private $db_name    = "db_tesis_2111600207";
    private $username   = "root";
    private $password   = "";
    public $conn;
 
    // MEMBUAT KONEKSI KE DATABASE
    public function getConnection() {
 
        $this->conn = null;
 
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }
        catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
 
		// OUTPUT
        return $this->conn;
    }
}
?>