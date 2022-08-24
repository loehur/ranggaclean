<?php require_once("data_produk.php"); ?>

<div>
	<div class="d-flex pb-0 mb-2">
		<div class="mr-auto">
			<h5>Service AC</h5>
		</div>
		<div class=""><input class="float-right form form-control form-control-sm" name="search_main" placeholder="search..." /></div>
	</div>

	<div class="row p-1">
		<?php
		$counts = array_count_values(array_column($list_produk, 'kategori'));

		foreach ($kategori_list as $kl_key => $kl) {
			$count_kategori = $counts[$kl];
			if ($count_kategori > 1) { ?>
				<div style="max-width:50%" class="gridcol col-sm-3 p-1 m-0">
					<div id="carouselExampleControls<?= $kl_key ?>" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php
							$no = 0;
							foreach ($list_produk as $lp_key => $lp) {
								$kategori = $lp['kategori'];
								if ($kategori == $kl) {
									$no++;
									$title = $lp['title'];
									$price = $lp['price'];
									$detail = $lp['detail'];
									$img = $lp['img'];
									$active = "";
									if ($no == 1) {
										$active = "active";
									}
							?>
									<div class="carousel-item <?= $active ?>">
										<div class="card p-0" style="max-width:100%">
											<img class="card-img-top" src="<?= $this->ASSETS_URL ?>products/service_ac/<?= $img ?>.jpeg" alt="">
											<div class="card-body p-2">
												<div class="row">
													<div class="col w-auto mb-1">
														<span class="text-info h7"><?= $title ?></span>
													</div>
												</div>
												<div class="row mb-1">
													<div class="col w-auto">
														<span class="bg-success font-weight-bold text-light pr-1 pl-1 rounded">Rp<?= number_format($price) ?></span>
													</div>
													<div class="col w-auto">
														<a class="p-0 float-right mr-3 pr-1 pl-1" style="cursor: pointer;" data-toggle="collapse" data-target="#collaps<?= $lp_key ?>" role="button" aria-expanded="false" aria-controls="collaps<?= $lp_key ?>">
															Detail
														</a>
													</div>
												</div>
												<div class="row">
													<div class="col w-100">
														<div class="collapse" id="collaps<?= $lp_key ?>">
															<div class="card card-body p-1">
																<?= $detail ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							<?php }
							} ?>
						</div>
						<span class="carousel-control-prev" type="button" data-target="#carouselExampleControls<?= $kl_key ?>" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</span>
						<span class="carousel-control-next" type="button" data-target="#carouselExampleControls<?= $kl_key ?>" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</span>
					</div>
				</div>
				<?php } else {
				foreach ($list_produk as $lp) {
					$kategori = $lp['kategori'];
					if ($kategori == $kl) {
						$title = $lp['title'];
						$price = $lp['price'];
						$detail = $lp['detail'];
						$img = $lp['img'];
				?>
						<div style="max-width:50%" class="gridcol col-sm-3 p-1 m-0">
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
											<span class="bg-success font-weight-bold text-light pr-1 pl-1 rounded">Rp<?= number_format($price) ?></span>
										</div>
										<div class="col w-auto">
											<a class="p-0 float-right mr-3 pr-1 pl-1" style="cursor: pointer;" data-toggle="collapse" data-target="#collaps<?= $lp_key ?>" role="button" aria-expanded="false" aria-controls="collaps<?= $lp_key ?>">
												Detail
											</a>
										</div>
									</div>
									<div class="row">
										<div class="col w-100">
											<div class="collapse" id="collaps<?= $lp_key ?>">
												<div class="card card-body p-1">
													<?= $detail ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
		<?php }
				}
			}
		} ?>
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