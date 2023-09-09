<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Daftar Berita</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_berita'; ?>" method="post">
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
                                    <option value="INFO">INFO</option>
                                    <option value="PERINGATAN">PERINGATAN</option>
                                    <option value="PENTING">PENTING</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Tambah Berita</label>
                                <button class="btn btn-block btn-primary" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus-circle"></i> Tambah Berita</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Kategori</th>
                                <th>Tipe</th>
                                <th>Konten</th>
                                <th>Tanggal & waktu</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($daftar)) : ?>
                                <?php $i = 1;
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><?= $i + $this->uri->segment(3) ?></td>
                                        <td><?= $a->title ?></td>
                                        <td><?= $a->icon ?></td>
                                        <td><?= $a->tipe ?></td>
                                        <td><?= $a->konten ?></td>
                                        <td> <?= $a->date ?>, <?= $a->time ?></td>

                                        <td>
                                            <button class="badge badge-sm btn-rd5 badge-primary" data-toggle="modal" data-target="#editM<?= $a->id ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="badge badge-sm btn-rd5 badge-danger" data-toggle="modal" data-target="#hapusM<?= $a->id ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="editMLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMLabel">Edit Berita</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url() . 'admin/edit_berita'; ?>" method="post">
                                                        <input type="hidden" name="id" value="<?= $a->id ?>">
                                                        <div class="form-group">
                                                            <label for="nama" class="col-form-label">Nama Berita :</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $a->title ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="kategori" class="col-form-label">Kategori :</label>
                                                            <select class="form-control" id="kategori" name="kategori">
                                                                <option value="<?= $a->icon ?>"><?= $a->icon ?></option>
                                                                <option value="LAYANAN">LAYANAN</option>
                                                                <option value="PESANAN">PESANAN</option>
                                                                <option value="DEPOSIT">DEPOSIT</option>
                                                                <option value="PENGGUNA">PENGGUNA</option>
                                                                <option value="PROMO">PEROMO
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tipe" class="col-form-label">Tipe :</label>
                                                            <select class="form-control" id="tipe" name="tipe">
                                                                <option value="<?= $a->tipe ?>"><?= $a->tipe ?></option>
                                                                <option value="INFO">INFO</option>
                                                                <option value="PERINGATAN">PERINGATAN</option>
                                                                <option value="PENTING">PENTING</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="konten" class="col-form-label">Konten :</label>
                                                            <textarea type="text" class="form-control" id="konten" name="konten"><?= $a->konten ?></textarea>
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
                                                    <h5 class="modal-title" id="hapusMLabel">Hapus Berita</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus Berita : <b><?= $a->title ?></b><br>
                                                    Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary btn-rd5" type="button" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger btn-rd5" href="<?= base_url('admin/hapus_berita/' . $a->id . ''); ?>">Hapus</a>
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
                            <h5 class="modal-title" id="tambahMLabel">Tambah Berita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url() . 'admin/tambah_berita'; ?>" method="post">
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama Berita :</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>

                                <div class="form-group">
                                    <label for="kategori" class="col-form-label">Kategori :</label>
                                    <select class="form-control" id="kategori" name="kategori">
                                        <option value="LAYANAN">LAYANAN</option>
                                        <option value="PESANAN">PESANAN</option>
                                        <option value="DEPOSIT">DEPOSIT</option>
                                        <option value="PENGGUNA">PENGGUNA</option>
                                        <option value="PROMO">PEROMO
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tipe" class="col-form-label">Tipe :</label>
                                    <select class="form-control" id="tipe" name="tipe">
                                        <option value="INFO">INFO</option>
                                        <option value="PENTING">PENTING</option>
                                        <option value="PERINGATAN">PERINGATAN</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="konten" class="col-form-label">Konten :</label>
                                    <textarea type="text" class="form-control" id="konten" name="konten"></textarea>
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