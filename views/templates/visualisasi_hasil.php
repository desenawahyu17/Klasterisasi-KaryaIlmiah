<div class="jumbotron">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="bs-callout bs-callout-primary mt-0">
				<h4>Visualisasi Data</h4>
				<p>Menampilkan data dari hasil penelitian.</p>
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
		</div>
	</div>
</div>