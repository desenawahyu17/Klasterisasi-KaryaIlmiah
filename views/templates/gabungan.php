<div class="jumbotron">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="bs-callout bs-callout-primary mt-0">
				<h4>Metode Gabungan</h4>
				<p>Proses pengujian dengan mengkombinasi metode <em>Complete Linkage</em> dan <em>k-means</em>.</p>
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
			</div>
			<div class="row">
				<?php
					include_once '../models/model_data.php';
					$model_data   = new ModelData();
					$data = $model_data->getAll();
				?>
				<div class="col-md-12 text-center mb-4">
					<button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal" data-target="#gabunganModal"><i class="fa fa-users"></i> Pengujian dengan mengkombinasi metode</button>

					<!-- Modal PROSES Gabungan -->
					<div class="modal fade" id="gabunganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content text-left">
								<div class="modal-header">
									<h5 class="modal-title">Metode Gabungan</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="../controllers/gabungan_add.php" method="POST">
									<div class="modal-body px-5 py-3">
										<label class="text-muted mb-0 text-justify">Pengujian terhadap <em>model</em> dengan mengkombinasi metode  <span class="h6"><em>Complete Linkage</em> dan <em>K-Means</em></label>
										<br />
										<div class="container-fuild text-left mt-3">
											<label class="text-muted mt-2">Nama <em>Model</em></label>
											<select class="custom-select" name="id" id="model-evaluasi">
												<option value="" selected disabled>Pilih Model data</option>
												<?php
												foreach($data as $index => $value) {
													echo '
													<option value="'. $value['id'] .'">'. $value['model_name'] .' ('.$value['clustering_count'].' data)</option>
													';
												}
												?>
											</select>
											<small class="text-info ml-1 d-none fadeIn" id="validasi_model_uji">
												<i class="fa fa-info-circle"></i> Pilih <em>Model</em> uji untuk digunakan terlebih dahulu
											</small>
											<label class="text-muted mt-2" id="komposisi-model"></label>
										</div>
									</div>
									<div class="modal-footer">
										<input type="hidden" name="gabungan" value="1" required readonly />
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary">Ya, mulai</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>