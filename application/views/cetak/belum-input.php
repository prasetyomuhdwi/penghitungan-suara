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
<?php include 'header.php' ?>
<?php if ($kecamatan) { ?>

    <body>


        <table class="table">
            <?php $i = 0; ?>
            <?php foreach ($kecamatan as $kec) : ?>

                <tr>
                    <th width="10%">No</th>
                    <th width="40%">Kecamatan</th>
                    <th width="20%">Nama Desa</th>
                    <th width="30%">TPS</th>
                </tr>
                <tr>
                    <td rowspan="<?= count($kec['desa']) + 1 ?>" align="center"><?= $i + 1 ?></td>
                    <td rowspan="<?= count($kec['desa']) + 1 ?>" align="center">
                        <b>Kecamatan <?= $kec['kecamatan'] ?></b><br>
                        Koordinator : <?= $kec['koordinator'] ?>
                    </td>
                </tr>
                <?php for ($j = 0; $j < count($kec['desa']); $j++) : ?>
                    <tr>
                        <td><?= $kec['desa'][$j]['desa'] ?></td>
                        <td>
                            <?php for ($k = 0; $k < count($kec['desa'][$j]['tps']); $k++) : ?>
                                [<?= $kec['desa'][$j]['tps'][$k]['tps'] ?>]
                            <?php endfor ?>
                        </td>
                    </tr>
                <?php endfor ?>

                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    <?php } else { ?>
        <i>Semua TPS Sudah Terinput!</i>
    <?php } ?>
    </body>