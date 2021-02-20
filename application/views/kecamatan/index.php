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
									<button type="button" class="btn btn-success float-right tambahKecamatanModal" data-toggle="modal" data-target="#kecamatanModal"><i class="fa fa-plus"></i> Tambah</button>

								</td>
							</tr>
						</table>
						<div class="table-responsive">
							<table id="tabelKecamatan" class="table">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th>Nama Kecamatan</th>
										<th>Nama Penanggung Jawab</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($kecamatan as $k) : ?>
										<tr>
											<td class="text-center"><?= $i ?></td>
											<td><?= $k['kecamatan'] ?></td>
											<td><?= $k['koordinator'] ?></td>
											<td class="text-right">
												<a href="<?= base_url('desa/') . $k['id'] ?>" class="btn btn-info btn-sm mx-1"><i class="fa fa-search"></i> Lihat Desa</a>
												<a href="" class="btn btn-warning btn-sm mx-1 ubahKecamatanModal" data-toggle="modal" data-target="#kecamatanModal" data-id="<?php echo $k['id']; ?>"><i class="fa fa-edit"></i> Ubah</a>
												<a href="<?= base_url('kecamatan/delete/') . $k['id']; ?>" class="btn btn-danger btn-sm mx-1 delete"><i class="fa fa-trash"></i> Hapus</a>
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
							<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Nama Kecamatan" required>
						</div>
						<div class="col-md-12 m-b-20">
							<input type="text" class="form-control" id="koordinator" name="koordinator" placeholder="Nama Penanggung Jawab" required>
						</div>
						<!-- <div class="col-md-12 m-b-20">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div> -->
						<!-- <div class="col-md-12 m-b-20">
							<input type="checkbox" id="checkbox" onchange="show()">
							<label for="checkbox"></label>Tampilkan Password
						</div> -->
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