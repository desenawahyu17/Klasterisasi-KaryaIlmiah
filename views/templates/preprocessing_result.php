<?php
	if(isset($_SESSION['text_awal']) && isset($_SESSION['casefolding']) && isset($_SESSION['cleaning']) && isset($_SESSION['stopword']) && isset($_SESSION['stemming'])) {
?>
<div class="jumbotron">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="bs-callout bs-callout-primary mt-0">
				<h4>Hasil <em>Preprocessing</em></h4>
				<p>Detail data hasil proses <em>Preprocessing</em>.</p>
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

				<div class="col-md-12 mb-4">
					<div class="table-responsive-sm">
						<table class="table table-bordered table-striped w-100 text-center tbl-sm" id="myTable">
							<thead class="w-100">
								<tr>
									<th>No.</th>
									<th><em>Clean Text</em></th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($_SESSION['stemming'] as $index => $value) {
										echo '
											<tr>
												<td>'. (++$index) .'</td>
												<td class="text-justify">'. $value .'</td>
												<td>
													<button type="button" class="btn btn-info mx-1" data-toggle="modal" data-target="#detailPreprocessingModal'. --$index .'"><i class="fa fa-search-plus"></i> Detail</button>
												</td>
											</tr>
										';

										// Modal Detail Preprocessing
										echo '
											<div class="modal fade" id="detailPreprocessingModal'. $index .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-lg">
													<div class="modal-content text-left">
														<div class="modal-header">
															<h5 class="modal-title">Detail <em>Preprocessing</em></h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="container px-5 py-4 w-100">
															<h6>1. &nbsp;Teks awal</h6>
															<p class="ml-4">'. $_SESSION['text_awal'][$index] .'</p>
															<hr>
															<h6>2. &nbsp;<em>Casefolding</em></h6>
															<p class="ml-4">'. $_SESSION['casefolding'][$index] .'</p>
															<hr>
															<h6>3. &nbsp;<em>Cleaning</em> (Menghapus email, URL, mention, selain huruf, huruf tunggal)</h6>
															<p class="ml-4">'. $_SESSION['cleaning'][$index] .'</p>
															<hr>
															<h6>4. &nbsp;Menghapus <em>Stopword</em></h6>
															<p class="ml-4">'. $_SESSION['stopword'][$index] .'</p>
															<hr>
															<h6>5. &nbsp;<em>Stemming</em></h6>
															<p class="ml-4">'. $value .'</p>
														</div>
													</div>
												</div>
											</div>
										';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-md-12 text-center">
					<a href="index.php?hal=preprocessing" class="btn btn-info w-50" ><i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php		
	}
	else {
		header('location: index.php?hal=preprocessing');
	}
?>