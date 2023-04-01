<?php
    session_start();

    include('templates/layouts/header.php');

    // CEK ADA ATAU TIDAKNYA URL
    if(isset($_GET['hal'])) {
        
        // MEMBERIKAN NILAI UNTUK index.php?hal=<<NILAI>>
        switch($_GET['hal']) {
            // SAAT index?hal=dashboard, TAMPILKAN ISI DARI dashboard.php
            case 'dashboard'  : include 'templates/dashboard.php'; break;

            // SAAT index?hal=stopword, TAMPILKAN ISI DARI stopword.php
            case 'stopword'  : include 'templates/stopword.php'; break;

            // SAAT index?hal=dataset, TAMPILKAN ISI DARI dataset.php
            case 'dataset'  : include 'templates/dataset.php'; break;
            
            // SAAT index?hal=preprocessing, TAMPILKAN ISI DARI preprocessing.php
            case 'preprocessing'  : include 'templates/preprocessing.php'; break;

            // SAAT index?hal=preprocessing_result, TAMPILKAN ISI DARI preprocessing_result.php
            case 'preprocessing_result'  : include 'templates/preprocessing_result.php'; break;

            // SAAT index?hal=korpus, TAMPILKAN ISI DARI korpus.php
            case 'korpus'  : include 'templates/korpus.php'; break;

            // SAAT index?hal=korpus_result, TAMPILKAN ISI DARI korpus_result.php
            case 'korpus_result'  : include 'templates/korpus_result.php'; break;
            
            // SAAT index?hal=k_means, TAMPILKAN ISI DARI k_means.php
            case 'k_means'  : include 'templates/k_means.php'; break;

            // SAAT index?hal=k_means_result, TAMPILKAN ISI DARI k_means_result.php
            case 'k_means_result'  : include 'templates/k_means_result.php'; break;

            // SAAT index?hal=gabungan, TAMPILKAN ISI DARI gabungan.php
            case 'gabungan'  : include 'templates/gabungan.php'; break;

            // SAAT index?hal=gabungan_result, TAMPILKAN ISI DARI gabungan_result.php
            case 'gabungan_result'  : include 'templates/gabungan_result.php'; break;
            
            // SAAT index?hal=visualisasi_hasil, TAMPILKAN ISI DARI visualisasi_hasil.php
            case 'visualisasi_hasil'  : include 'templates/visualisasi_hasil.php'; break;
            
            // SAAT index?hal=hasil, TAMPILKAN ISI DARI hasil.php
            case 'hasil'  : include 'templates/hasil.php'; break;

            // SELAIN YANG DI ATAS MAKA AKAN MENAMPILKAN HALAM 404
            default : include 'templates/404.php';
        }
    }
    else {
        // HALAMAN YANG DITAMPILKAN PERTAMA KALI
        include 'templates/dashboard.php';
    }

    include('templates/layouts/footer.php');

    $_SESSION['success_message'] = null;
    $_SESSION['error_message'] = null;
    $_SESSION['info_message'] = null;
    $_SESSION['arr_iterasi'] = null;
    $_SESSION['arrnew_centoid'] = null;
    $_SESSION['arrm_count_centroid'] = null;
    $_SESSION['arrnilai_M'] = null;
    $_SESSION['arrm_min'] = null;
    $_SESSION['arrnew_centoid'] = null;
    $_SESSION['arrcentroid_change'] = null;
    $_SESSION['arrall_centroid'] = null;
    $_SESSION['arrmin_index'] = null;
    $_SESSION['arrWCSS'] = null;
    $_SESSION['arr_selected_centroid'] = null;
    
    // session_destroy();
?>