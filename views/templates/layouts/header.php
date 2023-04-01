<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Text Mining - Klasterisasi Abstrak</title>

    <!-- CSS -->
    <link href="../assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
    <link href="../assets/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>

    <body>
        <!-- NAVBAR -->
        <div class="header">
            <a href="#" id="menu-action">
                <i class="fa fa-bars"></i>
                <span>Tutup</span>
            </a>
            <div class="mx-3 logo">PERPUSTAKAAN</div>
        </div>

        <!-- SIDEBAR -->
        <div class="sidebar">
            <ul>
                <li><a href="index.php?hal=dashboard" class="text-decoration-none"><i
                            class="fa fa-desktop"></i><em>Dashboard</em></a></li>
                <li><a href="index.php?hal=stopword" class="text-decoration-none"><i
                            class="fa fa-language"></i><em>Stopword</em></a></li>
                <li><a href="index.php?hal=dataset" class="text-decoration-none"><i
                            class="fa fa-list-alt"></i><em>Dataset</em></a></li>
                <li><a href="index.php?hal=preprocessing" class="text-decoration-none"><i
                            class="fa fa-gear"></i><em>Preprocessing</em></a></li>
                <li><a href="index.php?hal=korpus" class="text-decoration-none"><i class="fa fa-cogs"></i>Ekstraksi
                        Fitur</a></li>
                <li>
                    <a href="#subMenuListGroup" class="text-decoration-none" data-toggle="collapse"
                        aria-expanded="false"><i class="fa fa-list-ul"></i>Pengujian<i
                            class="fa fa-caret-down ml-4 pl-4"></i></a>
                    <ul class="collapse ml-3" id="subMenuListGroup">
                        <li class="ml-3 border-left"><a href="index.php?hal=k_means" class="text-decoration-none"><i
                                    class="fa fa-id-card"></i><em>K-Means</em></a></li>
                        <li class="ml-3 border-left"><a href="index.php?hal=gabungan" class="text-decoration-none"><i
                                    class="fa fa-users"></i>Gabungan</a></li>
                    </ul>
                </li>
                <!-- <li><a href="index.php?hal=visualisasi_hasil" class="text-decoration-none"><i class="fa fa-bar-chart"></i>Visualisasi Hasil</a></li> -->
            </ul>
        </div>

        <!-- CONTENT -->
        <main class="main">