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
        line-height: 2rem;
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
<?php include 'templates/header.php' ?>
<table class="table">
    <tr>
        <th>No</th>
        <th width="200vw">Nama</th>
        <th width="200vw">Nama Calon Bupati</th>
        <th width="200vw">Nama Calon Wakil Bupati</th>
        <th colspan="2">Perolehan Suara</th>
        <th>Keterangan</th>
    </tr>
    <?php $i = 0; ?>
    <?php foreach ($hasil_sah as $h) : ?>
        <?php for ($j = 0; $j < $paslon_count; $j++) : ?>
            <tr>
                <!-- NO -->
                <td class="center"><?= $i + 1 ?></td>
                <td><?= $h['hasil'][$j]['nama'] ?></td>
                <td><?= $h['hasil'][$j]['cabub'] ?></td>
                <td><?= $h['hasil'][$j]['cawabub'] ?></td>
                <td class="center"><?= number_format($h['hasil'][$j]['jml_suara'], 0, "", ".") ?></td>
                <td class="center">
                    <?php if ($total_sah == 0) { ?>
                        0%
                    <?php } else { ?>
                        <?= round($h['hasil'][$j]['jml_suara'] / $total_sah * 100, 2)  ?>%
                    <?php } ?>
                </td>
                <?php if ($j == 0) { ?>
                    <td rowspan="<?= $paslon_count ?>">
                        <table align="center">
                            <tr>
                                <td style="border: none;">Jumlah Pemilih</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($dpt['dpt'], 0, "", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;">Jumlah Kehadiran</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($hasil_tidak_sah['jml_suara'] + $total_sah, 0, "", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;">Jumlah TPS</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($tps_input + $tps_kosong, 0, "", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;">TPS Sudah input</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($tps_input, 0, "", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;">TPS Belum input</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($tps_kosong, 0, "", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;">Suara Sah</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($total_sah, 0, "", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="border: none;">Suara Tidak Sah</td>
                                <td style="border: none;">:</td>
                                <td style="border: none; text-align: right;"><?= number_format($hasil_tidak_sah['jml_suara'], 0, "", ".") ?></td>
                            </tr>

                        </table>
                    </td>
                <?php } ?>
            </tr>
            <?php $i++; ?>
        <?php endfor ?>
    <?php endforeach ?>

</table>

<table style="margin-top: 1rem;">
    <tr>
        <td><b>Catatan :</b></td>
    </tr>
    <tr>
        <td style="border: none;padding-right: 30px;">Tingkat Partisipasi Politik Masyarakat</td>
        <td style="border: none;">:</td>
        <td style="border: none;">
            <?php if ($dpt['dpt'] == 0) { ?>
                0%
            <?php } else { ?>
                <?= round(($hasil_tidak_sah['jml_suara'] + $total_sah) / $dpt['dpt'] * 100, 2)  ?>%
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td style="border: none;">Tanggal Pemungutan Suara</td>
        <td style="border: none;">:</td>
        <td style="border: none;">Rabu, 9 Desember 2020</td>
    </tr>

</table>