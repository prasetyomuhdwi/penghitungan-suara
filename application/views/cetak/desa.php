<style>
    body {
        font-family: Arial;
        font-size: 11pt;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
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
    <?php $i = 0; ?>
    <?php foreach ($hasil_sah as $h) : ?>
        <table class="table">
            <tr>
                <th style="line-height: 2rem;" colspan="<?= (count($paslon) * 2) + 14 ?>">Kecamatan <?= $h['kecamatan'] ?></th>
            </tr>
            <tr>
                <th rowspan="2">No</th>
                <th width="12%" rowspan="2">Nama Desa</th>
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
            <?php for ($j = 0; $j < count($h['desa']); $j++) : ?>
                <tr>
                    <td align="center"><?= $j + 1 ?></td>
                    <td><?= $h['desa'][$j]['desa'] ?></td>
                    <?php for ($k = 0; $k < $paslon_count; $k++) : ?>
                        <td width="60vw" align="right"><?= number_format($h['desa'][$j]['hasil'][$k]['jml_suara'], 0, "", ".") ?></td>
                        <td width="60vw" align="right">
                            <?php if ($total_sah[$i][$j] == 0) { ?>
                                0%
                            <?php } else { ?>
                                <?= round($h['desa'][$j]['hasil'][$k]['jml_suara'] / $total_sah[$i][$j] * 100, 2)  ?>%
                            <?php } ?>
                        </td>
                    <?php endfor ?>
                    <td width="60vw" align="right"><?= number_format($total_sah[$i][$j], 0, "", ".") ?></td>
                    <td width="60vw" align="right">
                        <?php if ($total_sah[$i][$j] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($total_sah[$i][$j] / $total[$i][$j] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                    <?php for ($k = 0; $k < $tidak_sah_count; $k++) : ?>
                        <td width="60vw" align="right"><?= number_format($hasil_tidak_sah[$i]['desa'][$j]['hasil'][$k]['jml_suara'], 0, "", ".") ?></td>
                        <td width="60vw" align="right">
                            <?php if ($total_sah[$i][$j] == 0) { ?>
                                0%
                            <?php } else { ?>
                                <?= round($hasil_tidak_sah[$i]['desa'][$j]['hasil'][$k]['jml_suara'] / $total[$i][$j] * 100, 2) ?>%
                            <?php } ?>
                        </td>
                    <?php endfor ?>
                    <td width="60vw" align="right"><?= number_format($total[$i][$j], 0, "", ".") ?></td>
                    <td width="60vw" align="right">
                        <?php if ($dpt[$i][$j] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($total[$i][$j] / $dpt[$i][$j] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                    <td width="60vw" align="right"><?= number_format($dpt[$i][$j] - $total[$i][$j], 0, "", ".") ?></td>
                    <td width="60vw" align="right">
                        <?php if ($dpt[$i][$j] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round(($dpt[$i][$j] - $total[$i][$j]) / $dpt[$i][$j] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                    <td width="60vw" align="right"><?= $dpt[$i][$j] ?></td>
                    <td width="60vw" align="right"><?= $tps_input[$i][$j] ?></td>
                    <td width="60vw" align="right"><?= $tps_kosong[$i][$j] ?></td>
                    <td width="60vw" align="right"><?= $tps_input[$i][$j] + $tps_kosong[$i][$j] ?></td>
                </tr>
            <?php endfor ?>
            <tr>
                <th style="line-height: 2rem;" colspan="2">Total</th>
                <?php for ($j = 0; $j < $paslon_count; $j++) : ?>
                    <th align="right">
                        <?= number_format($jumlah['paslon'][$i][$j], 0, "", ".") ?>
                    </th>
                    <th align="right">
                        <b>
                            <?php if ($jumlah['sah'][$i] == 0) { ?>
                                0%
                            <?php } else { ?>
                                <?= round($jumlah['paslon'][$i][$j] / $jumlah['sah'][$i] * 100, 2) ?>%
                            <?php } ?>
                        </b>
                    </th>
                <?php endfor ?>
                <th align="right">
                    <?= number_format($jumlah['sah'][$i], 0, "", ".") ?>
                </th>
                <th align="right">

                    <?php if ($jumlah['hadir'][$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($jumlah['sah'][$i] / $jumlah['hadir'][$i] * 100, 2) ?>%
                    <?php } ?>

                </th>
                <th align="right">
                    <?= number_format($jumlah['tidak_sah'][$i], 0, "", ".") ?>
                </th>
                <th align="right">

                    <?php if ($jumlah['hadir'][$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($jumlah['tidak_sah'][$i] / $jumlah['hadir'][$i] * 100, 2) ?>%
                    <?php } ?>

                </th>
                <th align="right">
                    <?= number_format($jumlah['hadir'][$i], 0, "", ".") ?>
                </th>
                <th align="right">

                    <?php if ($jumlah['dpt'][$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($jumlah['hadir'][$i] / $jumlah['dpt'][$i] * 100, 2) ?>%
                    <?php } ?>

                </th>
                <th align="right">
                    <?= number_format($jumlah['dpt'][$i] - $jumlah['hadir'][$i], 0, "", ".") ?>
                </th>
                <th align="right">

                    <?php if ($jumlah['dpt'][$i] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round(($jumlah['dpt'][$i] - $jumlah['hadir'][$i]) / $jumlah['dpt'][$i] * 100, 2) ?>%
                    <?php } ?>

                </th>
                <th align="right">
                    <?= number_format($jumlah['dpt'][$i], 0, "", ".") ?>
                </th>
                <th align="right">
                    <?= number_format($jumlah['tps_input'][$i], 0, "", ".") ?>
                </th>
                <th align="right">
                    <?= number_format($jumlah['tps_kosong'][$i], 0, "", ".") ?>
                </th>
                <th align="right">
                    <?= number_format($jumlah['tps_kosong'][$i] + $jumlah['tps_input'][$i], 0, "", ".") ?>
                </th>
            </tr>
        </table>
        <?php $i++; ?>
    <?php endforeach ?>
</body>