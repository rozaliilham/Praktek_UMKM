<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-lg-7 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="mt-3 fa fa-cogs fa-fw"></i> Setting Payment Otomatis
                    </h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/payment_oto') ?>" method="post">
                        <div class="form-group">
                            <label>Kode Merchant</label>
                            <input type="hidden" id="id" name="id" value="<?= $payment['id']; ?>">
                            <input type="text" class="form-control" id="kode_merchant" name="kode_merchant" value="<?= $payment['kode_merchant']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="api_key">Api Key</label>
                            <input type="text" class="form-control" id="api_key" name="api_key" value="<?= $payment['api_key']; ?>">
                            <?= form_error('api_key', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Private Key</label>
                            <input type="text" class="form-control" name="private_key" value="<?= $payment['private_key']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Minimal Deposit</label>
                            <input type="number" class="form-control" name="min" value="<?= $payment['min']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="mode">Mode</label>
                            <select class="form-control" id="mode" name="mode">
                                <?php if ($payment['mode'] == 'Production') : ?>
                                    <option value="<?= $payment['mode']; ?>"><?= $payment['mode']; ?></option>
                                    <option value="Sandbox">Sandbox</option>
                                <?php elseif ($payment['mode'] == 'Sandbox') : ?>
                                    <option value="<?= $payment['mode']; ?>"><?= $payment['mode']; ?></option>
                                    <option value="Production">Production</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->