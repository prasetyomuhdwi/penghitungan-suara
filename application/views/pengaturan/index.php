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
        <div class="row mt-4">

            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pengaturan Aplikasi</h4>
                        <form class="form-material m-t-40">
                            <div class="form-group">
                                <label>Nama Aplikasi</label>
                                <input id="aplikasi" name="nama_aplikasi" type="text" class="form-control form-control-line" value="<?= $nama_aplikasi ?>">
                            </div>
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="pb-2">
                                    <img id="imgLogo" class="border" src="<?= base_url('assets/images/') . $logo . '?' . time() ?>" alt="logo.png" height="60px">
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary uploadLogo" data-toggle="modal" data-target="#uploadModal" data-name="logo"><i class="fa fa-edit"></i> Ubah</button>
                            </div>
                            <div class="form-group">
                                <label>Logo Nama</label>
                                <div class="pb-2">
                                    <img id="imgLogoText" class="border" src="<?= base_url('assets/images/') . $logo_text . '?' . time() ?>" alt="logo-text.png" height="40px">
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary uploadLogoText" data-toggle="modal" data-target="#uploadModal" data-name="logo-text"><i class="fa fa-edit"></i> Ubah</button>
                            </div>
                            <button onclick="saveAplikasi()" type="button" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td>
                                    <h4 class="card-title">Pengaturan Akun Pemantau</h4>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success float-right tambahAdminModal" data-toggle="modal" data-target="#adminModal"><i class="fa fa-plus"></i> Tambah</button>
                                </td>
                            </tr>
                        </table>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($admin as $a) : ?>
                                        <tr>
                                            <td class="text-center" width="5%"><?= $i ?></td>
                                            <td><?= $a['username'] ?></td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-secondary btn-sm mx-1 passwordModal" data-toggle="modal" data-target="#passwordModal" data-id="<?= $a['id']; ?>"><i class="fa fa-search-plus"></i> Lihat</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-warning btn-sm mx-1 ubahAdminModal" data-toggle="modal" data-target="#adminModal" data-id="<?= $a['id']; ?>"><i class="fa fa-edit"></i> Ubah</a>
                                                <a href="<?= base_url('pengaturan/deleteadmin/' . $a['id']) ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pengaturan Laporan</h4>
                        <form class="form-material m-t-40" action="<?= base_url('pengaturan/savelaporan') ?>" method="POST">
                            <div class="form-group">
                                <label>Logo Kop</label>
                                <div class="pb-2">
                                    <img id="imgLogoKop" class="border" src="<?= base_url('assets/images/') . $logo_kop . '?' . time() ?>" alt="logo-kop.png" height="60px">
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary uploadLogoKop" data-toggle="modal" data-target="#uploadModal" data-name="logo-kop"><i class="fa fa-edit"></i> Ubah</button>

                            </div>
                            <div class="form-group">
                                <label>Nama Daerah</label>
                                <input id="laporan0" name="nama_daerah" type="text" class="form-control form-control-line" value="<?= $nama_daerah ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Lembaga</label>
                                <input id="laporan1" name="nama_lembaga" type="text" class="form-control form-control-line" value="<?= $nama_lembaga ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input id="laporan2" name="alamat" type="text" class="form-control form-control-line" value="<?= $alamat ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanda Tangan - Jabatan</label>
                                <input id="laporan3" name="ttd_jabatan" type="text" class="form-control form-control-line" value="<?= $ttd_jabatan ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanda Tangan - Nama</label>
                                <input id="laporan4" name="ttd_nama" type="text" class="form-control form-control-line" value="<?= $ttd_nama ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanda Tangan - Keterangan</label>
                                <input id="laporan5" name="ttd_keterangan" type="text" class="form-control form-control-line" value="<?= $ttd_keterangan ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanda Tangan - NIP</label>
                                <input id="laporan6" name="ttd_nip" type="text" class="form-control form-control-line" value="<?= $ttd_nip ?>">
                            </div>
                            <button type="button" onclick="saveLaporan()" class="btn btn-success waves-effect waves-light m-r-10">Simpan</button>
                        </form>
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
<div id="adminModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="adminModalLabel">Tambah Akun Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-material" method="POST" action="<?= base_url('pengaturan/addadmin') ?>">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <div class="col-md-12 m-b-20">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
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
                        <input type="text" class="form-control" name="showPassword" id="showPassword" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="uploadModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="uploadModalLabel">Upload Logo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?= base_url('pengaturan/upload') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="nama" name="nama">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control" name="upload" id="upload" aria-describedby="fileHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>