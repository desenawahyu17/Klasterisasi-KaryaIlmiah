<?php
    session_start();

    include_once '../models/korpus.php';
    include_once '../models/model_data.php';

    if(isset($_POST['korpus'])) {

        // INISIALISASI MODEL YANG AKAN DIGUNAKAN UNTUK PROSES MODELING
		$korpus = new Korpus();
		$model_data = new ModelData();

        // SELECT ALL  DARI DATASET
		$data = $korpus->getAll();

        #step 1 membuat korpus
        $list_korpus = [];
        for($i=0; $i<count($data); $i++) {
            $str = $data[$i]['clean_text'];
            $delimiter = ' ';
            $words = explode($delimiter, $str);
            foreach ($words as $word) {
               array_push($list_korpus,$word);
            }
        }

        #step 2 membuat vocabulary
        $list_vocabulary = array_unique($list_korpus);
        $list_vocabulary = array_values($list_vocabulary);

        #step 3 membuat vektor 0 dengan panjang = len(list_vocabulary) & lebar = len(list_korpus)
        $vektor_kosong = [];
        for($i=0; $i<count($data); $i++) {
            $vektor = array_fill(0, count($list_vocabulary), 0);
            array_push($vektor_kosong,$vektor);
        }

        #step 4 Membuat list vector
        $vector_list = $vektor_kosong;
        for($i=0; $i<count($list_vocabulary); $i++){

            for($j=0; $j<count($data); $j++){

                $str = $data[$j]['clean_text'];
                $delimiter = ' ';
                $words = explode($delimiter, $str);

                foreach ($words as $word) {
                    
                    if($word == $list_vocabulary[$i]){
                        $vector_list[$j][$i] +=1;
                    }
                }
            }
        }

        #step 5 Membuat model data json
        $file_name = 'klasterisasi_model'.date("Ymd_hms").'.json';

        $model_data_location = '../model_data/'. $file_name;
        $arr_result = array(
            "data" => $data,
            "list_korpus" => $list_korpus,
            "list_vocabulary" => $list_vocabulary,
            "vector_list" => $vector_list
        );

        if(file_put_contents($model_data_location, json_encode($arr_result)) === FALSE) {
            $_SESSION['error_message'] =  "Gagal Membuat Ekstraksi Fitur!";

            header('location: ../views/index.php?hal=korpus');
        } else {
            $model_data->model_name = $file_name;
            $model_data->clustering_count = count($data);

            if($model_data->create()){
                // SET DATA UNTUK DITAMPILKAN KE LAYAR
                $_SESSION['arr_result'] = $arr_result;
                $_SESSION['success_message'] =  "Berhasil Melakukan Ekstraksi Fitur!";
        
                header('location: ../views/index.php?hal=korpus_result');
            }
            else {
                $_SESSION['error_message'] =  "Gagal Menyimpan Model Data!";

                header('location: ../views/index.php?hal=korpus');
            }
        }
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>