<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <div class="shadow mb-3">
                <div class="shadow h-100 py-2">
                    <div class="body mt-3">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total saldo seluruh pengguna</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">Rp. <?= number_format($total_saldo['saldo'], 0, ',', '.') ?></div>
                                <div class="small mb-0 font-weight-bold text-gray-500 mt-2">
                                    <!-- <p>Dari 50 User</p> -->
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Daftar Member</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_member'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Tipe sortir</label>
                                <select class="form-control" name="tipe">
                                    <option value="">Tipe</option>
                                    <option value="ASC">ASC</option>
                                    <option value="DESC">DESC</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Sortir status</label>
                                <select class="form-control" name="status">
                                    <option value="">Status</option>
                                    <option value="Sudah Verifikasi">Sudah Verifikasi</option>
                                    <option value="Belum Verifikasi">Belum Verifikasi</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Member</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik Nama/Email/Username" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <?= $this->session->flashdata('message'); ?>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th width="15%">Saldo</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($daftar)) : ?>
                                    <?php $i = 1;
                                    foreach ($daftar->result() as $a) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td> <?= $a->nama ?></td>
                                            <td><?= $a->username ?></td>
                                            <td>Rp <?= number_format($a->saldo, 0, ',', '.'); ?></td>
                                            <td><?php if ($a->status == 'Tidak Aktif') : ?>
                                                    <span class="badge badge-sm p-2 badge-danger disabled">Tidak Aktif</span>
                                                <?php else : ?>
                                                    <?php if ($a->status_akun == 'Sudah Verifikasi') : ?>
                                                        <span class="badge badge-sm p-2 badge-success disabled">Sudah Verifikasi</span>
                                                    <?php elseif ($a->status_akun == 'Belum Verifikasi') : ?>
                                                        <span class="badge badge-sm p-2 badge-warning disabled">Belum Verifikasi</span>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            </td>
                                            <td><?= $a->date . ', ' . $a->time ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-rd5 btn-primary" data-toggle="modal" data-target="#editM<?= $a->id ?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-rd5 btn-danger" data-toggle="modal" data-target="#hapusM<?= $a->id ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="editMLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editMLabel">Edit Member</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url() . 'admin/edit_member'; ?>" method="post">
                                                            <div class="form-group">
                                                                <label for="username" class="col-form-label">Username :</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?= $a->username ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email" class="col-form-label">Email :</label>
                                                                <input type="text" class="form-control" id="email" name="email" value="<?= $a->email ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama" class="col-form-label">Nama :</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $a->nama ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_hp" class="col-form-label">Nomor HP :</label>
                                                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $a->no_hp ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="saldo" class="col-form-label">Saldo :</label>
                                                                <input type="number" class="form-control" id="saldo" name="saldo" value="<?= $a->saldo ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status_akun" class="col-form-label">Status Akun :</label>
                                                                <select class="form-control" id="status_akun" name="status_akun">
                                                                    <option value="<?= $a->status_akun ?>">
                                                                        <?= $a->status_akun ?> (Terpilih)
                                                                    </option>
                                                                    <?php if ($a->status_akun == 'Belum Verifikasi') : ?>
                                                                        <option value="Sudah Verifikasi">Sudah Verifikasi</option>
                                                                    <?php elseif ($a->status_akun == 'Sudah Verifikasi') : ?>
                                                                        <option value="Belum Verifikasi">Belum Verifikasi</option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status" class="col-form-label">Status :</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="<?= $a->status ?>">
                                                                        <?= $a->status ?> (Terpilih)
                                                                    </option>
                                                                    <?php if ($a->status == 'Tidak Aktif') : ?>
                                                                        <option value="Aktif">Aktif</option>
                                                                    <?php elseif ($a->status == 'Aktif') : ?>
                                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary  btn-rd5" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary btn-rd5"><i class="fa fa-edit"></i> Edit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="hapusMLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusMLabel">Hapus Member</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Member atas nama : <b><?= $a->nama ?></b><br>
                                                        Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                        <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_member/' . $a->username . ''); ?>">Hapus</a>
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