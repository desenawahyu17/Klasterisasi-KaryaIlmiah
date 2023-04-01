<?php
// INCLUDE SETTING KONEKSI DATABASE
include_once '../config/database.php';

// MEMBUAT OBJEK UNTUK TABEL tbl_model
class ModelData {
 
    private $conn;
    private $table_name = "tbl_model";
 
    // OBJEK
    public $id;
    public $model_name;
    public $clustering_count;
 
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

    // FUNGSI UNTUK MENAMBAHKAN RECORD BARU
    function create() {
    
        // QUERY INSERT
        $query = "INSERT INTO ".$this->table_name." SET model_name = :model_name, clustering_count = :clustering_count";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
    
        // MENGUNCI PARAMETER
        $statement->bindParam(':model_name', $this->model_name);
        $statement->bindParam(':clustering_count', $this->clustering_count);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return true;
        }
    
        return false;
    }

    // get select 1
    function select_one() {
    
        // QUERY SELECT BERDASARKAN ID
        $query = "SELECT * FROM ".$this->table_name." WHERE id = :id";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
    
        // MENGUNCI PARAMETER
        $statement->bindParam(':id', $this->id);
        
        // EXECUTE STATEMENT
        if($statement->execute()){
            return $statement->fetch();
        }
    
        return NULL;
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