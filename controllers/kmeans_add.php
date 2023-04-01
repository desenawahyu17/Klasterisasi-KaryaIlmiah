<?php
    session_start();
    include_once '../models/model_data.php';

    if(isset($_POST['gabungan'])) {

        $flag = 0;
        // INISIALISASI MODEL YANG AKAN DIGUNAKAN UNTUK PROSES MODELING
		$model_data = new ModelData();

        // SELECT ALL  DARI DATASET
		$model_data->id = trim($_POST['id']);
        $arrWCSS = array (
            array("2","174017,99","0"),
            array("3","164170,04","9847,94"),
            array("4","161787,60","2382,44"),
            array("5","159935,15","1852,45"),
            array("6","157095,40","2839,75"),
            array("7","153698,73","1852,45")
          );

        $result = $model_data->select_one();
        if($result != NULL) {
            $model_data_location = '../model_data/'. $result["model_name"];
            $JSON = file_get_contents($model_data_location);
            $contents = json_decode($JSON, true); 

            $dataProsesKorpus = $contents["data"];
            $data = $contents["vector_list"];

            $desimal = 2; // setiap perhitungan diproses di bawah akan mengambil 2 desimal

            // Random centroid data sebanyak n nilai K 
            $centroid = array();
            $i = 0;
            $nilai_K = 3;
            while($i < $nilai_K) {
                $tmp_rand = rand(0, $nilai_K);

                // Mencegah data sama terpilih
                if(!in_array($tmp_rand, $centroid)) {
                    array_push($centroid, $tmp_rand);
                    $i++;
                }
            }

            // $centroid = array(0, 3); // KEPERLUAN TESTING AGAR DATA YANG TERPILIH SELALU DATA KE 1 DAN KE 4 --- DIHAPUS SAAT IMPLEMENTASI

            // PROSES K-MEANS DIMULAI ========================================================================================

            // select data Centroid awal sesuai isi array random $centroid
            // di sini akan SELALU kepilih array ke-1 dan ke-3 (akibat kode line 216)
            $all_centroid = $contents["vector_list"];
            $selected_centroid = array();
            $arr_selected_centroid = array();
            for ($i=0; $i < count($centroid); $i++) { 
                array_push($selected_centroid, $contents["vector_list"][$centroid[$i]]);
            }

            //Pembuatan array
            $arr_iterasi = array();
            $arrall_centroid = array();
            $arrm_count_centroid = array();
            $arrnilai_M = array();
            $arrm_min = array();
            $arrnew_centoid = array();
            $arrcentroid_change = array();
            $arrmin_index = array();

            // Inisialisasi variabel untuk proses K-Means
            $iterasi = 1;
            $m_min = array();
            $m_min_index = array();
            $nilai_M = array();
            $m_count_centroid = array_fill(0, count($selected_centroid), 0);    // buat array kosong (isi 0)
            $new_centoid = array_fill(
                0, count($selected_centroid), 
                array_fill(0, count($selected_centroid[0]), 0)
            );  // buat array kosong (isi 0)

            // Proses K-MEANS ITERASI KE-1  ==========================================================
            for ($i=0; $i < count($all_centroid); $i++) { 
                
                // CARI JARAK DENGAN Euclidean Distance - antara Centroid awal ($selected_centroid) dengan semua data centroid ($all_centroid)
                $result_tmp = array();
                for ($j=0; $j < count($selected_centroid); $j++) {
                    $hasil = 0;
                    for ($k=0; $k < count($all_centroid[$i]); $k++) {
                        $hasil += pow(($selected_centroid[$j][$k] - $all_centroid[$i][$k]),2);
                    }
                    $hasil = round(sqrt($hasil), $desimal);
                    array_push($result_tmp, $hasil);
                }

                // CARI DATA MINIMAL DALAM N-Centroid -- penentuan sebuah centroid masuk ke cluster mana berdasarkan nilai yang paling kecil jaraknya
                for ($j=0; $j < count($result_tmp); $j++) { 
                    if($result_tmp[$j] == min($result_tmp)) {
                        $m_count_centroid[$j] += 1;

                        // Mencari jumlah nilai centeroid baru
                        for ($k=0; $k < count($all_centroid[$i]); $k++) {
                            $new_centoid[$j][$k] += $all_centroid[$i][$k];
                        }
                    }
                }

                array_push($nilai_M, $result_tmp);
            }

            // Hitung nilai centeroid baru 
            for ($i=0; $i < count($m_count_centroid); $i++) {
                for ($j=0; $j < count($new_centoid[$i]); $j++) {
                    $new_centoid[$i][$j] = round((1/$m_count_centroid[$i]) * $new_centoid[$i][$j], $desimal);
                }
            }

            // Get Min data
            for ($i=0; $i < count($nilai_M); $i++) {
                array_push($m_min, min($nilai_M[$i]));
                $index = array_keys($nilai_M[$i], min($nilai_M[$i]));
                array_push($m_min_index, $index[0]);
            }
            // Menyimpan data ke-array
            $centroid_change = array();
            array_push($arrcentroid_change, $centroid_change);
            array_push($arr_iterasi, $iterasi);
            array_push($arrall_centroid, $all_centroid);
            array_push($arrm_count_centroid, $m_count_centroid);
            array_push($arrnilai_M, $nilai_M);
            array_push($arrm_min, $m_min);
            array_push($arrnew_centoid, $new_centoid);
            array_push($arrmin_index, $m_min_index);
            array_push($arr_selected_centroid, $selected_centroid);

            // PANGGIL FUNSI UNTUK CETAK TABEL
            // cetak_tabel($iterasi, $all_centroid, $m_count_centroid, $nilai_M, $m_min, $new_centoid);

            // Proses K-MEANS ITERASI KE-1 SELESAI  ==========================================================
          
            // Proses K-MEANS ITERASI KE-2 sampai ke-n  ==========================================================

            $iterasi = 2;
            while($iterasi > 0) {

                $centroid_change = array();
                $m_min = array();
                $m_min_index_old = $m_min_index;
                $m_min_index = array();
                $nilai_M = array();
                $m_count_centroid = array_fill(0, count($new_centoid), 0);    // buat array kosong (isi 0)
                $selected_centroid = $new_centoid;
                $new_centoid = array_fill(
                    0, count($selected_centroid), 
                    array_fill(0, count($selected_centroid[0]), 0)
                );  // buat array kosong (isi 0)


                for ($i=0; $i < count($all_centroid); $i++) { 
                    
                    // CARI JARAK DENGAN Euclidean Distance
                    $result_tmp = array();
                    for ($j=0; $j < count($selected_centroid); $j++) {
                        $hasil = 0;
                        for ($k=0; $k < count($all_centroid[$i]); $k++) {
                            $hasil += pow(($selected_centroid[$j][$k] - $all_centroid[$i][$k]), $desimal);
                        }
                        $hasil = round(sqrt($hasil), $desimal);
                        array_push($result_tmp, $hasil);
                    }

                    // CARI DATA MINIMAL DALAM N-Centroid -- penentuan sebuah centroid masuk ke cluster mana berdasarkan nilai yang paling kecil jaraknya
                    for ($j=0; $j < count($result_tmp); $j++) { 
                        if($result_tmp[$j] == min($result_tmp)) {
                            $m_count_centroid[$j] += 1;

                            // Mencari jumlah nilai centeroid baru
                            for ($k=0; $k < count($all_centroid[$i]); $k++) {
                                $new_centoid[$j][$k] += $all_centroid[$i][$k];
                            }
                        }
                    }

                    array_push($nilai_M, $result_tmp);
                }

                // Hitung nilai centeroid baru 
                for ($i=0; $i < count($m_count_centroid); $i++) {
                    for ($j=0; $j < count($new_centoid[$i]); $j++) {
                        $new_centoid[$i][$j] = round((1/$m_count_centroid[$i]) * $new_centoid[$i][$j], $desimal);
                    }
                }

                // Get Min data
                for ($i=0; $i < count($nilai_M); $i++) {
                    array_push($m_min, min($nilai_M[$i]));
                    $index = array_keys($nilai_M[$i], min($nilai_M[$i]));
                    array_push($m_min_index, $index[0]);
                }

                // CEK adakah centroid yang pindah kelompok
                for ($i=0; $i < count($m_min_index); $i++) { 
                    if($m_min_index[$i] != $m_min_index_old[$i]) {
                        array_push($centroid_change, $i);
                    }
                }

                // Menyimpan data ke-array
                array_push($arr_iterasi, $iterasi);
                array_push($arrall_centroid, $all_centroid);
                array_push($arrm_count_centroid, $m_count_centroid);
                array_push($arrnilai_M, $nilai_M);
                array_push($arrm_min, $m_min);
                array_push($arrnew_centoid, $new_centoid);
                array_push($arrcentroid_change, $centroid_change);
                array_push($arrmin_index, $m_min_index);

                // PANGGIL FUNGSI UNTUK CETAK TABEL
                // cetak_tabel($iterasi, $all_centroid, $m_count_centroid, $nilai_M, $m_min, $new_centoid, $centroid_change);

                if(count($centroid_change) == 0) {
                    $iterasi = 0;
                }
                else {
                    $iterasi ++;
                }
            }
            // Proses K-MEANS ITERASI KE-2 sampai ke-n selesai ==========================================================


            // die();

            $_SESSION['data_korpus'] = $dataProsesKorpus;
            $_SESSION['list_vektor'] = $data;
            $_SESSION['arr_iterasi'] = $arr_iterasi;
            $_SESSION['arrall_centroid'] = $arrall_centroid;
            $_SESSION['arrm_count_centroid'] = $arrm_count_centroid;
            $_SESSION['arrnilai_M'] = $arrnilai_M;
            $_SESSION['arrm_min'] = $arrm_min;
            $_SESSION['arrnew_centoid'] = $arrnew_centoid;
            $_SESSION['arrcentroid_change'] = $arrcentroid_change;
            $_SESSION['arrmin_index'] = $arrmin_index;
            $_SESSION['arrWCSS'] = $arrWCSS;
            $_SESSION['arr_selected_centroid'] = $arr_selected_centroid;
            $_SESSION['success_message'] =  "Berhasil Melakukan Proses Pengujian";
        }
        else {
            // MEMBUAT ALERT ERROR KETIKA FUNGSI create() MENGEMBALIKAN NILAI false
            $_SESSION['error_message'] = "Data Gagal Dipilih!";
            header('location: ../views/index.php?hal=k_means');
        }

        header('location: ../views/index.php?hal=k_means_result');
    }
    
    echo '
        <script type="text/javascript">
            history.go(-1);
        </script>
    ';
?>