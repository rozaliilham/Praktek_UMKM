<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Daftar Deposit</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_deposit'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Tipe Sortir</label>
                                <select class="form-control" name="tipe">
                                    <option value="">Tipe</option>
                                    <option value="ASC">ASC</option>
                                    <option value="DESC">DESC</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Filter status</label>
                                <select class="form-control" name="status">
                                    <option value="">Semua</option>
                                    <option value="success">Success</option>
                                    <option value="pending">Pending</option>
                                    <option value="error">Error</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Kode Deposit</label>
                                <input type="number" class="form-control" name="cari" placeholder="Ketik kode deposit" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Member</th>
                                <th>Tipe</th>
                                <th>Provider</th>
                                <th>Pengirim</th>
                                <th>Penerima</th>
                                <th>Jumlah TF</th>
                                <th>Get saldo</th>
                                <th>status</th>
                                <th>Tanggal</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($daftar)) : ?>
                                <?php $i = 1;
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><span class="badge badge-secondary btn-rd5 p-2">#<?= $a->kode_deposit ?></span></td>
                                        <td> <?= $a->username ?></td>
                                        <td><?= $a->tipe ?></td>
                                        <td><?= $a->provider ?></td>
                                        <td><?= $a->pengirim ?></td>
                                        <td><?= $a->penerima ?></td>
                                        <td>Rp <?= number_format($a->jumlah_transfer, 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($a->get_saldo, 0, ',', '.') ?></td>
                                        <form action="<?= base_url() . 'admin/status_deposit'; ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $a->kode_deposit ?>">
                                            <td>
                                                <?php if ($a->status == 'Pending') : ?>
                                                    <?php if ($a->metode == 'OTO') : ?>
                                                        <span class="badge p-2 badge-warning disabled"><?= $a->status ?></span>
                                                        <?php else : ?>   
                                                        <select class="form-control" style="width: 110px;" id="status" name="status">
                                                            <option value="<?= $a->status ?>"><?= $a->status ?></option>
                                                            <option value="Success">Success</option>
                                                            <option value="Error">Error</option>
                                                        </select>
                                                    <?php endif ?>
                                                <?php elseif ($a->status == 'Success') : ?>
                                                    <span class="badge p-2 badge-success disabled"><?= $a->status ?></span>
                                                <?php elseif ($a->status == 'Error') : ?>
                                                    <span class="badge p-2 badge-danger disabled"><?= $a->status ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $a->date ?>, <?= $a->time ?></td>

                                            <td>
                                                <?php if ($a->metode !== 'OTO') : ?>
                                                <?php if ($a->status == 'Pending') : ?>
                                                    <button type="submit" class="badge badge-sm btn-rd5 badge-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                        </form>
                                        <?php if ($a->metode == 'OTO') : ?>
                                            <span class="badge p-2 badge-success btn-rd5 disabled">
                                                <i class="fa fa-time"></i> Otomatis
                                            </span>
                                        <?php else : ?>    
                                            <button class="badge badge-sm btn-rd5 badge-danger" data-toggle="modal" data-target="#hapusM<?= $a->id ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        <?php endif ?>
                                        </td>
                                    </tr>


                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="hapusMLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusMLabel">Hapus Deposit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus Deposit dengan kode : <b><?= $a->kode_deposit ?></b><br>
                                                    Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_deposit/' . $a->id . ''); ?>">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php $i++;
                                endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan='5'>Data tidak ada</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <div>
                        <ul class="pagination pagination-split">
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">
                                    <b>Total data: <?= $total; ?></b>
                                </span>
                            </li>
                            <?php echo $pagination; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>