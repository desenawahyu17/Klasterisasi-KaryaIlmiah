<div class="jumbotron">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="bs-callout bs-callout-primary mt-0">
                <h4><em>Preprocessing</em></h4>
                <p>Daftar data hasil <em>Preprocessing</em> yang tersedia dalam basis data.</p>
            </div>
            <div class="row">

                <div class="col-md-12 text-center mb-4">
                    <button type="button" class="btn btn-success w-25 mx-1" data-toggle="modal"
                        data-target="#preprocessingModal"><i class="fa fa-gear"></i> Lakukan Preprocessing</button>

                    <!-- Modal PROSES preprocessing -->
                    <div class="modal fade" id="preprocessingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content text-left">
                                <div class="modal-header">
                                    <h5 class="modal-title">Proses <em>Preprocessing</em></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controllers/preprocessing_add.php" method="POST">
                                    <div class="text-center">
                                        <p class="my-4">Lakukan proses <em>preprocessing</em> pada seluruh
                                            <em>dataset</em>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="preprocessing" value="1" required readonly />
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya, mulai</button>
                                    </div>
                                </form>
                            </div>
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
                                    <th><em>Clean Text</em></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									include_once '../models/preprocessing.php';
									$preprocessing   = new Preprocessing();
									$data = $preprocessing->getAll();

									foreach($data as $index => $value) {
										echo '
											<tr>
												<td>'. (++$index) .'</td>
												<td class="text-left" width="20%">'. $value['dokumen_name'] .'</td>
												<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">'. $value['dokumen_text'] .'</textarea></td>
												<td><textarea style="border: none; background-color: transparent; resize: none; outline: none;" disabled class="form-control text-justify" rows="7" cols="150">'. $value['clean_text'] .'</textarea></td>
											</tr>
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