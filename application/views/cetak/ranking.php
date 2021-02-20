<?php include 'header.php' ?>

<table class="table">
    <thead>
        <tr>
            <th align="center">Ranking</th>
            <th align="center">Nama Kecamatan</th>
            <th align="center">Koordinator</th>
            <th align="center">Jumlah TPS Input</th>
            <th align="center">Jumlah TPS</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php foreach ($ranking as $rank) : ?>
            <tr>
                <td align="center" width="15%"><?= $i + 1 ?></td>
                <td width="25%"><?= $rank['kecamatan'] ?></td>
                <td width="25%"><?= $rank['koordinator'] ?></td>
                <td align="right" width=""><?= $rank['jumlah'] / $paslon_count ?></td>
                <td align="right" width=""><?= $rank['total']  ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>