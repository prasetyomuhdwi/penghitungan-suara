<aside class="left-sidebar">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li>
					<a class="waves-effect waves-dark" href="<?= base_url('dashboard') ?>" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Dashboard</span></a>
				</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-list-ul"></i><span class="hide-menu">Data</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('suara-masuk') ?>">Suara Masuk</a></li>
						<li><a href="<?= base_url('tps/belum-input') ?>">TPS Belum Input</a></li>
					</ul>
				</li>

				<?php if ($this->session->userdata('role') == 0) { ?>
					<!-- <li>
						<a class="waves-effect waves-dark" href="<?= base_url('aktivitas') ?>" aria-expanded="false"><i class="fa fa-refresh"></i><span class="hide-menu">Aktivitas</span></a>
					</li> -->
					<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-gears"></i><span class="hide-menu">Pengaturan</span></a>
						<ul aria-expanded="false" class="collapse">
							<li><a href="<?= base_url('paslon') ?>">Paslon</a></li>
							<li><a href="<?= base_url('kecamatan') ?>">Wilayah</a></li>
							<li><a href="<?= base_url('pengaturan') ?>">Aplikasi</a></li>
						</ul>
					</li>
				<?php } ?>
				<hr>
				<li>
					<a class="waves-effect waves-dark logout" href="<?= base_url('auth/logout') ?>" aria-expanded="false"><i class="fa fa-power-off"></i><span class="hide-menu"> Logout</span></a>
				</li>
			</ul>
		</nav>
	</div>
</aside>
<!-- ============================================================== -->