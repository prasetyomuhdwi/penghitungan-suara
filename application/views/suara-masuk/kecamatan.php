	<!-- ============================================================== -->
	<!-- Page wrapper  -->
	<!-- ============================================================== -->
	<div class="page-wrapper">
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-12">
					<div class="card mt-4">
						<div class="card-body">
							<table width="100%">
								<tr>
									<td>
										<h3 class="card-title"><?= $title ?></h3>
									</td>
									<td>
										<a href="<?= base_url('cetak/desa/d') ?>" target="_blank" class="btn btn-success float-right"><i class="fa fa-print"></i> Cetak</a>

									</td>
								</tr>
							</table>
							<div class="col-sm-3">
								<?php echo $this->session->flashdata('message'); ?>
							</div>

							<div class="table-responsive mt-3">
								<table id="myTable" class="table table-bordered table-striped">
									<thead class="text-center">
										<tr>
											<th class="align-middle" rowspan="2">No</th>
											<th class="align-middle" rowspan="2">Nama Desa</th>
											<th class="align-middle" colspan="<?= count($paslon) ?>">Perolehan Suara Sah</th>
											<th class="align-middle" colspan="2">Jumlah Suara Masuk</th>
											<th class="align-middle" colspan="3">Kehadiran</th>
											<th class="align-middle" colspan="3">TPS</th>
											<th class="align-middle" rowspan="2">Detail</th>
										</tr>
										<tr>
											<?php foreach ($paslon as $p) : ?>
												<th class="align-middle"><?= $p['nama'] ?></th>
											<?php endforeach; ?>
											<th class="align-middle">Sah</th>
											<th class="align-middle">Tidak Sah</th>
											<th class="align-middle">Hadir</th>
											<th class="align-middle">Tidak Hadir</th>
											<th class="align-middle">DPT</th>
											<th class="align-middle">Sudah Input</th>
											<th class="align-middle">Belum Input</th>
											<th class="align-middle">Total TPS</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 0; ?>
										<?php foreach ($hasil_sah as $h) : ?>
											<tr>
												<!-- NO -->
												<td class="text-center"><?= $i + 1 ?></td>

												<!-- NAMA KECAMATAN -->
												<td><?= $h['desa'] ?></td>

												<!-- PEROLEHAN SUARA SAH -->
												<?php for ($j = 0; $j < $paslon_count; $j++) : ?>
													<td class="text-center">
														<?= number_format($h['hasil'][$j]['jml_suara'], 0, "", ".")  ?><br>
														<?php if ($total_sah[$i] == 0) { ?>
															<b>(0%)</b>
														<?php } else { ?>
															<b>(<?= round($h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100, 2) ?>%)</b>
														<?php } ?>
													</td>
												<?php endfor ?>

												<!-- JUMLAH SUARA MASUK -->
												<td class="text-center">
													<?= number_format($total_sah[$i], 0, "", ".") ?><br>
													<?php if ($total[$i] == 0) { ?>
														<b>(0%)</b>
													<?php } else { ?>
														<b>(<?= round($total_sah[$i] / $total[$i] * 100, 2) ?>%)</b>
													<?php } ?>
												</td>
												<?php for ($j = 0; $j < $tidak_sah_count; $j++) : ?>
													<td class="text-center">
														<?= number_format($hasil_tidak_sah[$i]['hasil'][$j]['jml_suara'], 0, "", ".") ?><br>
														<?php if ($total[$i] == 0) { ?>
															<b>(0%)</b>
														<?php } else { ?>
															<b>(<?= round($hasil_tidak_sah[$i]['hasil'][$j]['jml_suara'] / $total[$i] * 100, 2) ?>%)</b>
														<?php } ?>

													</td>
												<?php endfor ?>
												<!-- KEHADIRAN -->
												<td class="text-center">
													<?= number_format($total[$i], 0, "", ".") ?><br>
													<?php if ($dpt[$i] == 0) { ?>
														<b>(0%)</b>
													<?php } else { ?>
														<b>(<?= round($total[$i] / $dpt[$i] * 100, 2) ?>%)</b>
													<?php } ?>
												</td>
												<td class="text-center">
													<?= number_format($dpt[$i] - $total[$i], 0, "", ".") ?><br>
													<?php if ($dpt[$i] == 0) { ?>
														<b>(0%)</b>
													<?php } else { ?>
														<b>(<?= round(($dpt[$i] - $total[$i]) / $dpt[$i] * 100, 2) ?>%)</b>
													<?php } ?>
												</td>
												<td class="text-center">
													<?= number_format($dpt[$i], 0, "", ".") ?>
												</td>

												<!-- TPS -->
												<td class="text-center"><?= number_format($tps_input[$i], 0, "", ".") ?><br>TPS</td>
												<td class="text-center"><?= number_format($tps_kosong[$i], 0, "", ".") ?><br>TPS</td>
												<td class="text-center"><?= number_format($tps_kosong[$i] + $tps_input[$i], 0, "", ".") ?><br>TPS</td>

												<td class="text-center">
													<a href="<?= base_url('suara-masuk/desa/') . $h['id'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
												</td>
											</tr>
											<?php $i++; ?>
										<?php endforeach; ?>
										<tr class="text-center bg-success text-white">
											<th colspan="2">Total</th>
											<?php for ($i = 0; $i < count($jumlah['paslon']); $i++) : ?>
												<th>
													<?= number_format($jumlah['paslon'][$i], 0, "", ".") ?><br>
													<?php if ($jumlah['sah'] == 0) { ?>
														<b>(0%)</b>
													<?php } else { ?>
														<b>(<?= round($jumlah['paslon'][$i] / $jumlah['sah'] * 100, 2) ?>%)</b>
													<?php } ?>
												</th>
											<?php endfor ?>
											<th>
												<?= number_format($jumlah['sah'], 0, "", ".") ?><br>
												<?php if ($jumlah['hadir'] == 0) { ?>
													<b>(0%)</b>
												<?php } else { ?>
													<b>(<?= round($jumlah['sah'] / $jumlah['hadir'] * 100, 2) ?>%)</b>
												<?php } ?>
											</th>
											<th>
												<?= number_format($jumlah['tidak_sah'], 0, "", ".") ?><br>
												<?php if ($jumlah['hadir'] == 0) { ?>
													<b>(0%)</b>
												<?php } else { ?>
													<b>(<?= round($jumlah['tidak_sah'] / $jumlah['hadir'] * 100, 2) ?>%)</b>
												<?php } ?>
											</th>
											<th>
												<?= number_format($jumlah['hadir'], 0, "", ".") ?><br>
												<?php if ($jumlah['dpt'] == 0) { ?>
													<b>(0%)</b>
												<?php } else { ?>
													<b>(<?= round($jumlah['hadir'] / $jumlah['dpt'] * 100, 2) ?>%)</b>
												<?php } ?>
											</th>
											<th>
												<?= number_format($jumlah['dpt'] - $jumlah['hadir'], 0, "", ".") ?><br>
												<?php if ($jumlah['dpt'] == 0) { ?>
													<b>(0%)</b>
												<?php } else { ?>
													<b>(<?= round(($jumlah['dpt'] - $jumlah['hadir']) / $jumlah['dpt'] * 100, 2) ?>%)</b>
												<?php } ?>
											</th>
											<th>
												<?= number_format($jumlah['dpt'], 0, "", ".") ?><br>
											</th>
											<th>
												<?= number_format($jumlah['tps_input'], 0, "", ".") ?><br>TPS
											</th>
											<th>
												<?= number_format($jumlah['tps_kosong'], 0, "", ".") ?><br>TPS
											</th>
											<th>
												<?= number_format($jumlah['tps_input'] + $jumlah['tps_kosong'], 0, "", ".") ?><br>TPS
											</th>
											<th></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End PAge Content -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Container fluid  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Page wrapper  -->
	<!-- ============================================================== -->

	<!-- ============================================================== -->
	<!-- Modal  -->
	<!-- ============================================================== -->
	<div id="kecamatanModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="kecamatanModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="kecamatanModalLabel">Tambah Data Kecamatan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal form-material" method="POST" action="<?= base_url('kecamatan/insert') ?>">
						<input type="hidden" name="id" id="id">
						<div class="form-group">
							<div class="col-md-12 m-b-20">
								<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Nama Kecamatan" required> </div>
							<div class="col-md-12 m-b-20">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
							</div>
							<div class="col-md-12 m-b-20">
								<input type="checkbox" id="checkbox" onchange="show()">
								<label for="checkbox"></label>Tampilkan Password
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info waves-effect">Save</button>
					</form>
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<div id="passwordModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="passwordModalLabel">Lihat Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 m-b-20">
							<input type="text" class="form-control" name="showPassword" id="showPassword" disabled> </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>