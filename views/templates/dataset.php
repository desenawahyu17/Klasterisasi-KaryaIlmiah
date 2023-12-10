<div class="jumbotron">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="bs-callout bs-callout-primary mt-0">
                <h4><em>Dataset</em></h4>
                <p>Daftar <em>Dataset</em> yang tersedia dalam basis data.</p>
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
					if(isset($_SESSION['info_message'])) {echo '
						<div class="alert alert-primary alert-dismissible fade show w-100" role="alert">
							'. $_SESSION['info_message'] .'
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					}
				?>

                <div class="col-md-12 text-center mb-4">
                    <button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal"
                        data-target="#datasetImportModal"><i class="fa fa-plus"></i> Import Data</button>
                    <button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal"
                        data-target="#datasetTambahModal"><i class="fa fa-plus"></i> Tambah Data</button>
                    <!-- Modal Import -->
                    <div class="modal fade" id="datasetImportModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content text-left">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Data <em>(PDF)</em></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controllers/dataset_import.php" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="modal-body px-5">
                                        <label>File <em>PDF</em> <small>(.pdf)</small></label>
                                        <div class="custom-file">
                                            <input type="file" name="pdf_file[]" class="custom-file-input"
                                                id="customFile" accept=".pdf" required multiple>
                                            <label class="custom-file-label" for="customFile">Pilih File .PDF</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary"
                                            name="btnImport"><em>Import</em></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Tambah -->
                <div class="modal fade" tabindex="-1" id="datasetTambahModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="../controllers/dataset_add.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group px-4 text-left">
                                        <label>Judul</label>
                                        <input type="text" name="dokumen_name" placeholder="Masukan Judul"
                                            class="form-control" required />
                                    </div>
                                    <div class="form-group px-4 text-left">
                                        <label>Teks</label>
                                        <textarea type="text" rows="8" name="dokumen_text"
                                            placeholder="Masukan Isi Teks" class="form-control" required>
										</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary"
                                        name="datasetTambahModal">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-striped w-100 text-center tbl-sm" id="myTable">
                            <thead class="w-100">
                                <tr>
                                    <th>No.</th>
                                    <th><em>Name</em></th>
                                    <th><em>Text</em></th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									include_once '../models/dataset.php';
									$dataset   = new Dataset();
									$data = $dataset->getAll();

									foreach($data as $index => $value) {

										echo '
											<tr>
												<td>'. (++$index) .'</td>
												<td class="text-left" width="20%">'. $value['dokumen_name'] .'</td>
												<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control" rows="7" cols="150">'. $value['dokumen_text'] .'</textarea>
                                        </td>
                                        <td><button class="btn btn-danger m-1" data-toggle="modal"
                                                data-target="#deleteModal'. $index .'"><i
                                                    class="fa fa-trash"></i></button></td>
                                        </tr>
                                        ';
                                        // DELETE MODAL
                                        echo '
                                        <div class="modal fade" tabindex="-1" id="deleteModal'. $index .'">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="../controllers/dataset_delete.php" method="POST">
                                                        <div class="text-center">
                                                            <p class="my-4">Apakah Anda yakin ingin menghapus data no '.
                                                                $index .'dengan name '. $value['dokumen_name'] .'?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="'. $value['id'] .'"
                                                                required readonly />
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
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