<body class="skin-red-dark fixed-layout">
	<div class="preloader">
		<div class="loader">
			<div class="loader__figure"></div>
			<p class="loader__label">Tunggu Sebentar</p>
		</div>
	</div>
	<div id="main-wrapper">
		<header class="topbar">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?= base_url() ?>">
						<img src="<?= base_url('assets/images/') . $logo . '?' . time() ?>" alt="homepage" width="40px" class="light-logo" />
						<span>
							<img src="<?= base_url('assets/images/') . $logo_text . '?' . time() ?>" width="150px" class="light-logo" alt="homepage" />
						</span>
					</a>
				</div>
				<div class="navbar-collapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-align-justify"></i></a> </li>
						<?php if ($this->agent->is_browser()) { ?>
							<li class="nav-item my-auto pt-1">
								<h3 class="text-white" style="overflow-wrap: normal"><?= $nama_aplikasi ?></h3>
							</li>
						<?php } ?>
					</ul>

				</div>
			</nav>
		</header>