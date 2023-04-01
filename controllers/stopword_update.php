<?php
    session_start();

    include_once '../models/stopword.php';

    if(isset($_POST['id']) && isset($_POST['stopword'])) {

        // INISIALISASI $stopword DENGAN INSTANCE UNTUK CLASS 'Stopword' YANG BERADA PADA FILE stopword.php
        $stopword   = new Stopword();
        // SET VARIAVEL id da stopword YANG BERADA PADA CLASS 'Stopword' DENGAN MASUKAN (INPUT) $_POST['id'] dan $_POST['stopword']
        $stopword->id = trim($_POST['id']);
        $stopword->stopword = trim($_POST['stopword']);
        
        // MEMANGGIL FUNGSI update() PADA CLASS 'Stopword'
        if($stopword->update()) {
            // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
            $_SESSION['success_message'] =  "Data Berhasil Diubah!";
        }
        else {
            // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
            $_SESSION['error_message'] = "Data Gagal Diubah!";
        }

        header('location: ../views/index.php?hal=stopword');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>