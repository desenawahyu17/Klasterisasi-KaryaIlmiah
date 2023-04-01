<?php
// INCLUDE SETTING KONEKSI DATABASE
include_once '../config/database.php';

// MEMBUAT OBJEK UNTUK TABEL tbl_dataset
class Dataset {
 
    private $conn;
    private $table_name = "tbl_dataset";
 
    // OBJEK
    public $id;
    public $dokumen_key;
    public $tuple;
 
    // KONSTRUKTOR
    public function __construct() {
        // MENGGUNAKAN KONEKSI DATABASE UNTUK AKSES KE DATABASE
        $database   = new Database();
        $this->conn = $database->getConnection();
    }

    // FUNGSI UNTUK MENGHITUNG JUMLAH DATA PADA TABEL tbl_dataset
    function count_data() {
        // QUERY SELECT JUMLAH DATA
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
    
        // QUERY SELECT SEMUA DATA
        $query = "SELECT * FROM ". $this->table_name ." ORDER BY id DESC";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);

        // EXECUTE STATEMENT
        if($statement->execute()){
            return $statement->fetchAll();
        }
    
        return null;
    }
    
    // FUNGSI UNTUK MENAMBAHKAN RECORD BARU SECARA SATUAN
    function create($dokumen_name, $dokumen_text) {
        $length = 18;
        $dokumen_key =  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

        // QUERY INSERT DENGAN MEMPERBARUI (MENIBAN) RECORD YANG DUPLIKAT
        $query = "REPLACE INTO ".$this->table_name."(id, dokumen_key, dokumen_name, dokumen_text) VALUES ('', '".$dokumen_key."', '".$dokumen_name."', '".$dokumen_text."')";
    
        // PREPARE STATEMENT
        $statement = $this->conn->prepare($query);
        
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