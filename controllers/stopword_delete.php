<?php
    session_start();

    include_once '../models/stopword.php';

    if(isset($_POST['id'])) {

        // INISIALISASI $stopword DENGAN INSTANCE UNTUK CLASS 'Stopword' YANG BERADA PADA FILE stopword.php
        $stopword   = new Stopword();
        // SET VARIAVEL id YANG BERADA PADA CLASS 'Stopword' DENGAN MASUKAN (INPUT) $_POST['id']
        $stopword->id = trim($_POST['id']);

        // MEMANGGIL FUNGSI delete() PADA CLASS 'Stopword'
        if($stopword->delete()) {
            // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
            $_SESSION['success_message'] =  "Data Berhasil Dihapus!";
        }
        else {
            // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
            $_SESSION['error_message'] = "Data Gagal Dihapus!";
        }

        header('location: ../views/index.php?hal=stopword');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>