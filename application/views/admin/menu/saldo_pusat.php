<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-lg-7 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="mt-3 fa fa-file fa-fw"></i> Saldo Pusat
                        <a href="<?= base_url('admin/update_pusat'); ?>" style="font-size:13px" class="m-2 btn btn-primary btn-rd5 font-weight-bold btn-sm float-right" role="button"><i class="fa fa-refresh"></i> Update</a>
                    </h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Provider</th>
                                    <th>Saldo</th>
                                    <th width="200px">Update Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $pusat['provider'] ?>
                                    </td>
                                    <td>Rp <?= number_format($pusat['saldo'], 0, ',', '.') ?></td>
                                    <td><?= $pusat['date'] ?>, <?= $pusat['time'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->