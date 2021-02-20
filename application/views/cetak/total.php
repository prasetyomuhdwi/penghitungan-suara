<style>
    body {
        font-family: Arial;
        font-size: 11pt;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        text-align: center;
        font-weight: bold;
        border: 1px solid black;
        padding: 5px;
    }

    .table td {
        border: 1px solid black;
        padding: 5px;
    }

    .center {
        text-align: center;
    }

    .footer {
        page-break-inside: auto;
    }

    .footer tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
</style>

<body>


    <?php include 'templates/header.php' ?>
    <h4>Total Perhitungan Suara Kabupaten Ngawi</h4>
    <table class="table">
        <thead>
            <tr>
                <th width="50vw">No</th>
                <th width="300vw">Nama</th>
                <th colspan="2">Perolehan Suara</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            <?php foreach ($hasil_sah as $h) : ?>
                <?php for ($j = 0; $j < $paslon_count; $j++) : ?>
                    <tr>
                        <!-- NO -->
                        <td align="center"><?= $i + 1 ?></td>

                        <td><?= $h['hasil'][$j]['nama'] ?></td>
                        <td align="right"><?= number_format($h['hasil'][$j]['jml_suara'], 0, "", ".") ?></td>
                        <td align="right">
                            <?php if ($total_sah == 0) { ?>
                                0%
                            <?php } else { ?>
                                <?= round($h['hasil'][$j]['jml_suara'] / $total_sah * 100, 2)  ?>%
                            <?php } ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endfor ?>
            <?php endforeach ?>
        </tbody>
    </table>

    <h4 style="padding-top: 1rem;">Rincian Data Yang Telah Masuk</h4>
    <table class="table">
        <tr>
            <td width="350vw">Jumlah Hak Pilih</td>
            <td align="right"><?= number_format($dpt['dpt'], 0, "", ".") ?></td>
            <td align="right">
                <?php if ($dpt['dpt'] == 0) { ?>
                    0%
                <?php } else { ?>
                    <?= round($dpt['dpt'] / $dpt['dpt'] * 100, 2) ?>%
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Jumlah Pengguna Hak Pilih</td>
            <td align="right"><?= number_format($hasil_tidak_sah['jml_suara'] + $total_sah, 0, "", ".") ?></td>
            <td align="right">
                <?php if ($dpt['dpt'] == 0) { ?>
                    0%
                <?php } else { ?>
                    <?= round(($hasil_tidak_sah['jml_suara'] + $total_sah) / $dpt['dpt'] * 100, 2) ?>%
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Suara Sah</td>
            <td align="right"><?= number_format($total_sah, 0, "", ".") ?></td>
            <td align="right">
                <?php if ($total_sah == 0) { ?>
                    0%
                <?php } else { ?>
                    <?= round($total_sah / ($hasil_tidak_sah['jml_suara'] + $total_sah) * 100, 2) ?>%
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Suara Tidak Sah</td>
            <td align="right"><?= number_format($hasil_tidak_sah['jml_suara'], 0, "", ".") ?></td>
            <td align="right">
                <?php if ($total_sah == 0) { ?>
                    0%
                <?php } else { ?>
                    <?= round($hasil_tidak_sah['jml_suara'] / ($hasil_tidak_sah['jml_suara'] + $total_sah) * 100, 2) ?>%
                <?php } ?>
            </td>
        </tr>
    </table>

    <h4 style="padding-top: 1rem;">Rincian Data Per Kecamatan</h4>
    <table class="table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Kecamatan</th>
                <th colspan="<?= count($paslon) ?>">Perolehan Suara Sah</th>
                <th colspan="2">Jumlah Suara Masuk</th>
                <th rowspan="2">Hadir</th>
                <th rowspan="2">DPT</th>
            </tr>
            <tr>
                <?php foreach ($paslon as $p) : ?>
                    <th><?= $p['nama'] ?></th>
                <?php endforeach; ?>
                <th>Sah</th>
                <th>Tidak Sah</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            <?php foreach ($kecamatan['hasil_sah'] as $h) : ?>
                <tr>
                    <!-- NO -->
                    <td align="center"><?= $i + 1 ?></td>

                    <!-- NAMA KECAMATAN -->
                    <td><?= $h['kecamatan'] ?></td>

                    <!-- PEROLEHAN SUARA SAH -->
                    <?php for ($j = 0; $j < $paslon_count; $j++) : ?>
                        <td align="right">
                            <?= number_format($h['hasil'][$j]['jml_suara'], 0, "", ".")  ?><br>
                        </td>
                    <?php endfor ?>
                    <!-- JUMLAH SUARA MASUK -->
                    <td align="right">
                        <?= number_format($kecamatan['total_sah'][$i], 0, "", ".") ?><br>
                    </td>

                    <?php for ($j = 0; $j < $tidak_sah_count; $j++) : ?>
                        <td align="right">
                            <?= number_format($kecamatan['hasil_tidak_sah'][$i]['hasil'][$j]['jml_suara'], 0, "", ".") ?><br>
                        </td>

                    <?php endfor ?>
                    <!-- KEHADIRAN -->
                    <td align="right">
                        <?= number_format($kecamatan['total'][$i], 0, "", ".") ?><br>
                    </td>

                    <td align="right">
                        <?= number_format($kecamatan['dpt'][$i], 0, "", ".") ?>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>

            <tr>
                <th colspan="2" align="right">Total</th>
                <?php for ($i = 0; $i < count($kecamatan['jumlah']['paslon']); $i++) : ?>
                    <th align="right">
                        <?= number_format($kecamatan['jumlah']['paslon'][$i], 0, "", ".") ?>
                    </th>
                <?php endfor ?>
                <th align="right">
                    <?= number_format($kecamatan['jumlah']['sah'], 0, "", ".") ?>
                </th>

                <th align="right">
                    <?= number_format($kecamatan['jumlah']['tidak_sah'], 0, "", ".") ?>
                </th>

                <th align="right">
                    <?= number_format($kecamatan['jumlah']['hadir'], 0, "", ".") ?>
                </th>

                <th align="right">
                    <?= number_format($kecamatan['jumlah']['dpt'], 0, "", ".") ?>
                </th>
            </tr>
            <tr>
                <th colspan="2" align="right">Persentase</th>
                <?php for ($i = 0; $i < count($kecamatan['jumlah']['paslon']); $i++) : ?>

                    <th align="right">
                        <b>
                            <?php if ($kecamatan['jumlah']['sah'] == 0) { ?>
                                0%
                            <?php } else { ?>
                                <?= round($kecamatan['jumlah']['paslon'][$i] / $kecamatan['jumlah']['sah'] * 100, 2) ?>%</b>
                    <?php } ?>
                    </th>
                <?php endfor ?>

                <th align="right">
                    <b>
                        <?php if ($kecamatan['jumlah']['hadir'] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($kecamatan['jumlah']['sah'] / $kecamatan['jumlah']['hadir'] * 100, 2) ?>%</b>
                <?php } ?>
                </th>

                <th align="right">
                    <b>
                        <?php if ($kecamatan['jumlah']['hadir'] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($kecamatan['jumlah']['tidak_sah'] / $kecamatan['jumlah']['hadir'] * 100, 2) ?>%</b>
                <?php } ?>
                </th>

                <th align="right">
                    <b>
                        <?php if ($kecamatan['jumlah']['dpt'] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($kecamatan['jumlah']['hadir'] / $kecamatan['jumlah']['dpt'] * 100, 2) ?>%</b>
                <?php } ?>
                </th>
                <th align="right">

                    <?php if ($kecamatan['jumlah']['dpt'] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($kecamatan['jumlah']['dpt'] / $kecamatan['jumlah']['dpt'] * 100, 2) ?>%
                    <?php } ?>
                </th>
                </th>
            </tr>
        </tbody>
    </table>
</body>