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
		<div class="col-12">
			<div class="card mt-4">
				<div class="card-body">
					<h3 class="card-title">Aktivitas Website</h3>
					<div class="table-responsive">
						<table id="tabelWeb" class="table table-bordered">
							<thead class="bg-light">
								<tr>
									<th class="px-2">Username</th>
									<th class="px-2">Waktu</th>
									<th class="px-2">Alamat IP</th>
									<th class="px-2">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($web as $w) : ?>
									<tr>
										<td class="p-1"><?= $w['username'] ?></td>
										<td class="p-1"><?= $w['time'] ?></td>
										<td class="p-1"><?= $w['ip_address'] ?></td>
										<td class="p-1"><?= $w['user_agent'] ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
		<div class="col-12">
			<div class="card mt-4">
				<div class="card-body">
					<h3 class="card-title">Aktivitas Aplikasi Mobile</h3>
					<div class="table-responsive">
						<table id="tabelMobile" class="table table-bordered">
							<thead class="bg-light">
								<tr>
									<th class="px-2">Username</th>
									<th class="px-2">Waktu</th>
									<th class="px-2">Alamat IP</th>
									<th class="px-2">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($mobile as $m) : ?>
									<tr>
										<td class="p-1"><?= $m['username'] ?></td>
										<td class="p-1"><?= $m['time'] ?></td>
										<td class="p-1"><?= $m['ip_address'] ?></td>
										<td class="p-1"><?= $m['user_agent'] ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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