<style>
    body {
        font-family: Arial;
        font-size: 11pt;
    }

    .border {
        border: 1px solid black;
    }

    .left-border {
        border-left: 1px solid black;
    }

    .left-bottom-border {
        border-left: 1px solid black;
        border-bottom: 1px solid black;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .table th {
        text-align: center;
        font-weight: bold;
        padding: 3px;
    }

    .table td {
        padding: 3px;
    }
</style>
<?php include 'templates/header.php' ?>
<?php $i = 0; ?>
<?php foreach ($hasil as $hasil) : ?>
    <table align="center" border="1" width="100%" style="border-collapse: collapse;">
        <tr>
            <th class="border" style="line-height: 2rem;">Kecamatan <?= $hasil['kecamatan'] ?></th>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th class="border" rowspan="2">No</th>
                <th class="border" rowspan="2">Nama Desa</th>
                <th class="border" rowspan="2">TPS</th>
                <th class="border" colspan="<?= count($paslon) * 2 ?>">Perolehan Suara Sah</th>
                <th class="border" colspan="4">Jumlah Suara Masuk</th>
                <th class="border" colspan="5">Kehadiran</th>
            </tr>
            <tr>
                <?php foreach ($paslon as $p) : ?>
                    <th class="border" colspan="2"><?= $p['nama'] ?></th>
                <?php endforeach; ?>
                <th class="border" colspan="2">Sah</th>
                <th class="border" colspan="2">Tidak Sah</th>
                <th class="border" colspan="2">Hadir</th>
                <th class="border" colspan="2">Tidak Hadir</th>
                <th class="border">DPT</th>
            </tr>
        </thead>
        <?php for ($j = 0; $j < count($hasil['desa']); $j++) : ?>
            <tr>
                <td width="30vw" class="left-border" align="center"><?= $j + 1 ?></td>
                <td class="left-border" align="center"><?= $hasil['desa'][$j]['desa'] ?></td>
                <td width="60vw" class="border" align="center"><?= $hasil['desa'][$j]['tps'][0]['tps'] ?></td>
                <?php for ($l = 0; $l < $paslon_count; $l++) : ?>
                    <td width="60vw" class="border" align="right"><?= number_format($hasil['desa'][$j]['tps'][0]['sah'][$l]['jml_suara'], 0, "", ".") ?></td>
                    <td width="60vw" class="border" align="right">
                        <?php if ($total[$i][$j]['sah'][0] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($hasil['desa'][$j]['tps'][0]['sah'][$l]['jml_suara'] / $total[$i][$j]['sah'][0] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                <?php endfor ?>

                <td width="60vw" class="border" align="right"><?= number_format($total[$i][$j]['sah'][0], 0, "", ".") ?></td>
                <td width="60vw" class="border" align="right">
                    <?php if ($total[$i][$j]['sah'][0] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($total[$i][$j]['sah'][0] / $total[$i][$j]['jumlah'][0] * 100, 2) ?>%
                    <?php } ?>
                </td>

                <td width="60vw" class="border" align="right"><?= number_format($total[$i][$j]['tidak_sah'][0], 0, "", ".") ?></td>
                <td width="60vw" class="border" align="right">
                    <?php if ($total[$i][$j]['tidak_sah'][0] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($total[$i][$j]['tidak_sah'][0] / $total[$i][$j]['jumlah'][0] * 100, 2) ?>%
                    <?php } ?>
                </td>
                <td width="60vw" class="border" align="right"><?= number_format($total[$i][$j]['jumlah'][0], 0, "", ".") ?></td>
                <td width="60vw" class="border" align="right">
                    <?php if ($hasil['desa'][$j]['tps'][0]['dpt'] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($total[$i][$j]['jumlah'][0] / $hasil['desa'][$j]['tps'][0]['dpt'] * 100, 2) ?>%
                    <?php } ?>
                </td>
                <td width="60vw" class="border" align="right"><?= number_format($hasil['desa'][$j]['tps'][0]['dpt'] - $total[$i][$j]['jumlah'][0], 0, "", ".") ?></td>
                <td width="60vw" class="border" align="right">
                    <?php if ($hasil['desa'][$j]['tps'][0]['dpt'] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round(($hasil['desa'][$j]['tps'][0]['dpt'] - $total[$i][$j]['jumlah'][0]) / $hasil['desa'][$j]['tps'][0]['dpt'] * 100, 2) ?>%
                    <?php } ?>
                </td>
                <td width="60vw" class="border" align="right"><?= number_format($hasil['desa'][$j]['tps'][0]['dpt'], 0, "", ".") ?></td>
            </tr>


            <?php for ($k = 1; $k < count($hasil['desa'][$j]['tps']); $k++) : ?>
                <tr>
                    <td class="left-border"></td>
                    <td class="left-border"></td>
                    <td width="60vw" class="border" align="center"><?= $hasil['desa'][$j]['tps'][$k]['tps'] ?></td>
                    <?php for ($l = 0; $l < $paslon_count; $l++) : ?>
                        <td width="60vw" class="border" align="right"><?= number_format($hasil['desa'][$j]['tps'][$k]['sah'][$l]['jml_suara'], 0, "", ".") ?></td>
                        <td width="60vw" class="border" align="right">
                            <?php if ($total[$i][$j]['sah'][$k] == 0) { ?>
                                0%
                            <?php } else { ?>
                                <?= round($hasil['desa'][$j]['tps'][$k]['sah'][$l]['jml_suara'] / $total[$i][$j]['sah'][$k] * 100, 2) ?>%
                            <?php } ?>
                        </td>
                    <?php endfor ?>

                    <td width="60vw" class="border" align="right"><?= number_format($total[$i][$j]['sah'][$k], 0, "", ".") ?></td>
                    <td width="60vw" class="border" align="right">
                        <?php if ($total[$i][$j]['sah'][$k] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($total[$i][$j]['sah'][$k] / $total[$i][$j]['jumlah'][$k] * 100, 2) ?>%
                        <?php } ?>
                    </td>

                    <td width="60vw" class="border" align="right"><?= number_format($total[$i][$j]['tidak_sah'][$k], 0, "", ".") ?></td>
                    <td width="60vw" class="border" align="right">
                        <?php if ($total[$i][$j]['tidak_sah'][$k] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($total[$i][$j]['tidak_sah'][$k] / $total[$i][$j]['jumlah'][$k] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                    <td width="60vw" class="border" align="right"><?= number_format($total[$i][$j]['jumlah'][$k], 0, "", ".") ?></td>
                    <td width="60vw" class="border" align="right">
                        <?php if ($hasil['desa'][$j]['tps'][$k]['dpt'] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($total[$i][$j]['jumlah'][$k] / $hasil['desa'][$j]['tps'][$k]['dpt'] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                    <td width="60vw" class="border" align="right"><?= number_format($hasil['desa'][$j]['tps'][$k]['dpt'] - $total[$i][$j]['jumlah'][$k], 0, "", ".") ?></td>
                    <td width="60vw" class="border" align="right">
                        <?php if ($hasil['desa'][$j]['tps'][$k]['dpt'] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round(($hasil['desa'][$j]['tps'][$k]['dpt'] - $total[$i][$j]['jumlah'][$k]) / $hasil['desa'][$j]['tps'][$k]['dpt'] * 100, 2) ?>%
                        <?php } ?>
                    </td>
                    <td width="60vw" class="border" align="right"><?= number_format($hasil['desa'][$j]['tps'][$k]['dpt'], 0, "", ".") ?></td>
                </tr>
            <?php endfor ?>

            <tr>
                <td class="left-bottom-border"></td>
                <td class="left-bottom-border"></td>
                <th class="border">Total</th>
                <?php for ($l = 0; $l < $paslon_count; $l++) : ?>
                    <th class="border" align="right"><?= number_format($jumlah['paslon'][$i][$j][$l], 0, "", ".") ?></th>
                    <th class="border" align="right">
                        <?php if ($jumlah[$i][$j]['sah'] == 0) { ?>
                            0%
                        <?php } else { ?>
                            <?= round($jumlah['paslon'][$i][$j][$l] / $jumlah[$i][$j]['sah'] * 100, 2) ?>%
                        <?php } ?>
                    </th>
                <?php endfor ?>
                <th class="border" align="right"><?= number_format($jumlah[$i][$j]['sah'], 0, "", ".") ?></th>
                <th class="border" align="right">
                    <?php if ($jumlah[$i][$j]['jumlah'] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($jumlah[$i][$j]['sah'] / $jumlah[$i][$j]['jumlah'] * 100, 2) ?>%
                    <?php } ?>
                </th>
                <th class="border" align="right"><?= number_format($jumlah[$i][$j]['tidak_sah'], 0, "", ".") ?></th>
                <th class="border" align="right">
                    <?php if ($jumlah[$i][$j]['jumlah'] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($jumlah[$i][$j]['tidak_sah'] / $jumlah[$i][$j]['jumlah'] * 100, 2) ?>%
                    <?php } ?>
                </th>
                <th class="border" align="right"><?= number_format($jumlah[$i][$j]['jumlah'], 0, "", ".") ?></th>
                <th class="border" align="right">
                    <?php if ($jumlah['dpt'][$i][$j] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($jumlah[$i][$j]['jumlah'] / $jumlah['dpt'][$i][$j] * 100, 2) ?>%
                    <?php } ?>
                </th>
                <th class="border" align="right"><?= number_format($jumlah['dpt'][$i][$j] - $jumlah[$i][$j]['jumlah'], 0, "", ".") ?></th>
                <th class="border" align="right">
                    <?php if ($jumlah['dpt'][$i][$j] == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round(($jumlah['dpt'][$i][$j] - $jumlah[$i][$j]['jumlah']) / $jumlah['dpt'][$i][$j] * 100, 2) ?>%
                    <?php } ?>
                </th>
                <th class="border" align="right"><?= number_format($jumlah['dpt'][$i][$j], 0, "", ".") ?></th>
            </tr>
        <?php endfor ?>
    </table>
    <?php $i++; ?>
<?php endforeach ?>