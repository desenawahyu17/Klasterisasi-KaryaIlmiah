<?php
// INCLUDE SETTING KONEKSI DATABASE
include_once '../config/database.php';

// MEMBUAT OBJEK UNTUK TABEL tbl_data_clean
class Korpus {
 
    private $conn;
    private $table_name = "tbl_data_clean";
 
    // OBJEK
    public $tuple;
 
    // KONSTRUKTOR
    public function __construct() {
        // MENGGUNAKAN KONEKSI DATABASE UNTUK AKSES KE DATABASE
        $database   = new Database();
        $this->conn = $database->getConnection();
    }
 
    // FUNGSI GET SELURUH RECORD UNTUK DITAMPILKAN
    function getAll() {
    
        // QUERY SELECT SEMUA DATA
        $query = "SELECT * FROM ". $this->table_name;
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);

        // EXECUTE STATEMENT
        if($statement->execute()){
            return $statement->fetchAll();
        }
    
        return null;
    }
}