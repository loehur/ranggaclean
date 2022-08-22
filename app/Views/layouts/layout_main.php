<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset=" UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?= $this->ASSETS_URL ?>icon/icon.png">
	<title>CleaningKlin</title>
	<link rel="stylesheet" href="<?= $this->ASSETS_URL ?>plugins/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= $this->ASSETS_URL ?>/css/bootstrap-4.3.1.min.css">

	<script src="<?= $this->ASSETS_URL ?>plugins/adminLTE-3.1.0/jquery/jquery.min.js"></script>
	<script src="<?= $this->ASSETS_URL ?>plugins/adminLTE-3.1.0/bootstrap/js/bootstrap.bundle.min.js"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
	<!-- FONT -->

	<?php $fontStyle = "'Titillium Web', sans-serif;" ?>

	<style>
		html .table {
			font-family: <?= $fontStyle ?>;
		}

		html .content {
			font-family: <?= $fontStyle ?>;
		}

		html body {
			font-family: <?= $fontStyle ?>;
		}

		@media print {
			p div {
				font-family: <?= $fontStyle ?>;
				font-size: 14px;
			}
		}
	</style>
</head>

<body style="max-width: 750px;" class="m-auto small">

	<?php require_once("nav_top.php"); ?>

	<div class="container py-3">
		<div class="d-flex pb-0 mb-3">
			<div class="mr-auto">
				<h5>Service AC</h5>
			</div>
			<div class=""><input class="float-right form form-control form-control-sm" name="search_main" placeholder="search..." /></div>
		</div>

		<?php
		$col_class = "col p-1 m-0 w-auto";
		$style_card = "max-width:100%; min-width:10rem";
		?>

		<div class="row">
			<div class="<?= $col_class ?>">
				<div class="card p-0" style="<?= $style_card ?>">
					<img class="card-img-top" src="<?= $this->ASSETS_URL ?>products/service_ac/1.jpeg" alt="">
					<div class="card-body p-2">
						<div class="row">
							<div class="col w-auto mb-1">
								<span class="font-weight-bold text-info h6">Cuci AC 0.5 PK</span>
							</div>
						</div>
						<div class="row">
							<div class="col w-auto">
								<span class="bg-success font-weight-bold text-light pr-1 pl-1 rounded">Rp70,000</span>
							</div>
						</div>
						<hr class="p-0 mt-2 mb-2">
						<div class="row mt-1">
							<div class="col">
								<a class="p-0 pr-1 pl-1 btn btn-sm btn-outline-primary" data-toggle="collapse" href="#collaps1" role="button" aria-expanded="false" aria-controls="collaps1">
									Detail
								</a>
								<div class="collapse pt-2" id="collaps1">
									<div class="card card-body p-1">
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="<?= $col_class ?>">
				<div class="card p-0" style="<?= $style_card ?>">
					<img class="card-img-top" src="<?= $this->ASSETS_URL ?>products/service_ac/2.jpeg" alt="">
					<div class="card-body p-2">
						<div class="row">
							<div class="col w-auto mb-1">
								<span class="font-weight-bold text-info h6">Tambah freon R 22 0.5 PK- 1PK</span>
							</div>
						</div>
						<div class="row">
							<div class="col w-auto">
								<span class="bg-success font-weight-bold text-light pr-1 pl-1 rounded">Rp150,000</span>
							</div>
						</div>
						<hr class="p-0 mt-2 mb-2">
						<div class="row mt-1">
							<div class="col">
								<a class="p-0 pr-1 pl-1 btn btn-sm btn-outline-primary" data-toggle="collapse" href="#collaps2" role="button" aria-expanded="false" aria-controls="collaps2">
									Detail
								</a>
								<div class="collapse pt-2" id="collaps2">
									<div class="card card-body p-1">
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php require_once("nav_bot.php"); ?>
</body>

</html>