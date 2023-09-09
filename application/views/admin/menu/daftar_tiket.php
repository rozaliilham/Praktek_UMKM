<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Daftar Tiket</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_tiket'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Sortir Nama</label>
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
                                    <option value="pending">Pending</option>
                                    <option value="Responded">Responded</option>
                                    <option value="Waiting">Waiting</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Kode</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik kodetiket" value="">
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
                                <th>Tanggal & Waktu</th>
                                <th>Member</th>
                                <th>Update Terakhir</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($daftar)) : ?>
                                <?php
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><span class="badge badge-secondary btn-rd5 p-2">#<?= $a->id_tiket ?></span></td>
                                        <td><?= $a->date ?>, <?= $a->time ?></td>
                                        <td> <?= $a->user ?></td>
                                        <td><?= $a->update_terakhir ?></td>
                                        <td><?= $a->subjek ?></td>
                                        <td>
                                            <?php if ($a->status == 'Pending') : ?>
                                                <span class="badge p-2 badge-warning disabled"><?= $a->status ?></span>
                                            <?php elseif ($a->status == 'Responded') : ?>
                                                <span class="badge p-2 badge-success disabled"><?= $a->status ?></span>
                                            <?php elseif ($a->status == 'Waiting') : ?>
                                                <span class="badge p-2 badge-info disabled"><?= $a->status ?></span>
                                            <?php elseif ($a->status == 'Closed') : ?>
                                                <span class="badge p-2 badge-danger disabled"><?= $a->status ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($a->status == 'Closed') : ?>
                                                <button class="btn btn-sm btn-rd5 btn-warning">
                                                    <i class="fa fa-times-circle"></i> Tertutup
                                                </button>
                                            <?php else : ?>
                                                <a href="<?= base_url('admin/'); ?>balas_tiket/<?= $a->id_tiket ?>" class="btn btn-sm btn-rd5 btn-primary">
                                                    <i data-toggle="tooltip" data-placement="top" title="Balas" class="fa fa-reply"></i>
                                                </a>
                                                <button class="btn btn-sm btn-rd5 btn-warning" data-toggle="modal" data-target="#tutupM<?= $a->id ?>">
                                                    <i data-toggle="tooltip" data-placement="top" title="Tutup" class="fa fa-times-circle"></i>
                                                </button>
                                            <?php endif; ?>
                                            <button class="btn btn-sm btn-rd5 btn-danger" data-toggle="modal" data-target="#hapusM<?= $a->id ?>">
                                                <i data-toggle="tooltip" data-placement="top" title="Hapus" class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Tutup -->
                                    <div class="modal fade" id="tutupM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="tutupMLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tutupMLabel">Tutup Tiket</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menutup Tiket dengan kode : <b><?= $a->id_tiket ?></b><br>
                                                    Pilih "Tutup" di bawah ini jika Anda ingin menutupnya.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-warning btn-rd5" href="<?= base_url('admin/tutup_tiket/' . $a->id_tiket . ''); ?>">Tutup</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="hapusMLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusMLabel">Hapus Tiket</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus Tiket kode : <b><?= $a->id_tiket ?></b><br>
                                                    Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_tiket/' . $a->id_tiket . ''); ?>">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
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