<?php
    session_start();

    include_once '../models/model_data.php';

    if(isset($_POST['id'])) {

        // INISIALISASI $model_data DENGAN INSTANCE UNTUK CLASS 'ModelData' YANG BERADA PADA FILE model_data.php
        $model_data   = new ModelData();
        // SET VARIAVEL id YANG BERADA PADA CLASS 'ModelData' DENGAN MASUKAN (INPUT) $_POST['id']
        $model_data->id = trim($_POST['id']);

        // MEMANGGIL FUNGSI delete() PADA CLASS 'ModelData'
        if($model_data->delete()) {
            // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
            $_SESSION['success_message'] =  "Data Berhasil Dihapus!";
        }
        else {
            // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
            $_SESSION['error_message'] = "Data Gagal Dihapus!";
        }

        header('location: ../views/index.php?hal=korpus');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>