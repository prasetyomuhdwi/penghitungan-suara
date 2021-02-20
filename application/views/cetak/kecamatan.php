<style>
    body {
        font-family: Arial;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        text-align: center;
        font-weight: bold;
        border: 1px solid black;
        padding: 3px;
    }

    .table td {
        border: 1px solid black;
        padding: 3px;
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
    <table class="table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Kecamatan</th>
                <th colspan="<?= count($paslon) * 2 ?>">Perolehan Suara Sah</th>
                <th colspan="4">Jumlah Suara Masuk</th>
                <th colspan="5">Kehadiran</th>
                <th colspan="3">TPS</th>
            </tr>
            <tr>
                <?php foreach ($paslon as $p) : ?>
                    <th colspan="2"><?= $p['nama'] ?></th>
                <?php endforeach; ?>
                <th colspan="2">Sah</th>
                <th colspan="2">Tidak Sah</th>
                <th colspan="2">Hadir</th>
                <th colspan="2">Tidak Hadir</th>
                <th>DPT</th>
                <th>Sudah Input</th>
                <th>Belum Input</th>
                <th>Total TPS</th>
            </tr>
        </thead>
        <?php $i = 0; ?>
        <?php foreach ($hasil_sah as $h) : ?>
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
                    <td align="right">
                        <?php if ($total_sah[$i] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                <?php endfor ?>
                <!-- JUMLAH SUARA MASUK -->
                <td align="right">
                    <?= number_format($total_sah[$i], 0, "", ".") ?><br>
                </td>
                <td align="right">
                    <?php if ($total[$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($total_sah[$i] / $total[$i] * 100, 2) ?>%
                    <?php } ?>
                </td>
                <?php for ($j = 0; $j < $tidak_sah_count; $j++) : ?>
                    <td align="right">
                        <?= number_format($hasil_tidak_sah[$i]['hasil'][$j]['jml_suara'], 0, "", ".") ?><br>
                    </td>
                    <td align="right">
                        <?php if ($total[$i] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($hasil_tidak_sah[$i]['hasil'][$j]['jml_suara'] / $total[$i] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                <?php endfor ?>
                <!-- KEHADIRAN -->
                <td align="right">
                    <?= number_format($total[$i], 0, "", ".") ?><br>
                </td>
                <td align="right">
                    <?php if ($dpt[$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($total[$i] / $dpt[$i] * 100, 2) ?>%
                    <?php } ?>
                </td>
                <td align="right">
                    <?= number_format($dpt[$i] - $total[$i], 0, "", ".") ?><br>
                </td>
                <td align="right">
                    <?php if ($dpt[$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round(($dpt[$i] - $total[$i]) / $dpt[$i] * 100, 2) ?>%
                    <?php } ?>
                </td>
                <td align="right">
                    <?= number_format($dpt[$i], 0, "", ".") ?>
                </td>

                <!-- TPS -->
                <td align="right"><?= number_format($tps_input[$i], 0, "", ".") ?></td>
                <td align="right"><?= number_format($tps_kosong[$i], 0, "", ".") ?></td>
                <td align="right"><?= number_format($tps_kosong[$i] + $tps_input[$i], 0, "", ".") ?></td>

            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

        <tr class="text-center bg-success text-white">
            <th style="line-height: 2rem;" colspan="2">Total</th>
            <?php for ($i = 0; $i < count($jumlah['paslon']); $i++) : ?>
                <th align="right">
                    <?= number_format($jumlah['paslon'][$i], 0, "", ".") ?>
                </th>
                <th align="right">
                    <?php if ($jumlah['sah'] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <b><?= round($jumlah['paslon'][$i] / $jumlah['sah'] * 100, 2) ?>%</b>
                    <?php } ?>
                </th>
            <?php endfor ?>
            <th align="right">
                <?= number_format($jumlah['sah'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?php if ($jumlah['hadir'] == 0) { ?>
                    0%
                <?php } else { ?>
                    <b><?= round($jumlah['sah'] / $jumlah['hadir'] * 100, 2) ?>%</b>
                <?php } ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['tidak_sah'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?php if ($jumlah['hadir'] == 0) { ?>
                    0%
                <?php } else { ?>
                    <b><?= round($jumlah['tidak_sah'] / $jumlah['hadir'] * 100, 2) ?>%</b>
                <?php } ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['hadir'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?php if ($jumlah['dpt'] == 0) { ?>
                    0%
                <?php } else { ?>
                    <b><?= round($jumlah['hadir'] / $jumlah['dpt'] * 100, 2) ?>%</b>
                <?php } ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['dpt'] - $jumlah['hadir'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?php if ($jumlah['dpt'] == 0) { ?>
                    0%
                <?php } else { ?>
                    <b><?= round(($jumlah['dpt'] - $jumlah['hadir']) / $jumlah['dpt'] * 100, 2) ?>%</b>
                <?php } ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['dpt'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['tps_input'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['tps_kosong'], 0, "", ".") ?>
            </th>
            <th align="right">
                <?= number_format($jumlah['tps_input'] + $jumlah['tps_kosong'], 0, "", ".") ?>
            </th>
        </tr>
    </table>
</body>