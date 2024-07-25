<div id="refresh">
	<!-- ============================================================== -->
	<!-- Page wrapper  -->
	<!-- ============================================================== -->
	<div class="page-wrapper">
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="row mt-3">
				<div class="col-lg-6">
					<div class="row">
						<?php $i = 0; ?>
						<?php foreach ($hasil_sah as $h) : ?>
							<div class="col-md-6">
								<div class="card">
									<div class="row">
										<div class="col-12">
											<div class="social-widget">
												<div class="soc-header <?= $color[$i] ?>">
													<h2><?= $h['no_urut'] ?></h2>
													<div class="col-sm-7 mx-auto my-1">
														<img class="img-fluid bg-white rounded" src="<?= file_exists(base_url('assets/images/paslon/') . $paslon[$i]['foto']) ? base_url('assets/images/paslon/') . $paslon[$i]['foto'] : base_url('assets/images/paslon/default.png') ?>" alt="default.png">
													</div>
													<h3><?= $h['nama'] ?></h3>
												</div>
												<div class="soc-content">
													<div class="col-6 b-r">
														<h3 class="font-medium"><?= number_format($h['jml_suara'], 0, "", ".") ?></h3>
														<h5 class="text-muted">Suara</h5>
													</div>
													<div class="col-6">
														<?php if ($total_sah == 0) { ?>
															<h3 class="font-medium text-danger">0%</h3>
														<?php } else { ?>
															<h3 class="font-medium text-danger"><?= round($h['jml_suara'] / $total_sah * 100, 2) ?>%</h3>
														<?php } ?>
														<h5 class="text-muted">Suara</h5>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php $i++ ?>
						<?php endforeach ?>
						<div class="col-md-12">
							<div class="card">
								<div class="row">
									<div class="col-12">
										<div class="social-widget">
											<div class="soc-header bg-warning">
												<h3>Suara Masuk</h3>
											</div>
											<div class="soc-content">
												<div class="col-6 b-r">
													<h5 class="text-muted">Suara Sah</h5>
													<h3 class="font-medium"><?= number_format($total_sah, 0, "", ".") ?></h3>
													<?php if ($total == 0) { ?>
														<h3 class="font-medium text-danger">0%</h3>
													<?php } else { ?>
														<h3 class="font-medium text-danger"><?= round($total_sah / $total * 100, 2) ?>%</h3>
													<?php } ?>
												</div>
												<div class="col-6">
													<h5 class="text-muted">Suara Tidak Sah</h5>
													<h3 class="font-medium"><?= number_format($hasil_tidak_sah, 0, "", ".") ?></h3>
													<?php if ($total == 0) { ?>
														<h3 class="font-medium text-danger">0%</h3>
													<?php } else { ?>
														<h3 class="font-medium text-danger"><?= round($hasil_tidak_sah / $total * 100, 2) ?>%</h3>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card">
								<div class="row">
									<div class="col-12">
										<div class="social-widget">
											<div class="soc-header bg-success">
												<h3>Partisipasi</h3>
											</div>
											<div class="soc-content">
												<div class="col-6 b-r">
													<h5 class="text-muted">Pengguna Hak Pilih</h5>
													<h3 class="font-medium"><?= number_format($total, 0, "", ".") ?></h3>
													<?php if ($dpt == 0) { ?>
														<h3 class="font-medium text-danger">0%</h3>
													<?php } else { ?>
														<h3 class="font-medium text-danger"><?= round($total / $dpt * 100, 2) ?>%</h3>
													<?php } ?>
												</div>
												<div class="col-6">
													<h5 class="text-muted">Jumlah Hak Pilih</h5>
													<h3 class="font-medium"><?= number_format($dpt, 0, "", ".") ?></h3>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title text-center">Perolehan Suara</h3>
							<div>
								<canvas id="myChart" height="250px"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Page Content -->
			<!-- ============================================================== -->

			<div class="row">
				<!-- Column -->
				<div class="col-md-2">
					<div class="card">
						<div class="box bg-info text-center">
							<h1 class="font-light text-white"><?= $kecamatan_count ?></h1>
							<h4 class="text-white">Kecamatan</h4>
						</div>
					</div>
				</div>
				<!-- Column -->
				<div class="col-md-2">
					<div class="card">
						<div class="box bg-primary text-center">
							<h1 class="font-light text-white"><?= $desa_count ?></h1>
							<h4 class="text-white">Desa</h4>
						</div>
					</div>
				</div>
				<!-- Column -->
				<div class="col-md-2">
					<div class="card">
						<div class="box bg-success text-center">
							<h1 class="font-light text-white"><?= $tps_count ?></h1>
							<h4 class="text-white">TPS</h4>
						</div>
					</div>
				</div>
				<!-- Column -->
				<div class="col-md-3">
					<div class="card">
						<div class="box bg-warning text-center">
							<div class="row">
								<div class="col-sm-6">
									<h1 class="font-light text-white"><?= $tps_input ?></h1>
								</div>
								<div class="col-sm-6">
									<h1 class="font-light text-white"><?= round($tps_input / $tps_count * 100, 2) ?>%</h1>
								</div>
							</div>
							<div class="col-sm-12">
								<h4 class="text-white">TPS Sudah Input</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Column -->
				<div class="col-md-3">
					<div class="card">
						<div class="box bg-megna text-center">
							<div class="row">
								<div class="col-sm-6">
									<h1 class="font-light text-white"><?= $tps_count - $tps_input ?></h1>
								</div>
								<div class="col-sm-6">
									<h1 class="font-light text-white"><?= round(($tps_count - $tps_input) / $tps_count * 100, 2) ?>%</h1>
								</div>
							</div>
							<div class="col-sm-12">
								<h4 class="text-white">TPS Belum Input</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Column -->
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card border-primary">
						<div class="card-header bg-primary">
							<h3 class="m-b-0 text-white text-center">Cetak Laporan</h3>
						</div>
						<div class="card-group">
							<!-- Column -->
							<!-- <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="text-center">Perolehan Suara</h4>
                                </div>
                                <div class="box b-t text-center">
                                    <a href="<?= base_url('cetak/total/I') ?>" class="btn btn-warning"><i class="fa fa-search"></i> Preview</a>
                                </div>
                                <div class="box b-t text-center">
                                    <a href="<?= base_url('cetak/total/D') ?>" class="btn btn-success"><i class="fa fa-print"></i> Save & Print</a>
                                </div>
                            </div> -->
							<!-- Column -->
							<!-- Column -->
							<div class="card">
								<div class="card-body text-center">
									<h4 class="text-center">Rekapitulasi Total</h4>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-warning" onclick=" window.open('<?= base_url('cetak/kabupaten') ?>','_blank')"><i class="fa fa-search"></i> Preview</button>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-success" onclick=" window.open('<?= base_url('cetak/kabupaten?type=D') ?>','_blank')"><i class="fa fa-print"></i> Save & Print</button>
								</div>
							</div>
							<!-- Column -->
							<!-- Column -->
							<div class="card">
								<div class="card-body text-center">
									<h4 class="text-center">Rekapitulkasi Per Kecamatan</h4>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-warning" onclick=" window.open('<?= base_url('cetak/kecamatan') ?>','_blank')"><i class="fa fa-search"></i> Preview</button>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-success" onclick=" window.open('<?= base_url('cetak/kecamatan?type=D') ?>','_blank')"><i class="fa fa-print"></i> Save & Print</button>
								</div>
							</div>
							<!-- Column -->
							<!-- Column -->
							<div class="card">
								<div class="card-body text-center">
									<h4 class="text-center">Rekapitulasi Per Desa</h4>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-warning" onclick=" window.open('<?= base_url('cetak/desa') ?>','_blank')"><i class="fa fa-search"></i> Preview</button>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-success" onclick=" window.open('<?= base_url('cetak/desa?type=D') ?>','_blank')"><i class="fa fa-print"></i> Save & Print</button>
								</div>
							</div>
							<div class="card">
								<div class="card-body text-center">
									<h4 class="text-center">Rekapitulasi Per TPS</h4>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-warning" onclick=" window.open('<?= base_url('cetak/desa') ?>','_blank')"><i class="fa fa-search"></i> Preview</button>
								</div>
								<div class="box b-t text-center">
									<button type="button" name="type" class="btn btn-success" onclick=" window.open('<?= base_url('cetak/desa?type=D') ?>','_blank')"><i class="fa fa-print"></i> Save & Print</button>
								</div>
							</div>
							<!-- Column -->
							<!-- <div class="card">
								<div class="card-body text-center">
									<h4 class="text-center">Daftar TPS Belum Input</h4>
								</div>
								<div class="box b-t text-center">
									<a href="<?= base_url('cetak/beluminput/I') ?>" class="btn btn-warning"><i class="fa fa-search"></i> Preview</a>
								</div>
								<div class="box b-t text-center">
									<a href="<?= base_url('cetak/beluminput/D') ?>" class="btn btn-success"><i class="fa fa-print"></i> Save & Print</a>
								</div>
							</div> -->
							<!-- Column -->
							<!-- <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="text-center">Ranking Kecamatan</h4>
                                </div>
                                <div class="box b-t text-center">
                                    <a href="<?= base_url('cetak/ranking/I') ?>" class="btn btn-warning"><i class="fa fa-search"></i> Preview</a>
                                </div>
                                <div class="box b-t text-center">
                                    <a href="<?= base_url('cetak/ranking/D') ?>" class="btn btn-success"><i class="fa fa-print"></i> Save & Print</a>
                                </div>
                            </div> -->
							<!-- Column -->
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- ============================================================== -->
		<!-- End Container fluid  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Page wrapper  -->
	<!-- ============================================================== -->
</div>