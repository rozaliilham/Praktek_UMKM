<div class="table-responsive">
    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
        <thead>
            <tr>
                <th>ID Layanan</th>
                <th>Kategori</th>
                <th>Nama Layanan</th>
                <th>Harga/1000</th>
                <th>Harga Api/1000</th>
                <th>Min</th>
                <th>Max</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($kategori as $a) : ?>
                <tr>
                    <th scope="row"><span class="badge badge-primary"><?= $a['service_id'] ?></span></th>
                    <td><?= $a['kategori'] ?></td>
                    <td><?= $a['layanan'] ?></td>
                    <td><span class="badge badge-success">Rp <?= number_format($a['harga'], 0, ',', '.'); ?></span></td>
                    <td><span class="badge badge-warning">Rp <?= number_format($a['harga_api'], 0, ',', '.'); ?></span></td>
                    <td><span class="badge badge-danger"><?= number_format($a['min'], 0, ',', '.'); ?></span></td>
                    <td><span class="badge badge-dark"><?= number_format($a['max'], 0, ',', '.'); ?></span></td>
                    <td>
                        <?php if ($a['status'] == 'Aktif') : ?>
                            <span class="badge badge-success disabled">Aktif</span>
                        <?php elseif ($a['status'] == 'Tidak Aktif') : ?>
                            <span class="badge badge-danger disabled">Non Aktif</span>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>