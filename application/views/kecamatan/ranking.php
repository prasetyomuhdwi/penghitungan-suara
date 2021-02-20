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
									<a href="<?= base_url('cetak/ranking/d') ?>" target="_blank" class="btn btn-success float-right"><i class="fa fa-print"></i> Cetak</a>

								</td>
							</tr>
						</table>
						<div class="col-sm-3">
							<?php echo $this->session->flashdata('message'); ?>
						</div>


						<table class="table table-bordered">
							<thead class="text-center">
								<tr>
									<th class="align-middle">Ranking</th>
									<th class="align-middle">Nama Kecamatan</th>
									<th class="align-middle">Koordinator</th>
									<th class="align-middle">Jumlah TPS Input</th>
									<th class="align-middle">Jumlah TPS</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 0; ?>
								<?php foreach ($ranking as $rank) : ?>
									<tr>
										<td class="text-center"><?= $i + 1 ?></td>
										<td><?= $rank['kecamatan'] ?></td>
										<td><?= $rank['koordinator'] ?></td>
										<td class="text-right"><?= $rank['jumlah'] / $paslon_count ?></td>
										<td class="text-right"><?= $rank['total']  ?></td>
									</tr>
									<?php $i++; ?>
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