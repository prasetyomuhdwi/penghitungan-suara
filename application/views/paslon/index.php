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
									<button type="button" class="btn btn-success float-right tambahPaslonModal" data-toggle="modal" data-target="#paslonModal"><i class="fa fa-plus"></i> Tambah</button>

								</td>
							</tr>
						</table>

						<div class="table-responsive mt-4">
							<table class="table">
								<thead>
									<tr>
										<th class="text-center">Foto</th>
										<th class="text-center">No Urut</th>
										<th>Nama Pasangan</th>
										<th>Nama Calon Bupati</th>
										<th>Nama Calon Wakil Bupati</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($paslon as $p) : ?>
										<tr>
											<td class="text-center" width="20%">
												<img class="img-fluid border rounded" src="<?= base_url('assets/images/paslon/') . $p['foto'] ?>" alt="default.png">
												<button class="btn btn-info btn-xs mt-2 ubahFotoModal" data-toggle="modal" data-target="#fotoModal" data-id="<?= $p['id']; ?>" onclick="addId(this)"><i class="fa fa-photo"></i> Ganti Foto</button>
											</td>
											<td class="text-center align-middle h2"><?= $p['no_urut'] ?></td>
											<td class="align-middle"><?= $p['nama'] ?></td>
											<td class="align-middle"><?= $p['cabub'] ?></td>
											<td class="align-middle"><?= $p['cawabub'] ?></td>
											<td class="text-right align-middle">
												<a href="" class="btn btn-warning btn-sm mx-1 ubahPaslonModal" data-toggle="modal" data-target="#paslonModal" data-id="<?= $p['id']; ?>"><i class="fa fa-edit"></i> Ubah</a>
												<a href="<?= base_url('paslon/delete/') . $p['id']; ?>" class="btn btn-danger btn-sm mx-1 delete"><i class="fa fa-trash"></i> Hapus</a>
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
<div id="paslonModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="paslonModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="paslonModalLabel">Tambah Data Paslon</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material" method="POST" action="<?= base_url('paslon/insert') ?>">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<div class="col-md-12 m-b-20">
							<input type="number" class="form-control" id="no_urut" name="no_urut" placeholder="Nomor Urut" required>
						</div>
						<div class="col-md-12 m-b-20">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pasangan" required>
						</div>
						<div class="col-md-12 m-b-20">
							<input type="text" class="form-control" id="cabub" name="cabub" placeholder="Nama Calon Bupati">
						</div>
						<div class="col-md-12 m-b-20">
							<input type="text" class="form-control" id="cawabub" name="cawabub" placeholder="Nama Calon Wakil Bupati">
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

<div id="fotoModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="fotoModalLabel">Ubah Foto Paslon</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-material" method="POST" action="<?= base_url('paslon/foto') ?>" enctype="multipart/form-data">
					<input type="hidden" id="id2" name="id2">
					<div class="form-group">
						<input type="file" class="form-control" id="foto" name="foto" placeholder="Nomor Urut" required>
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info waves-effect">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function addId(t) {
		let d = t.getAttribute("data-id");
		document.getElementById("id2").value = d
	}
</script>
