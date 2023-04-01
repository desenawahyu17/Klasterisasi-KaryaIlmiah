<?php
// INCLUDE SETTING KONEKSI DATABASE
include_once '../config/database.php';

// MEMBUAT OBJEK UNTUK TABEL tbl_data_clean
class Preprocessing {
 
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

    // FUNGSI UNTUK MENGHITUNG JUMLAH DATA PADA TABEL tbl_data_clean
    function count_data() {
        // QUERY SELECT JUMLAH DATA
        $query = "SELECT COUNT(id_req) as jumlah FROM ". $this->table_name;

        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);

        // EXECUTE STATEMENT
        if($statement->execute()){
            return $statement->fetch()['jumlah'];
        }
    
        return 0;
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
    
    // FUNGSI UNTUK MENAMBAHKAN RECORD BARU SECARA MASAL (>1)
    function insert_multiple() {
    
        // QUERY INSERT DENGAN MENIBAN RECORD YANG DUPLIKAT
        $query = "REPLACE INTO ".$this->table_name."(id_req, dokumen_key, dokumen_name, dokumen_text, clean_text) VALUES ". $this->tuple;
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return true;
        }
    
        return false;
    }
}