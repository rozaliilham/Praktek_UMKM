<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Setting Payment</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/payment'; ?>" method="post">
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
                                <label>Cari provider</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik provider" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>
                    </form>
                    <div class="form-group col-lg-3">
                        <label>Tambah payment</label>
                        <button class="btn btn-block btn-success" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus-circle"></i> Tambah Payment</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Tipe</th>
                                <th>Provider</th>
                                <th>Keterangan</th>
                                <th>Nama</th>
                                <th>Tujuan</th>
                                <th>Minimal</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($daftar)) : ?>
                                <?php
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><?= $a->tipe ?></td>
                                        <td><span class="badge badge-success p-2"><?= $a->provider ?></span></td>
                                        <td><?= $a->catatan ?></td>
                                        <td><?= $a->nama_penerima ?></td>
                                        <td><?= $a->tujuan ?></td>
                                        <td>Rp <?= number_format($a->minimal, 0, ',', '.') ?></td>
                                        <td><?php if ($a->status == 'Aktif') : ?>
                                                <span class="badge badge-sm p-2 badge-success disabled">Aktif</span>
                                            <?php elseif ($a->status == 'Tidak Aktif') : ?>
                                                <span class="badge badge-sm p-2 badge-danger disabled">Tidak Aktif</span>
                                            <?php endif ?>
                                        </td>

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
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMLabel">Edit Payment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url() . 'admin/edit_payment'; ?>" method="post">
                                                        <input type="hidden" name="id" value="<?= $a->id ?>">
                                                        <div class="form-group">
                                                            <label for="provider" class="col-form-label">Nama provider :</label>
                                                            <input type="text" class="form-control" id="provider" name="provider" value="<?= $a->provider ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tipe">Tipe</label>
                                                            <select class="form-control" id="tipe" name="tipe">
                                                                <?php if ($a->tipe == 'Transfer Bank') : ?>
                                                                    <option value="<?= $a->tipe; ?>"><?= $a->tipe; ?></option>
                                                                    <option value="Transfer Ewallet">Transfer Ewallet</option>
                                                                <?php elseif ($a->tipe == 'Transfer Ewallet') : ?>
                                                                    <option value="<?= $a->tipe; ?>"><?= $a->tipe; ?></option>
                                                                    <option value="Transfer Bank">Transfer Bank</option>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="catatan" class="col-form-label">Keterangan :</label>
                                                            <textarea type="text" class="form-control" id="catatan" name="catatan"><?= $a->catatan ?></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nama_penerima" class="col-form-label">Nama penerima :</label>
                                                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" value="<?= $a->nama_penerima ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tujuan" class="col-form-label">tujuan :</label>
                                                            <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?= $a->tujuan ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="minimal" class="col-form-label">Minimal :</label>
                                                            <input type="number" class="form-control" id="minimal" name="minimal" value="<?= $a->minimal ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control" id="status" name="status">
                                                                <?php if ($a->status == 'Aktif') : ?>
                                                                    <option value="<?= $a->status; ?>"><?= $a->status; ?></option>
                                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                                <?php elseif ($a->status == 'Tidak Aktif') : ?>
                                                                    <option value="<?= $a->status; ?>"><?= $a->status; ?></option>
                                                                    <option value="Aktif">Aktif</option>
                                                                <?php endif ?>
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
                                                    <h5 class="modal-title" id="hapusMLabel">Hapus Payment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus Payment : <b><?= $a->provider ?></b><br>
                                                    Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_payment/' . $a->id . ''); ?>">Hapus</a>
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

            <!-- Modal tambah -->
            <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="tambahMLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahMLabel">Tambah Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url() . 'admin/tambah_payment'; ?>" method="post">
                                <div class="form-group">
                                    <label for="provider" class="col-form-label">Nama provider :</label>
                                    <input type="text" class="form-control" id="provider" name="provider">
                                </div>

                                <div class="form-group">
                                    <label for="tipe">Tipe</label>
                                    <select class="form-control" id="tipe" name="tipe">
                                        <option value="Transfer Bank">Transfer Bank</option>
                                        <option value="Transfer Ewallet">Transfer Ewallet</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="catatan" class="col-form-label">Keterangan :</label>
                                    <textarea type="text" class="form-control" id="catatan" name="catatan"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="nama_penerima" class="col-form-label">Nama penerima :</label>
                                    <input type="text" class="form-control" id="nama_penerima" name="nama_penerima">
                                </div>

                                <div class="form-group">
                                    <label for="tujuan" class="col-form-label">tujuan :</label>
                                    <input type="text" class="form-control" id="tujuan" name="tujuan">
                                </div>

                                <div class="form-group">
                                    <label for="minimal" class="col-form-label">Minimal :</label>
                                    <input type="number" class="form-control" id="minimal" name="minimal">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-rd5" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-rd5"><i class="fa fa-plus-circle"></i> Tambah</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>