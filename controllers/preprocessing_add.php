<?php
    session_start();
    
    include_once '../models/stopword.php';
    include_once '../models/dataset.php';
    include_once '../models/preprocessing.php';
    require '../assets/libs/vendor/autoload.php';

    // INISIALISASI SASTRAWI UNTUK PROSES STEMMING
    $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
    $stemmer  = $stemmerFactory->createStemmer();

    if(isset($_POST['preprocessing'])) {

        // INISIALISASI MODEL YANG AKAN DIGUNAKAN UNTUK PROSES PREPROCESSING
        $stopword = new Stopword();
		$dataset = new Dataset();
        $preprocessing   = new Preprocessing();

        // SELECT ALL RECORD STOPWORD
        $data = $stopword->getAll();
        $stopword_list = array();
        foreach($data as $d) {
            array_push($stopword_list, $d['stopword']);
        }

        $flag = 0;
        $limit_to_save = 500;   // setiap 500 data akan menjalankan 1x query insert
        $tuple = array();

        // WADAH SEMENTARA UNTUK HASIL PREPROCESSING (YANG AKAN DITAMPILKAN KE LAYAR)
        $array_firstText = array();
        $array_casefolding = array();
        $array_cleaning = array();
        $array_stopword = array();
        $array_stemming = array();

        // SELECT ALL  DARI DATASET
		$data = $dataset->getAll();

        // PREPROCESSING UNTUK TIAP DATASET SECARA SATU PER SATU
		foreach($data as $index => $value) {
            
            //////////////////////////////////////
            //////////////////////////////////////
            /*  PROSES PREPROCESSING [START]    */
            //////////////////////////////////////
            //////////////////////////////////////

            // TEXT AWAL
            $result_text = $value['dokumen_text'];
            
            array_push($array_firstText, $result_text);   // TAMPUNG DATA TEXT AWAL UNTUK DITAMPILKAN

            // CASEFOLDING
            $result_text = strtolower($result_text);
            array_push($array_casefolding, $result_text);   // TAMPUNG DATA CASEFOLDING UNTUK DITAMPILKAN

            // CLEASING - MENGHAPUS EMAIL (ditandai dengan @)
            $result_text = preg_replace('/[^@\s]*@[^@\s]*\.[^@\s]*/', ' ', $result_text);

            // CLEASING - MENGHAPUS URL (ditandai dengan www atau http://)
            $result_text = preg_replace('/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i', ' ', $result_text);

            // CLEASING - MENGHAPUS MENTION (ditandai dengan awalan @)
            $result_text = preg_replace('/@(\w+)/', ' ', $result_text);

            // CLEASING - MENGHAPUS SELURUH KARAKTER SELAIN HURUF (selain huruf a-z)
            $result_text = preg_replace('/[^a-z]+/i', ' ', $result_text);

            // CLEASING - MENGHAPUS KARAKTER TUNGGAL
            $result_text = preg_replace('/(^| ).(( ).)*( |$)/', ' ', $result_text);

            array_push($array_cleaning, $result_text);  // TAMPUNG DATA CLEANING UNTUK DITAMPILKAN

            // MENGHAPUS STOPWORD
            $word = explode(' ', $result_text);
            $array_temp = array();
            foreach($word as $w) {
                if(!in_array($w, $stopword_list)) {
                    array_push($array_temp, ''.$w);
                }	
            }
            $result_text = implode(' ', $array_temp);
            array_push($array_stopword, $result_text);  // TAMPUNG DATA HASIL STOPWORD UNTUK DITAMPILKAN

            // STEMMING
            $result_text = $stemmer->stem($result_text);
            array_push($array_stemming, $result_text);  // TAMPUNG DATA HASIL STOPWORD UNTUK DITAMPILKAN

            //////////////////////////////////////
            //////////////////////////////////////
            /*    PROSES PREPROCESSING [END]    */
            //////////////////////////////////////
            //////////////////////////////////////

            // SIMPAN DATA HASIL PREPROCESSING KE DALAM array list $tuple
            array_push($tuple, "('" . $value['id'] . "', '". addslashes($value['dokumen_key']) ."', '". addslashes($value['dokumen_name']) ."', '".  addslashes($value['dokumen_text']) ."', '". $result_text ."')");

            // SIMPAN DATA PER 500 DATA $tuple TELAH TERKUMPUL
            if($index == $limit_to_save) {
                $preprocessing->tuple = implode(',', $tuple);
                if($preprocessing->insert_multiple()) {
                    $flag += 1;
                }
                else {
                    $flag -= 1;
                }
                $tuple = array();
                $limit_to_save += 500;
            }
        }
        // SIMPAN DATA $tuple KE DALAM DATABASE
        $preprocessing->tuple = implode(',', $tuple);
        if($preprocessing->insert_multiple()) {
            $flag += 1;
        }
        else {
            $flag -= 1;
        }

        if($flag > 0) {
            // SET DATA UNTUK DITAMPILKAN KE LAYAR
            $_SESSION['text_awal'] = $array_firstText;
            $_SESSION['casefolding'] = $array_casefolding;
            $_SESSION['cleaning'] = $array_cleaning;
            $_SESSION['stopword'] = $array_stopword;
            $_SESSION['stemming'] = $array_stemming;
            $_SESSION['success_message'] =  "Berhasil Melakukan Proses Preprocessing. Data Berhasil Disimpan!";
        }

        header('location: ../views/index.php?hal=preprocessing_result');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>