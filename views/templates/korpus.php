<div class="jumbotron">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="bs-callout bs-callout-primary mt-0">
				<h4>Ekstraksi Fitur</h4>
				<p>Membuat Ekstraksi Fitur dari data yang tersedia dalam basis data.</p>
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

				<div class="col-md-12 text-center mb-4">
					<button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal" data-target="#korpusModal"><i class="fa fa-cogs"></i> Lakukan Ektrasi Fitur</button>

					<!-- Modal PROSES korpus -->
					<div class="modal fade" id="korpusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content text-left">
								<div class="modal-header">
									<h5 class="modal-title">Ekstraksi Fitur</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="../controllers/korpus_add.php" method="POST">
									<div class="text-center">
										<p class="my-4">Lakukan proses Ekstraksi Fitur pada seluruh <em>dataset</em>?</p>
									</div>
									<div class="modal-footer">
										<input type="hidden" name="korpus" value="1" required readonly />
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary">Ya, mulai</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 mb-4">
						<div class="table-responsive-sm">
							<table class="table table-bordered table-striped w-100 text-center" id="myTable">
								<thead class="w-100">
									<tr>
										<th>No.</th>
										<th><em>Name</em></th>
										<th>Total Data</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include_once '../models/model_data.php';
										$model_data   = new ModelData();
										$data = $model_data->getAll();

										foreach($data as $index => $value) {
											echo '
												<tr>
													<td>'. (++$index) .'</td>
													<td>'. $value['model_name'] .'</td>
													<td>'. $value['clustering_count'] .'</td>
													<td>
														<button class="btn btn-danger m-1" data-toggle="modal" data-target="#modelingDeleteModal'. $index .'"><i class="fa fa-trash"></i></button>
													</td>
												</tr>
											';

											// DELETE MODAL
											echo '
												<div class="modal fade" tabindex="-1" id="modelingDeleteModal'. $index .'" >
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">Hapus Data</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<form action="../controllers/model_delete.php" method="POST">
																<div class="text-center">
																	<p class="my-4">Apakah Anda yakin ingin menghapus data nomor '. $index .'?</p>
																</div>
																<div class="modal-footer">
																	<input type="hidden" name="id" value="'. $value['id'] .'" required readonly />
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
																	<button type="submit" class="btn btn-primary">Hapus</button>
																</div>
															</form>
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
				</div>
			</div>
		</div>
	</div>
</div>