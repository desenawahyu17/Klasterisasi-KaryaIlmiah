<?php
session_start();

include_once '../models/dataset.php';

if (isset($_POST['datasetTambahModal'])) {

    // INISIALISASI $dataset DENGAN INSTANCE UNTUK CLASS 'Dataset' YANG BERADA PADA FILE dataset.php
    $dataset = new Dataset();

    // SET VARIABEL $dokumen_name DAN $dokumen_text DENGAN MASUKAN (INPUT) $_POST['dokumen_name'] DAN $_POST['dokumen_text']
    $dokumen_name = trim($_POST['dokumen_name']);
    $dokumen_text = trim($_POST['dokumen_text']);

    // MEMANGGIL FUNGSI create() PADA CLASS 'Dataset'
    if ($dataset->create($dokumen_name, $dokumen_text)) {
        // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
        $_SESSION['success_message'] = "Data Berhasil Disimpan!";
    } else {
        // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
        $_SESSION['error_message'] = "Data Gagal Disimpan!";
    }

    header('location: ../views/index.php?hal=dataset');
} else {
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
}
?>