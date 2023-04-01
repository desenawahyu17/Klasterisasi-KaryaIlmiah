<?php
	if(isset($_SESSION['arr_result'])) {
		$arr_result = $_SESSION['arr_result'];
		$limit = count($arr_result['data']) >= 5 ? 5 : count($arr_result['data']);
?>
<div class="jumbotron">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="bs-callout bs-callout-primary mt-0">
                <h4>Hasil Ekstraksi Fitur</h4>
                <p>Detail data hasil proses Ekstraksi Fitur.</p>
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
                <h5 class="container-fluid">5 sampel data abstrak pembangun model:</h5>
                <div class="container-fluid table-responsive">
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Dokumen</th>
                                <th>Isi Dokumen (<em>Clean Text</em>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
									foreach($arr_result['data'] as $index => $value) {
										echo '
											<tr>
												<td>Dokumen ke-'. (++$index) .'</td>
												<td class="text-justify">'. $value['clean_text'] .'</td>
											</tr>
										';
										
										if($index >= $limit){
											break;
										}
									}
									echo '
									<tr>
										<td class="text-left pl-3" colspan="2"> .......... </td>
									</tr>
								';
								?>
                        </tbody>
                    </table>
                </div>
                <h5 class="container-fluid">Vektor hasil CountVectorizer:</h5>
                <div class="container-fluid table-responsive">
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <?php
										foreach($arr_result['list_vocabulary'] as $index => $value) {
											echo '<td>'.$value.'</td>';
										}
									?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
									for($i=0; $i<$limit; $i++) {
										echo '<tr>';
										echo '<td>Dokumen ke-'. (++$i) .'</td>';
										foreach($arr_result['vector_list'][--$i] as $index => $value) {
											echo '
												<td class="text-justify">'.$value.'</td>
											';
										}
										echo '</tr>';
									}
									echo '
									<tr>
										<td class="text-left pl-3" colspan="'. (count($arr_result['vector_list'][0]) + 1) .'"> .......... </td>
									</tr>
									';
								?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12 text-center">
                    <a href="index.php?hal=korpus" class="btn btn-info w-50 mt-5"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php		
	}
	else {
		header('location: index.php?hal=korpus');
	}
?>