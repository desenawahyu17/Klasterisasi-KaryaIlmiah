<?php
    session_start();

    include_once '../models/dataset.php';

    if(isset($_POST['id'])) {

        // INISIALISASI $dataset DENGAN INSTANCE UNTUK CLASS 'Dataset' YANG BERADA PADA FILE dataset.php
        $dataset   = new Dataset();
        // SET VARIABEL id YANG BERADA PADA CLASS 'Dataset' DENGAN MASUKAN (INPUT) $_POST['id']
        $dataset->id = trim($_POST['id']);

        // MEMANGGIL FUNGSI delete() PADA CLASS 'Dataset'
        if($dataset->delete()) {
            // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
            $_SESSION['success_message'] =  "Data Berhasil Dihapus!";
        }
        else {
            // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
            $_SESSION['error_message'] = "Data Gagal Dihapus!";
        }

        header('location: ../views/index.php?hal=dataset');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>