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
									<button type="button" class="btn btn-success float-right tambahTpsModal" data-toggle="modal" data-target="#tpsModal"><i class="fa fa-plus"></i> Tambah</button>

								</td>
							</tr>
						</table>

						<div class="table-responsive">
							<table id="tabelTps" class="table">
								<thead>
									<tr>
										<th class="text-center">TPS</th>
										<th class="text-center">DPT</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tps as $t) : ?>
										<tr>
											<td class="text-center"><?= $t['tps'] ?></td>
											<td class="text-center"><?= $t['dpt'] ?></td>
											<td class="text-right">
												<button type="button" class="btn btn-warning btn-sm mx-1 ubahTpsModal" data-toggle="modal" data-target="#tpsModal" data-id="<?php echo $t['id']; ?>"><i class="fa fa-edit"></i> Ubah</button>
												<input type="hidden" name="desa_id" id="desa_id" value="<?= $desa['id'] ?>">
												<a href="<?= base_url('tps/delete/') . $t['id']; ?>" type="submit" class="btn btn-danger btn-sm mx-1 delete"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
									<?php endforeach; ?>
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
<div id="tpsModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="tpsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tpsModalLabel">Tambah Data TPS</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material" method="POST" action="<?= base_url('tps/insert') ?>">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="desa_id" id="desa_id" value="<?= $desa['id'] ?>">
					<div class="form-group">
						<div class="col-md-12 m-b-20">
							<label for="tps">Nomor TPS</label>
							<input type="number" class="form-control" id="tps" name="tps" placeholder="Masukkan Nomor TPS" required>
						</div>
						<div class="col-md-12 m-b-20">
							<label for="dpt">Jumlah DPT</label>
							<input type="number" class="form-control" id="dpt" name="dpt" placeholder="Masukkan Jumlah DPT" required>
						</div>

					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info waves-effect">Simpan</button>
				</form>
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>