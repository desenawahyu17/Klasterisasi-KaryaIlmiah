<?php
// INCLUDE SETTING KONEKSI DATABASE
include_once '../config/database.php';

// MEMBUAT OBJEK UNTUK TABEL tbl_stopword
class Stopword {
 
    private $conn;
    private $table_name = "tbl_stopword";
 
    // OBJEK
    public $id;
    public $stopword;
 
    // KONSTRUKTOR
    public function __construct() {
        // MENGGUNAKAN KONEKSI DATABASE UNTUK AKSES KE DATABASE
        $database   = new Database();
        $this->conn = $database->getConnection();
    }

    // FUNGSI UNTUK MENGHITUNG JUMLAH DATA PADA TABEL tbl_stopword
    function count_data() {
        // QUERY HITUNG JUMLAH DATA 
        $query = "SELECT COUNT(id) as jumlah FROM ". $this->table_name;

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
    
        // QUERY SEMUA DATA
        $query = "SELECT * FROM ". $this->table_name;
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);

        // EXECUTE STATEMENT
        if($statement->execute()){
            return $statement->fetchAll();
        }
    
        return NULL;
    }
    
    // FUNGSI UNTUK MENAMBAHKAN RECORD BARU
    function create() {
    
        // QUERY INSERT
        $query = "INSERT INTO ".$this->table_name." SET stopword = :stopword";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
    
        // MENGUNCI PARAMETER
        $statement->bindParam(':stopword', $this->stopword);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return true;
        }
    
        return false;
    }
    
    // FUNGSI UNTUK MENAMBAHKAN RECORD BARU SECARA MASAL (>1)
    function insert_multiple() {
    
        // QUERY INSERT
        $query = "INSERT INTO ".$this->table_name."(stopword) VALUES ". $this->stopword;
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return true;
        }
    
        return false;
    }
    
    // FUNGSI UNTUK MENGUBAH RECORD BARU
    function update() {
    
        // QUERY UPDATE BERDASARKAN ID
        $query = "UPDATE ".$this->table_name." SET stopword = :stopword WHERE id = :id";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
    
        // MENGUNCI PARAMETER
        $statement->bindParam(':stopword', $this->stopword);
        $statement->bindParam(':id', $this->id);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return true;
        }
    
        return false;
    }
    
    // FUNGSI UNTUK MENGHAPUS RECORD BARU
    function delete() {
    
        // QUERY DELETE BERDASARKAN ID
        $query = "DELETE FROM ".$this->table_name." WHERE id = :id";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
    
        // MENGUNCI PARAMETER
        $statement->bindParam(':id', $this->id);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return true;
        }
    
        return false;
    }
}