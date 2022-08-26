	<div class="d-flex pb-0 mb-0 fixed-top bg-light mr-auto ml-auto" style="max-width: 750px;min-width: <?= $min_width ?>;">
		<div class="mr-auto pt-0 pb-2"><a href="#" class="nav-link text-dark text-nowrap">
				<img src="<?= $this->ASSETS_URL ?>img/logo/logo.png" width="110px">
			</a></div>
		<div class="pt-3"><input class="float-right form form-control form-control-sm" name="search_main" placeholder="search..." /></div>
		<div class="pt-3"><a href="#" class="nav-link text-dark text-nowrap">
				<h5 class="float-right"><i class="fas fa-user"></i></h5>
			</a></div>
	</div>

	<nav class="navbar navbar-dark bg-light navbar-expand mr-auto ml-auto border-bottom p-0 fixed-top" style="margin-top: 70px;max-width: 750px;min-width: <?= $min_width ?>;">
		<ul class="navbar-nav nav-justified w-100">
			<li class="nav-item">
				<a href="<?= $this->BASE_URL ?>Home" class="nav-link text-secondary text-nowrap">
					<i class="fas fa-toolbox"></i><br>Service AC
				</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link text-secondary text-nowrap"><i class="fas fa-hands-wash"></i><br>Housekeeping</a>
			</li>
			<li class="nav-item">
				<a href="<?= $this->BASE_URL ?>Payment" class="nav-link text-secondary text-nowrap"><i class="fas fa-money-check"></i><br>Payment</a>
			</li>
			<li class="nav-item d-none">
				<a href="#" class="nav-link text-secondary text-nowrap"><i class="fas fa-id-card-alt"></i><br>Outsourcing</a>
			</li>
		</ul>
	</nav>