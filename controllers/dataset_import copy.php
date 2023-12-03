<?php
session_start();

include_once '../models/dataset.php';
require_once '../vendor/autoload.php';

use setasign\Fpdi\Fpdi;


if (isset($_POST['btnImport'])) {
    $allowed_ext = array('pdf');
    $success = 0;
    $error = 0;

    for ($i = 0; $i < count($_FILES['pdf_file']['tmp_name']); $i++) {
        $file_name = $_FILES['pdf_file']['name'][$i];
        $tmp = explode('.', $file_name);
        $file_ext = end($tmp);
        $file_tmp = $_FILES['pdf_file']['tmp_name'][$i];
        $file_type = $_FILES['pdf_file']['type'][$i];

        $allowed_mime_types = array('application/pdf');

        if (in_array($file_type, $allowed_mime_types) === false) {
            $error++;
            continue; // Skip this file
        }

        try {
            $text = pdfToText($file_tmp);

            $dataset = new Dataset();

            if ($dataset->create($file_name, $text)) {
                $success++;
            } else {
                $error++;
            }
        } catch (Exception $e) {
            error_log('Error importing file ' . $file_name . ': ' . $e->getMessage());
            echo 'Error importing file ' . $file_name . ': ' . $e->getMessage();
        }
    }

    if ($error == 0) {
        $_SESSION['success_message'] = "Sebanyak " . $success . " File berhasil disimpan.";
    } else {
        $_SESSION['info_message'] = "Sebanyak " . $success . " File berhasil disimpan dan " . $error . " file gagal disimpan.";
    }

    header('location: ../views/index.php?hal=dataset');
    exit(); // Add this to prevent further execution
}

echo '
    <script type="text/javascript">
        history.go(-1);
    </script>
';

function pdfToText($pdfFile)
{
    try {
        $pdf = new Fpdi('P', 'mm', 'A4');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdfReader = new PdfReader();
        $pdfReader->setSourceFile($pdfFile);

        $numPages = $pdfReader->getNumberOfPages();

        $text = '';
        for ($i = 1; $i <= $numPages; $i++) {
            $text .= $pdfReader->getPage($i)->getText();
        }

        return $text;
    } catch (Exception $e) {
        throw new Exception('Error extracting text from PDF: ' . $e->getMessage());
    }
}
?>