<?php foreach ($layanan as $a) : ?>
    <div class="form-group">
        <label>Harga/K </label>
        <div class="input-group">
            <div class="input-group-addon">
                <span class="input-group-text">Rp</span>
            </div>
            <span class="form-control"><?= number_format($a['harga'], 0, ',', '.') ?></span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Min. Order</label>
            <span class="form-control" id="min" readonly=""><?= number_format($a['min'], 0, ',', '.') ?></span>
        </div>
        <div class="form-group col-md-6">
            <label>Maks. Order</label>
            <span class="form-control" id="max" readonly=""><?= number_format($a['max'], 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" id="catatan" name="catatan" style="height: 100px" readonly=""><?= $a['catatan'] ?></textarea>
    </div>

    <input type="hidden" id="harga" name="harga" value="<?= $a['harga'] / 1000 ?>">
    <input type="hidden" id="min" name="min" value="<?= $a['min'] ?>">
    <input type="hidden" id="max" name="max" value="<?= $a['max'] ?>">

<?php endforeach ?>