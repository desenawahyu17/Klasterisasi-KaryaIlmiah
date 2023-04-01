<?php
    session_start();
    
    include_once '../models/stopword.php';

    if(isset($_POST['stopword'])) {

        // INISIALISASI $stopword DENGAN INSTANCE UNTUK CLASS 'Stopword' YANG BERADA PADA FILE stopword.php
        $stopword   = new Stopword();
        // SET VARIAVEL stopword YANG BERADA PADA CLASS 'Stopword' DENGAN MASUKAN (INPUT) $_POST['stopword']
        $stopword->stopword = trim($_POST['stopword']);

        // MEMANGGIL FUNGSI create() PADA CLASS 'Stopword'
        if($stopword->create()) {
            // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
            $_SESSION['success_message'] =  "Data Berhasil Disimpan!";
        }
        else {
            // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
            $_SESSION['error_message'] = "Data Gagal Disimpan!";
        }

        header('location: ../views/index.php?hal=stopword');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>