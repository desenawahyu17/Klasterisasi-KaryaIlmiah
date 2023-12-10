<div class="jumbotron text-center">
    <div class="container w-85 text-center">
        <h4>Judul Penelitian</h4>
        <h5>NIM - NAMA</h5>
    </div>
    <hr>
    <div class="bs-callout bs-callout-primary mt-0 text-justify">
        <ol>
            <li>Tentang
                <ul>
                    <li>Sistem berbasis web sebagai alat bantu untuk membantu seseorang dalam menentukan topik
                        penelitian dari abstrak kumpulan karya ilmiah penelitian yang sudah ada dengan mengklasterisasi
                        dokumen abstrak melalui tahap korpus dengan mengkombinasi metode <em>Complete Linkage</em> dan
                        <em>K-means.</em>
                    </li>
                    <li>Sistem ini diimplementasikan berbasis web, dengan bahasa pemrograman PHP <em>(Hypertext
                            Preprocessor)</em> dan sistem basis data MySQL.</li>
                </ul>
            </li>
            <li>Batasan
                <ul>
                    <li>Jenis data yang diuji berupa teks jenis pdf, tidak menguji data teks jenis lain, dan tidak
                        menguji data tabel, gambar maupun suara.</li>
                    <li>Tidak memperhatikan kesalahan ejaan/penulisan pada dokumen.</li>
                    <li>Tidak memperhatikan sinonim/persamaan kata.</li>
                </ul>
            </li>
            <li>Panduan Penggunaan
                <ul>
                    <li><em>Upload</em> dokumen hanya mengenali file pdf.</li>
                </ul>
            </li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?hal=stopword" class="text-decoration-none text-dark">
                        Jumlah <em>Stopword</em> <i class="fa fa-language"></i>
                    </a>
                </div>
                <div class="card-body align-items-center text-muted ">
                    <h3 class="mb-0 text-dark">
                        <?php
						include_once '../models/stopword.php';
						$stopword   = new Stopword();

						echo $stopword->count_data();
					?>
                    </h3>
                    <p><em>Stopword</em></p>
                    <a href="index.php?hal=stopword" class="btn btn-info btn-sm">Lihat Detail <i
                            class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?hal=dataset" class="text-decoration-none text-dark">
                        Jumlah <em>Dataset</em> <i class="fa fa-list-alt"></i>
                    </a>
                </div>
                <div class="card-body align-items-center text-muted ">
                    <h3 class="mb-0 text-dark">
                        <?php
						include_once '../models/dataset.php';
						$dataset   = new Dataset();

						echo $dataset->count_data();
					?>
                    </h3>
                    <p><em>Dataset</em></p>
                    <a href="index.php?hal=dataset" class="btn btn-info btn-sm">Lihat Detail <i
                            class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?hal=preprocessing" class="text-decoration-none text-dark">
                        Jumlah Data <em>Preprocessing</em> <i class="fa fa-gear"></i>
                    </a>
                </div>
                <div class="card-body align-items-center text-muted ">
                    <h3 class="mb-0 text-dark">
                        <?php
						include_once '../models/preprocessing.php';
						$preprocessing   = new Preprocessing();

						echo $preprocessing->count_data();
					?>
                    </h3>
                    <p>Data <em>Preprocessing</em></p>
                    <a href="index.php?hal=preprocessing" class="btn btn-info btn-sm">Lihat Detail <i
                            class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0">
                <div class="card-body align-items-center text-muted mt-2">
                    <a href="index.php?hal=korpus" class="btn btn-info btn-sm w-75 mb-3">Buat Ekstraksi Fitur <i
                            class="fa fa-cogs"></i></a>
                    <a href="index.php?hal=gabungan" class="btn btn-info btn-sm w-75 mb-3">Lakukan Pengujian <i
                            class="fa fa-list-ul"></i></a>
                    <a href="index.php?hal=visualisasi_hasil" class="btn btn-info btn-sm w-75 mb-3">Visualisai hasil <i
                            class="fa fa-bar-chart"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>