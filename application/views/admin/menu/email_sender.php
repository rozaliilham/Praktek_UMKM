<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-envelope fa-fw"></i> Pengaturan Email Sender</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/email_sender') ?>" method="post">

                        <div class="form-group">
                            <label for="protocol">Protocol</label>
                            <input type="text" class="form-control" id="protocol" name="protocol" value="<?= $esen['protocol']; ?>">
                            <?= form_error('protocol', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Host</label>
                            <input type="text" class="form-control" name="host" value="<?= $esen['host']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Port</label>
                            <input type="number" class="form-control" name="port" value="<?= $esen['port']; ?>">
                        </div>

                        <div class="form-group">
                            <label>User / Email</label>
                            <input type="text" class="form-control" name="email" value="<?= $esen['email']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" value="<?= $esen['password']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Charset</label>
                            <input type="text" class="form-control" name="charset" value="<?= $esen['charset']; ?>">
                        </div>

                        <button id="submit" type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->