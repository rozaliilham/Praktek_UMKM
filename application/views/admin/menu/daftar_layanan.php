<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Daftar Layanan</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-0 header-title"><i class="fas fa-clipboard-list"></i> Daftar Layanan</h4>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-lg-3">
                            <label></label>
                            <button class="btn btn-block btn-primary" type="button" name="tambah" data-toggle="modal" data-target="#Tambah">
                                <i class="fa fa-plus-circle"></i> Tambah Layanan</button>
                        </div>
                        <div class="form-group col-lg-3">
                            <label></label>
                            <button class="btn btn-block btn-warning" type="button" name="ambil" data-toggle="modal" data-target="#ambilLayanan">
                                <i class="fa fa-refresh"></i> Update Layanan
                            </button>
                        </div>
                    </div>

                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_layanan'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-2">
                                <label>Kolom Sortir</label>
                                <select class="form-control" name="kolom">
                                    <option value="">Kolom...</option>
                                    <option value="service_id">ID</option>
                                    <option value="kategori">Kategori</option>
                                    <option value="layanan">Nama Layanan</option>
                                    <option value="harga">Harga/K</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Tipe Sortir</label>
                                <select class="form-control" name="tipe">
                                    <option value="">Tipe...</option>
                                    <option value="ASC">ASC</option>
                                    <option value="DESC">DESC</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Filter Kategori</label>
                                <select class="form-control" name="kategori">
                                    <option value="" data-select2-id="3">Semua</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['kode'] ?>"><?= $k['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Cari Layanan</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik Nama Layanan" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>
                        </div>

                    </form>
                    <div class="table-responsive">
                        <?= $this->session->flashdata('message') ?>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kategori</th>
                                    <th>Nama Layanan</th>
                                    <th width="10%">Harga/K</th>
                                    <th width="10%">Harga Api</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Status</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($layanan)) : ?>
                                    <?php foreach ($layanan->result() as $a) : ?>
                                        <tr>
                                            <td><span class="badge badge-secondary p-1">#<?= $a->service_id ?></span></td>
                                            <td> <?= $a->kategori ?></td>
                                            <td><?= $a->layanan ?></td>
                                            <td>Rp <?= number_format($a->harga, 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($a->harga_api, 0, ',', '.'); ?></td>
                                            <td><?= number_format($a->min, 0, ',', '.'); ?></td>
                                            <td><?= number_format($a->max, 0, ',', '.'); ?></td>
                                            <td><?php if ($a->status == 'Aktif') : ?>
                                                    <span class="badge badge-success p-1"><?= $a->status ?></span>
                                                <?php elseif ($a->status == 'Tidak Aktif') : ?>
                                                    <span class="badge badge-danger p-1"><?= $a->status ?></span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <button type="button" class="badge badge-sm p-1 btn-rd5 badge-success" data-toggle="modal" data-target="#editM<?= $a->id ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="badge badge-sm p-1 btn-rd5 badge-primary" data-toggle="modal" data-target="#detailM<?= $a->id ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="badge badge-sm p-1 btn-rd5 badge-danger" data-toggle="modal" data-target="#hapusM<?= $a->id ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="editMLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editMLabel">Edit Layanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url() . 'admin/edit_layanan'; ?>" method="post">
                                                            <input type="hidden" name="id" value="<?= $a->id ?>">
                                                            <div class="form-group">
                                                                <label for="id_layanan" class="col-form-label">Kode Layanan :</label>
                                                                <input type="text" class="form-control" id="id_layanan" name="id_layanan" value="<?= $a->service_id ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="layanan" class="col-form-label">Layanan :</label>
                                                                <input type="text" class="form-control" id="layanan" name="layanan" value="<?= $a->layanan ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori" class="col-form-label">Kategori :</label>

                                                                <select class="form-control" name="kategori">
                                                                    <option value="<?= $a->kategori ?>"><?= $a->kategori ?></option>
                                                                    <?php foreach ($kategori as $k) : ?>
                                                                        <option value="<?= $k['kode'] ?>"><?= $k['nama'] ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="catatan" class="col-form-label">Keterangan :</label>
                                                                <textarea type="text" class="form-control" id="catatan" name="catatan"><?= $a->catatan ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="harga" class="col-form-label">Harga :</label>
                                                                <input type="number" class="form-control" id="harga" name="harga" value="<?= $a->harga ?>">
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


                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailMLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailMLabel">Detail Layanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4><?= $a->kategori ?></h4>
                                                        <p><b><?= $a->layanan ?></b> <br><br>Catatan :
                                                            <?php if ($a->status == 'Aktif') : ?>
                                                                <span class="btn btn-sm btn-rd5 btn-success float-right disabled">Status Aktif</span>
                                                            <?php else : ?>
                                                                <span class="btn btn-sm btn-rd5 btn-danger float-right disabled">Tidak Aktif</span>
                                                            <?php endif ?>
                                                        </p>
                                                        <div class="alert alert-dark" role="alert">
                                                            <?= $a->catatan ?></div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="hapusMLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusMLabel">Hapus Layanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Layanan : <b><?= $a->layanan ?></b><br>
                                                        Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                        <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_layanan/' . $a->id . ''); ?>">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach ?>
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

            <!-- Modal Tambah-->
            <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="tambahMLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahMLabel">Tambah Layanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url() . 'admin/tambah_layanan'; ?>" method="post">
                                <div class="form-group">
                                    <label for="id_layanan" class="col-form-label">Kode Layanan :</label>
                                    <input type="number" class="form-control" id="id_layanan" name="id_layanan">
                                </div>
                                <div class="form-group">
                                    <label for="layanan" class="col-form-label">Nama Layanan :</label>
                                    <input type="text" class="form-control" id="layanan" name="layanan">
                                </div>
                                <div class="form-group">
                                    <label for="kategori" class="col-form-label">Kategori :</label>

                                    <select class="form-control" name="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k['kode'] ?>"><?= $k['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <i class="form-control-feedback"></i>
                                    <small class="text-warning pull-left">* Untuk layanan Manual, silahkan buat kategori terlebih dahulu.</small>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="catatan" class="col-form-label">Keterangan :</label>
                                    <textarea type="text" class="form-control" id="catatan" name="catatan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="min" class="col-form-label">Minimal :</label>
                                    <input type="number" class="form-control" id="min" name="min">
                                </div>
                                <div class="form-group">
                                    <label for="max" class="col-form-label">Maksimal :</label>
                                    <input type="number" class="form-control" id="max" name="max">
                                </div>
                                <div class="form-group">
                                    <label for="harga" class="col-form-label">Harga :</label>
                                    <input type="number" class="form-control" id="harga" name="harga">
                                </div>
                                <div class="form-group">
                                    <label for="harga_api" class="col-form-label">Harga API :</label>
                                    <input type="number" class="form-control" id="harga_api" name="harga_api">
                                </div>
                                <div class="form-group">
                                    <label for="provider" class="col-form-label">Provider :</label>
                                    <input type="text" class="form-control" id="provider" name="provider">
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status :</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  btn-rd5" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-rd5"><i class="fa fa-plus-circle"></i> Tambah</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal Ambil Layanan -->
            <div class="modal fade" id="ambilLayanan" tabindex="-1" role="dialog" aria-labelledby="ambilMLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ambilMLabel">Update Data Layanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengupdate semua Layanan termasuk kategori Layanan<br>
                            Pilih "Update" di bawah ini jika Anda ingin mengupdate.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-warning btn-rd5" href="<?= base_url('admin/update_layanan'); ?>"><i class="fa fa-refresh"></i> Update</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>