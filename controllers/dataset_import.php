<?php
    session_start();

    include_once '../models/dataset.php';
    include 'pdf2text.php';

    if(isset($_POST['btnImport'])) {
        $allowed_ext	= array('pdf');
        $success = 0;
        $error = 0;
        for($i=0;$i<count($_FILES['pdf_file']['tmp_name']);$i++){
            $file_name		= $_FILES['pdf_file']['name'][$i];
            $tmp            = explode('.', $file_name);
            $file_ext       = end($tmp);
            $file_tmp		= $_FILES['pdf_file']['tmp_name'][$i]; 
            
            if(in_array($file_ext, $allowed_ext) === true){

                try {
                    $text = pdf2text($file_tmp);
                    
                    $dataset   = new Dataset();

                    if($dataset->create($file_name, $text)) {
                        $success++;
                    }
                    else {
                        $error++;
                    }
                }
                catch(exception $e) {
                    echo $e;
                }
            }else{
                $error++;
            }
        }

        if($error == 0) {
            $_SESSION['success_message'] = "Sebanyak ".$success." File berhasil disimpan.";
        }
        else {
            $_SESSION['info_message'] = "Sebanyak ".$success." File berhasil disimpan dan ".$error." file gagal disimpan.";
        }
        header('location: ../views/index.php?hal=dataset');


        // // var_dump($_FILES['pdf_file']);
        // die();

        // // CEK APAKAH YANG DIUPLOAD PDF?
        // if($_FILES["pdf_file"]["type"] == "application/pdf") {

        //     $text = pdf2text($_FILES['pdf_file']["tmp_name"]);
        //     // echo $text;

        //     // var_dump($_FILES['pdf_file']);
        //     di

        // // INISIALISASI $dataset DENGAN INSTANCE UNTUK CLASS 'Dataset' YANG BERADA PADA FILE dataset.php
        // // $dataset   = new Dataset();
            
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>