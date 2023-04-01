<?php
	if(isset($_SESSION['arr_iterasi'])){
        $list_vektor = $_SESSION['list_vektor'];
		$data_korpus = $_SESSION['data_korpus'];
        $arr_iterasi = $_SESSION['arr_iterasi'];
        $arrnew_centoid = $_SESSION['arrnew_centoid'];        
        $arrall_centroid = $_SESSION['arrall_centroid'];
        $arrm_count_centroid = $_SESSION['arrm_count_centroid'];
        $arrnilai_M = $_SESSION['arrnilai_M'];
        $arrm_min = $_SESSION['arrm_min'];
        $arrcentroid_change = $_SESSION['arrcentroid_change'];
        $arrmin_index = $_SESSION['arrmin_index'];
        $arrWCSS = $_SESSION['arrWCSS'];
        $arr_selected_centroid = $_SESSION['arr_selected_centroid'];
?>
<div class="jumbotron">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="bs-callout bs-callout-primary mt-0">
                <h4>Hasil Pengujian</h4>
                <p>Detail data hasil proses Pengujian dengan metode <em>K-Means</em>.</p>
            </div>
            <div class="row">
                <!-- Alert -->
                <?php
					if(isset($_SESSION['success_message'])) {
						echo '
							<div class="alert alert-success alert-dismissible fade show w-100" role="alert">
								'. $_SESSION['success_message'] .'
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						';
					}
					if(isset($_SESSION['error_message'])) {echo '
						<div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
							'. $_SESSION['error_message'] .'
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					}
				?>
                <h2 class="container-fluid text-center">Data Hasil Ekstraksi Fitur</h2>
                <div class="col-md-12 mb-4">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-striped w-100 text-center tbl-sm" id="myTable">
                            <thead class="w-100">
                                <tr>
                                    <th>No.</th>
                                    <th><em>Name</em></th>
                                    <th><em>Clean Text</em></th>
                                    <th>Vektor Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$nomor = 1;
									for($i=0; $i < count($data_korpus); $i++){
										echo '
										<tr>
											<td>'. $nomor++ .'</td>
											<td class="text-left" width="20%">'. $data_korpus[$i]["dokumen_name"] .'</td>	
											<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">'. $data_korpus[$i]["clean_text"] .'</textarea></td>
										';	
										echo '<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">';
										for ($j=0; $j <count($list_vektor[$i]); $j++) {
											echo $list_vektor[$i][$j] .",";
										}
										echo '
												</textarea>
											</td>
										</tr>';
									}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h2 class="container-fluid text-center">Mencari nilai k dengan metode <em>Elbow</em></h2>
                <br><br>
                <div class="col-md-12">
                    <h4 class="container-fluid">Mencari selisi nilai k</h4>
                    <div class="container-fluid table-responsive">
                        <table class="table table-sm table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th><em>Cluster</em></th>
                                    <th>WCSS</th>
                                    <th>Selisih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor = 1;
                                    for($i=0; $i< count($arrWCSS); $i++) {
                                        echo '<tr>';
                                        echo '<td class="text-center" width="5%"><b>'. $nomor++ .'</b></td>';
                                            echo '
                                                <td class="text-center">'.$arrWCSS[$i][0].'</td>
                                                <td class="text-center">'. $arrWCSS[$i][1] .'</td>
                                                <td class="text-center">'. $arrWCSS[$i][2] .'</td>
                                            ';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='container-fluid text-mute'>
                    <pre>
                    <span class='h6 text-dark'>Dari tabel diatas selisih paling besar ada pada <em>cluster</em> ke-3</span>
                    └── <span class='h6 text-dark'>Sehingga nilai k optimal adalah: 3</span>
                    └──── <span class='h6 text-dark'>Untuk penentuan pusat awal <em>cluster</em> dipilih secara acak</span>
                    </pre>
                </div>
                <h2 class="container-fluid text-center">Proses <em>K-Means</em></h2><br><br>
                <?php
                for($i=0; $i < count($arr_selected_centroid); $i++){  
                echo '
                <h4 class="container-fluid">Nilai Centroid untuk pusat awal <em>cluster</em> yang dipilih secara acak</h4>
                        <div class="container-fluid table-responsive">
                            <table class="table table-sm table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Vektor <em>Centroid</em></th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                                    for ($j=0; $j <count($arr_selected_centroid[$i]); $j++) { 
                                    echo '
                                    <tr>
                                        <td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">
                                    ' ; 
                                    for ($k=0; $k <count($arr_selected_centroid[$i][$j]); $k++) { echo $arr_selected_centroid[$i][$j][$k]
                                        .","; 
                                    } 
                                    echo '
                                            </textarea>
                                        </td>
                                    </tr>' ; 
                                } echo '
                                 </tbody>
                            </table>
                        </div>
                        ';
                    }
                ?>
                <br><br><br>
                <div class="col-md-12">
                    <?php
                    for($i=0; $i < count($arr_iterasi); $i++){
                    $nomor = 1;
                        echo '<h4 class="container-fluid">Iterasi Ke-'. $arr_iterasi[$i] .'</h4>
                        <div class="container-fluid table-responsive">
                            <table class="table table-sm table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        ';
                                            for ($j=1; $j <= count($arrm_count_centroid[$i]); $j++) {
                                            echo "<th><em>Centroid</em> ". $j ."</th>";
                                            }
                                        echo'
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                                for ($j=0; $j < count($arrall_centroid[$i]); $j++) {
                                    echo '<tr>';
                                    if(in_array($j, $arrcentroid_change[$i])) {
                                        echo "<td style='background-color: red'>". $nomor++ ."</td>";
                                    }
                                    else {
                                        echo "<td width='5%'>". $nomor++ ."</td>";
                                    }
                    
                                    for ($k=0; $k < count($arrm_count_centroid[$i]); $k++) {
                                        if($arrnilai_M[$i][$j][$k] == $arrm_min[$i][$j]) {
                                            echo"<td style='background-color: orange'>". $arrnilai_M[$i][$j][$k] ."</td>";
                                        }
                                        else {
                                            echo"<td>". $arrnilai_M[$i][$j][$k] ."</td>";
                                        }
                                    }
                                    echo '
                                    </tr>
                                    ';
                                }
                                echo '
                                </tbody>
                            </table>
                        </div>
                        <h4 class="container-fluid">Centroid Baru</h4>
                        <div class="container-fluid table-responsive">
                            <table class="table table-sm table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Vektor <em>Centroid</em> Baru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                                    for ($j=0; $j <count($arrnew_centoid[$i]); $j++) { 
                                    echo '
                                    <tr>
                                        <td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">
                                    ' ; 
                                    for ($k=0; $k <count($arrnew_centoid[$i][$j]); $k++) { echo $arrnew_centoid[$i][$j][$k]
                                        .","; 
                                    } 
                                    echo '
                                            </textarea>
                                        </td>
                                    </tr>' ; 
                                } echo '
                                 </tbody>
                            </table>
                        </div>
                        ' ; 
                    } 
                    ?>
                </div>
                <h2 class="container-fluid text-center">Data Hasil</h2>
                <div class="col-md-12 mb-4">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-striped w-100 text-center tbl-sm" id="myTable2">
                            <thead class="w-100">
                                <tr>
                                    <th>No.</th>
                                    <th><em>Name</em></th>
                                    <th><em>Text</em></th>
                                    <th><em>Clean Text</em></th>
                                    <th><em>Cluster</em></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$nomor = 1;
									for($i=0; $i < count($data_korpus); $i++){
										echo '
										<tr>
											<td>'. $nomor++ .'</td>
											<td class="text-left" width="20%">'. $data_korpus[$i]["dokumen_name"] .'</td>	
											<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">'. $data_korpus[$i]["dokumen_text"] .'</textarea></td>
											<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">'. $data_korpus[$i]["clean_text"] .'</textarea></td>
										    <td width="5%">'. ($arrmin_index[(count($arrmin_index)-1)][$i] +1) .'</td>
                                            ';
										echo '
										</tr>';
									}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <a href="index.php?hal=k_means" class="btn btn-info w-50"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php		
	}
	else {
		header('location: index.php?hal=k_means');
	}
?>