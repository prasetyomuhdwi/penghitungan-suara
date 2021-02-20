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
									<a href="<?= base_url('cetak/beluminput/d') ?>" target="_blank" class="btn btn-success float-right"><i class="fa fa-print"></i> Cetak</a>

								</td>
							</tr>
						</table>

						<div class="col-sm-3">
							<?php echo $this->session->flashdata('message'); ?>
						</div>
						<table>
							<tr>
								<form action="<?= base_url('tps/belum-input') ?>" method="POST">
									<td class="px-1">Pilih Kecamatan</td>
									<td class="px-1">
										<select name="id" id="id" class="form-control">
											<option value="">Semua</option>
											<?php foreach ($list as $l) : ?>
												<option value="<?= $l['id'] ?>"><?= $l['kecamatan'] ?></option>
											<?php endforeach ?>
										</select>
									</td>
									<td class="px-1">
										<button type="submit" class="btn btn-info">Cari</button>
									</td>
								</form>
							</tr>
						</table>
						<div class="row mt-4">
							<?php if ($kecamatan) { ?>
								<?php $i = 0; ?>
								<table class="table table-bordered" id="tabelBelumInput">
									<?php $i = 0; ?>
									<thead>
										<tr>
											<th width="10%">No</th>
											<th width="40%">Kecamatan</th>
											<th width="20%">Nama Desa</th>
											<th width="30%">TPS</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($kecamatan as $kec) : ?>

											<tr>
												<td rowspan="<?= count($kec['desa']) + 1 ?>"><?= $i + 1 ?></td>
												<td rowspan="<?= count($kec['desa']) + 1 ?>">
													<b>Kecamatan <?= $kec['kecamatan'] ?></b><br>
													Penanggung Jawab : <?= $kec['koordinator'] ?>
												</td>
											</tr>
											<?php for ($j = 0; $j < count($kec['desa']); $j++) : ?>
												<tr>
													<td><?= $kec['desa'][$j]['desa'] ?></td>
													<td>
														<?php for ($k = 0; $k < count($kec['desa'][$j]['tps']); $k++) : ?>
															[<?= $kec['desa'][$j]['tps'][$k]['tps'] ?>]
														<?php endfor ?>
													</td>
												</tr>
											<?php endfor ?>
									</tbody>
									<?php $i++; ?>
								<?php endforeach; ?>
								</table>
								<?php $i++; ?>
							<?php } else { ?>
								<div class="col-sm-6">
									<div class="alert alert-success" role="alert">Semua TPS sudah melakukian input!</div>
								</div>
							<?php } ?>
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