<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Daftar Kategori</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_kategori'; ?>" method="post">
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
                                <label>Cari kategori</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik kategori" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>
                    </form>
                    <div class="form-group col-lg-3">
                        <label>Tambah Kategori</label>
                        <button class="btn btn-block btn-success" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus-circle"></i> Tambah Kategori</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Kode</th>
                                <th>Provider</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($daftar)) : ?>
                                <?php $i = 1;
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><?= $i + $this->uri->segment(3) ?></td>
                                        <td> <?= $a->nama ?></td>
                                        <td><?= $a->kode ?></td>
                                        <td><?= $a->provider ?></td>
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
                                                    <h5 class="modal-title" id="editMLabel">Edit Kategori</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url() . 'admin/edit_kategori'; ?>" method="post">
                                                        <input type="hidden" name="id" value="<?= $a->id ?>">
                                                        <div class="form-group">
                                                            <label for="nama" class="col-form-label">Nama Kategori :</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $a->nama ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="kode" class="col-form-label">Kode :</label>
                                                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $a->kode ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="provider" class="col-form-label">Provider :</label>
                                                            <input type="text" class="form-control" id="provider" name="provider" value="<?= $a->provider ?>">
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
                                                    Apakah Anda yakin ingin menghapus Kategori : <b><?= $a->nama ?></b><br>
                                                    Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_kategori/' . $a->id . ''); ?>">Hapus</a>
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

            <!-- Modal tambah -->
            <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="tambahMLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahMLabel">Tambah Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url() . 'admin/tambah_kategori'; ?>" method="post">
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Kategori :</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>

                                <div class="form-group">
                                    <label for="kode" class="col-form-label">Kode :</label>
                                    <input type="text" class="form-control" id="kode" name="kode">
                                </div>

                                <div class="form-group">
                                    <label for="provider" class="col-form-label">Provider :</label>
                                    <input type="text" class="form-control" id="provider" name="provider">
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