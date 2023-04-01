<?php
    session_start();

    include_once '../models/stopword.php';
    require '../assets/libs/PhpSpreadsheet/vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if(isset($_FILES['excel_file'])) {

        // HANYA MENERIMA EXCEL DENGAN FORMAT .xlsx
        $allowedFileType = [
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        // CEK APAKAH FILE ADALAH FILE EXCEL .xlsx?
        if (in_array($_FILES["excel_file"]["type"], $allowedFileType)) {
    
            // SAVE FILE SEMENTARA PADA DIREKTORI
            $targetPath = basename($_FILES['excel_file']['name']) ;
            move_uploaded_file($_FILES['excel_file']['tmp_name'], $targetPath);

            // INISIALISASI $reader DENGAN INSTANCE UNTUK CLASS 'Xlsx' YANG BERADA PADA LIBARARY PhpSpreadsheet
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadSheet = $reader->load($targetPath);
            $excelSheet = $spreadSheet->getActiveSheet();   // MENGOLAH DATA PADA SHEET YANG DIBUKA (AKTIF)
            $spreadSheetAry = $excelSheet->toArray();
            $sheetCount = count($spreadSheetAry);

            // INISIALISASI $stopword DENGAN INSTANCE UNTUK CLASS 'Stopword' YANG BERADA PADA FILE stopword.php
            $stopword   = new Stopword();
            
            $success = 0;
            $tuple = array();
            // MENYIMPAN DATA stopword PADA FILE EXCEL KE DALAM WADAH ARRAY LIST $tuple
            for ($i = 1; $i <= $sheetCount; $i ++) {

                $stop = "";
                if (isset($spreadSheetAry[$i][0])) {

                    $stop = $spreadSheetAry[$i][0];
                }

                if (!empty($stop)) {
                    $tuple[] = "('" . $stop . "')";
                    $success += 1;
                }
            }
            // SET VARIAVEL stopword YANG BERADA PADA CLASS 'Stopword' DENGAN TUPLE BERDASARKAN ARRAY LIST $tuple
            $stopword->stopword = implode(',', $tuple);
            
            // MEMANGGIL FUNGSI insert_multiple() PADA CLASS 'Stopword'
            if($stopword->insert_multiple()) {
                // MEMBUAT ALERT SUKSES KETIKA FUNGSI create() MENGEMBALIKAN NILAI true
                $_SESSION['success_message'] =  $success ." Data Berhasil Disimpan!";
            }
            else {
                // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
                $_SESSION['error_message'] = "Gagal Menyimpan Data Excel!";
            }
    
            // HAPUS FILE EXCEL PADA DIREKTORI SETELAH SELESAI DIPROSES
            unlink($_FILES['excel_file']['name']);
        }
        else {
            $_SESSION['error_message'] = "File harus berupa file Excel dengan extensi (.xlsx)!";
        }
        header('location: ../views/index.php?hal=stopword');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>