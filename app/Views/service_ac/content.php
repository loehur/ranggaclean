	<div>

		<div class="d-flex pb-0 mb-2">
			<div class="mr-auto">
				<h5>Service AC</h5>
			</div>
			<div class=""><input class="float-right form form-control form-control-sm" name="search_main" placeholder="search..." /></div>
		</div>

		<?php
		$col_class = "gridcol col-sm-3 p-1 m-0";
		$style_card = "max-width:100%";
		$style_col = "max-width:50%";
		?>

		<div class="row p-1">
			<?php
			for ($x = 1; $x <= 16; $x++) {
				$title = "Null";
				$price = 0;
				$detail = "No Detail";
				$img = 0;

				switch ($x) {
					case 1:
						$title = "Cuci AC split 0,5 PK - 2 PK";
						$price = "70,000";
						$img = 1;
						break;
					case 2:
						$title = "Cuci AC Cassette/Ceiling 3 PK";
						$price = "200,000";
						$img = 1;
						break;
					case 3:
						$title = "Cek Kerusakan AC";
						$price = "65,000";
						$img = 3;
						break;
					case 4:
						$title = "Tambah Freon 0,5 PK - 1 PK R22";
						$price = "150,000";
						$img = 2;
						break;
					case 5:
						$title = "Tambah Freon 0,5 PK R32 - R410";
						$price = "200,000";
						$img = 2;
						break;
					case 6:
						$title = "Isi Ulang Freon 1 PK R22";
						$price = "250,000";
						$img = 2;
						break;
					case 7:
						$title = "Isi Ulang Freon 1 PK R32 - R410";
						$price = "325,000";
						$img = 2;
						break;
					case 8:
						$title = "Isi Ulang Freon 2 PK R22";
						$price = "275,000";
						$img = 2;
						break;
					case 9:
						$title = "Isi Ulang Freon 2 PK R32 - R410";
						$price = "350,000";
						$img = 2;
						break;
					case 10:
						$title = "Bongkar  AC 0,5 PK - 1 PK";
						$price = "100,000";
						$img = 4;
						break;
					case 11:
						$title = "Pasang AC 1 PK";
						$price = "250,000";
						$img = 4;
						break;
					case 12:
						$title = "Bongkar  AC 1.5 PK - 2PK";
						$price = "150,000";
						$img = 4;
						break;
					case 13:
						$title = "Pasang AC 1,5 PK - 2 PK";
						$price = "275,000";
						$img = 4;
						break;
					case 14:
						$title = "Bongkar Pasang 0,5 PK - 1 PK";
						$price = "350,000";
						$img = 4;
						break;
					case 15:
						$title = "Bongkar Pasang 1,5 PK - 2 PK";
						$price = "375,000";
						$img = 4;
						break;
					case 16:
						$title = "Penggantian Capasitor 0,5 - 1 PK";
						$price = "225,000";
						$img = 5;
						break;
				}
			?>
				<div style="<?= $style_col ?>" class="<?= $col_class ?>">
					<div class="card p-0" style="<?= $style_card ?>">
						<img class="card-img-top" src="<?= $this->ASSETS_URL ?>products/service_ac/<?= $img ?>.jpeg" alt="">
						<div class="card-body p-2">
							<div class="row">
								<div class="col w-auto mb-1">
									<span class="text-info h7"><?= $title ?></span>
								</div>
							</div>
							<div class="row mb-1">
								<div class="col w-auto">
									<span class="bg-success font-weight-bold text-light pr-1 pl-1 rounded">Rp<?= $price ?></span>
								</div>
							</div>
							<hr class="p-0 mt-2 mb-2">
							<div class="row mt-1">
								<div class="col">
									<a class="p-0 pr-1 pl-1 btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#collaps<?= $x ?>" role="button" aria-expanded="false" aria-controls="collaps<?= $x ?>">
										Detail
									</a>
									<div class="collapse pt-2" id="collaps<?= $x ?>">
										<div class="card card-body p-1">
											<?= $detail ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>

	<script src="<?= $this->ASSETS_URL ?>plugins/jquery/jquery.min.js"></script>

	<script src="<?= $this->ASSETS_URL ?>js/jquery.slim.min-3.5.1.js"></script>
	<script src="<?= $this->ASSETS_URL ?>js/bootstrap.bundle.min-4.6.2.js"></script>
	<script>
		$(document).ready(function() {
			setGrid();
		});

		$(window).on('resize', function() {
			setGrid();
		});

		function setGrid() {
			if ($(window).width() > 400) {
				$('.gridcol').removeClass('col-sm-6');
				$('.gridcol').addClass('col-sm-3');
			} else {
				$('.gridcol').removeClass('col-sm-3');
				$('.gridcol').addClass('col-sm-6');
			}
		}
	</script>