<style>
    body {
        font-family: Arial;
    }

    .table {
        border-collapse: collapse;
        margin-top: 1rem;
        width: 100%;
        font-size: 11pt;
    }

    .table th {
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
<h3 style="text-align: center; "><?= $title ?></h3>
<table class="table">
    <thead align="center">
        <tr>
            <th align="center" rowspan="2">NO TPS</th>
            <th align="center" colspan="<?= count($paslon) ?>">Perolehan Suara Sah</th>
            <th align="center" colspan="2">Jumlah Suara Masuk</th>
        </tr>
        <tr>
            <?php foreach ($paslon as $p) : ?>
                <th align="center"><?= $p['nama'] ?></th>
            <?php endforeach; ?>
            <th align="center">Tidak Sah</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php foreach ($hasil_sah as $h) : ?>
            <tr>
                <!-- NO TPS -->
                <td align="center"><?= $h['tps'] ?></td>

                <!-- PEROLEHAN SUARA SAH -->
                <?php for ($j = 0; $j < $paslon_count; $j++) : ?>
                    <td align="right">
                        <?= number_format($h['hasil'][$j]['jml_suara'], 0, "", ".") ?><br>
                    </td>
                <?php endfor ?>

                <?php for ($j = 0; $j < $tidak_sah_count; $j++) : ?>
                    <td align="right">
                        <?= number_format($hasil_tidak_sah[$i]['hasil'][$j]['jml_suara'], 0, "", ".") ?><br>

                    </td>
                <?php endfor ?>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        <tr>
            <th>Total</th>
            <?php for ($i = 0; $i < count($jumlah['paslon']); $i++) : ?>
                <th align="right">
                    <?= number_format($jumlah['paslon'][$i], 0, "", ".") ?>
                </th>
            <?php endfor ?>
            <th align="right">
                <?= number_format($jumlah['tidak_sah'], 0, "", ".") ?>
            </th>
        </tr>
    </tbody>
</table>