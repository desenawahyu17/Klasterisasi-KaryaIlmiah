<div class="jumbotron">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="bs-callout bs-callout-primary mt-0">
				<h4><em>Stopword</em></h4>
				<p>Daftar Kata <em>Stopword</em> yang dianggap kurang penting dalam proses klasterisasi.</p>
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

				<div class="col-md-12 text-center mb-4">
					<button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal" data-target="#stopwordTambahModal"><i class="fa fa-plus"></i> Tambah Data</button>
					<em>atau</em>
					<button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal" data-target="#stopwordImportModal"><i class="fa fa-plus"></i> Import Data</button>
					
					<!-- Modal Tambah -->
					<div class="modal fade" tabindex="-1" id="stopwordTambahModal" >
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Tambah Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="../controllers/stopword_add.php" method="POST">
									<div class="modal-body">
										<div class="form-group px-4 text-left">
											<label><em>Stopword</em></label>
											<input type="text" name="stopword" placeholder="Misal: yang" class="form-control" required />
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-primary">Tambah</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Import -->
					<div class="modal fade" id="stopwordImportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content text-left">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Import Data <em>(Excel)</em></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="../controllers/stopword_import.php" method="POST" enctype="multipart/form-data">
									<div class="modal-body px-5">
										<label>File <em>Excel</em> <small>(.xlsx)</small></label>
										<div class="custom-file">
											<input type="file" name="excel_file" class="custom-file-input" id="customFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
											<label class="custom-file-label" for="customFile">Pilih File Excel</label>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-primary"><em>Import</em></button>
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
									<th><em>Stopword</em></th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include_once '../models/stopword.php';
									$stopword   = new Stopword();
									$data = $stopword->getAll();

									foreach($data as $index => $value) {
										echo '
											<tr>
												<td>'. (++$index) .'</td>
												<td>'. $value['stopword'] .'</td>
												<td>
													<button class="btn btn-warning text-white m-1" data-toggle="modal" data-target="#stopwordEditModal'. $index .'"><i class="fa fa-pencil"></i></button>
													<button class="btn btn-danger m-1" data-toggle="modal" data-target="#stopwordDeleteModal'. $index .'"><i class="fa fa-trash"></i></button>
												</td>
											</tr>
										';

										// EDIT MODAL
										echo '
											<div class="modal fade" tabindex="-1" id="stopwordEditModal'. $index .'" >
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Ubah Data</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<form action="../controllers/stopword_update.php" method="POST">
															<div class="modal-body">
																<div class="form-group px-4 text-left">
																	<label><em>Stopword</em></label>
																	<input type="text" name="stopword" placeholder="Misal: yang" value="'. $value['stopword'] .'" class="form-control" required />
																	<input type="hidden" name="id" value="'. $value['id'] .'" required readonly />
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
																<button type="submit" class="btn btn-primary">Simpan</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										';
										
										// DELETE MODAL
										echo '
											<div class="modal fade" tabindex="-1" id="stopwordDeleteModal'. $index .'" >
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Hapus Data</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<form action="../controllers/stopword_delete.php" method="POST">
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