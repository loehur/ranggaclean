	<div>
		<div class="d-flex pb-0 mb-2">
			<div class="mr-auto">
				<h5>Payment</h5>
			</div>
		</div>

		<div id="accordion">
			<div class="card mb-1">
				<div class="card-header collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" id="headingOne">
					<h5 class="mb-0">
						<span class="btn text-primary">
							Transfer BCA
						</span>
					</h5>
				</div>
				<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col">
								No. Rekening<br>
								<span class="text-danger h6" id="norek">5055055758</span>
								<span class="text-info h6 float-right clip" style="cursor: pointer;" onclick="copyToClipboard('#norek')">SALIN</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-1">
				<div class="card-header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="headingTwo">
					<h5 class="mb-0">
						<span class="btn text-primary">
							QR Code
						</span>
					</h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 pb-2">
								<img src="<?= $this->ASSETS_URL ?>img/payment/qr_bca.jpeg" width="100%">
							</div>
							<div class="col-sm-6">
								<img src="<?= $this->ASSETS_URL ?>img/payment/qr_ovo.jpeg" width="100%">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-1">
				<div class="card-header collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="headingThree">
					<h5 class="mb-0">
						<span class="btn text-primary">
							Virtual Account
						</span>
					</h5>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col">
								Gopay VA<br>
								<span class="text-danger h6" id="gopayVA">70001085923704817</span>
								<span class="text-info h6 float-right clip" style="cursor: pointer;" onclick="copyToClipboard('#gopayVA')">SALIN</span>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col">
								Shopee VA<br>
								<span class="text-danger h6" id="shopeeVA">122085923704817</span>
								<span class="text-info h6 float-right clip" style="cursor: pointer;" onclick="copyToClipboard('#shopeeVA')">SALIN</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<script src="<?= $this->ASSETS_URL ?>plugins/jquery/jquery.min.js"></script>
	<script src="<?= $this->ASSETS_URL ?>js/bootstrap.min.js"></script>
	<script>
		function copyToClipboard(element) {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($(element).text()).select();
			var textCopied = ($temp.val());
			document.execCommand("copy");
			$temp.remove();
		}

		$(".clip").click(function() {
			$(this).hide();
			$(this).html('TERSALIN!');
			$(this).fadeIn('slow');
		})

		$('#accordion').on('hidden.bs.collapse', function() {
			$(".clip").html('SALIN');
		})
	</script>