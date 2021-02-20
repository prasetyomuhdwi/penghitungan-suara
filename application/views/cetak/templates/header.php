<table style="break-after: avoid;">
    <tr>
        <td style="padding-left: 10px; padding-right: 10px;"><img src="assets/images/logo-kop.png?" . time() width="60px"></td>
        <td style="padding-left: 10px; padding-right: 10px;" class="font">
            <h2>Pemerintah <?= $nama_daerah ?></h2>
            <h2><?= $nama_lembaga ?></h2>
            <?= $alamat ?>
        </td>

    </tr>

</table>
<hr>

<table width="100%" style="margin-bottom: 1rem;">
    <tr>
        <td width="60%">
            <h4> <?= $title ?></h4>
        </td>
        <td width="40%">
            <table align="right">
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?= tanggal_indonesia_lengkap(date("Y-m-d")) ?></td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td><?= date("H:i:s") ?></td>
                </tr>
            </table>
        </td>
    </tr>

</table>