<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Keuntungan Layanan</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/keuntungan') ?>" method="post">
                        <div class="form-group">
                            <label for="web">Harga Web</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">%</span>
                                </div>
                                <input type="number" class="form-control" id="web" name="web" value="<?= $webb['jumlah']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="api">Harga Api</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">%</span>
                                </div>
                                <input type="number" class="form-control" id="api" name="api" value="<?= $api['jumlah']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status API</label>
                            <select class="form-control" id="status" name="status">
                                <?php if ($api['status'] == 'Aktif') : ?>
                                    <option value="<?= $api['status']; ?>"><?= $api['status']; ?></option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                <?php elseif ($api['status'] == 'Tidak Aktif') : ?>
                                    <option value="<?= $api['status']; ?>"><?= $api['status']; ?></option>
                                    <option value="Aktif">Aktif</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Keuntungan Referral</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message1') ?>
                    <form action="<?= base_url('admin/referral') ?>" method="post">
                        <div class="form-group">
                            <label for="jumlah">Persentase</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">%</span>
                                </div>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $reff['jumlah']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <?php if ($reff['status'] == 'Aktif') : ?>
                                    <option value="<?= $reff['status']; ?>"><?= $reff['status']; ?></option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                <?php elseif ($reff['status'] == 'Tidak Aktif') : ?>
                                    <option value="<?= $reff['status']; ?>"><?= $reff['status']; ?></option>
                                    <option value="Aktif">Aktif</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->