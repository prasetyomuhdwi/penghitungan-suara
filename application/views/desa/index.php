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
									<button type="button" class="btn btn-success float-right tambahDesaModal" data-toggle="modal" data-target="#desaModal"><i class="fa fa-plus"></i> Tambah</button>

								</td>
							</tr>
						</table>

						<div class="table-responsive">
							<table id="tabelDesa" class="table">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th>Nama Desa</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($desa as $d) : ?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $d['desa'] ?></td>
											<td class="text-right">
												<a href="<?= base_url('tps/') . $d['id']; ?>" class="btn btn-info btn-sm mx-1"><i class="fa fa-search"></i> Lihat TPS</a>
												<a href="" class="btn btn-warning btn-sm mx-1 ubahDesaModal" data-toggle="modal" data-target="#desaModal" data-id="<?php echo $d['id']; ?>"><i class="fa fa-edit"></i> Ubah</a>
												<a href="<?= base_url('desa/delete/') . $d['id']; ?>" class="btn btn-danger btn-sm mx-1 delete"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
										<?php $i++; ?>
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
<div id="desaModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="desaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="desaModalLabel">Tambah Data Desa</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material" method="POST" action="<?= base_url('desa/insert') ?>">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="kecamatan_id" id="kecamatan_id" value="<?= $kecamatan['id'] ?>">
					<div class="form-group">
						<div class="col-md-12 m-b-20">
							<input type="text" class="form-control" id="desa" name="desa" placeholder="Nama Desa" required>
						</div>

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
				<button type="submit" class="btn btn-info waves-effect">Simpan</button>
				</form>
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>