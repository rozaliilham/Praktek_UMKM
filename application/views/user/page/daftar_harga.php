<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Daftar Harga</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-clipboard-list"></i> Daftar Harga</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'dashboard/daftar_harga'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Kolom Sortir</label>
                                <select class="form-control" name="kolom">
                                    <option value="">Kolom...</option>
                                    <option value="service_id">ID</option>
                                    <option value="kategori">Kategori</option>
                                    <option value="layanan">Nama Layanan</option>
                                    <option value="harga">Harga/K</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
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
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Nama Layanan</th>
                                    <th width="10%">Harga/K</th>
                                    <th width="10%">Harga Api/K</th>
                                    <th>Min</th>
                                    <th>Max</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($layanan)) : ?>
                                    <?php foreach ($layanan->result() as $a) : ?>
                                        <tr>
                                            <td><span class="badge badge-secondary btn-rd5 disabled"><?= $a->service_id ?></span></td>
                                            <td> <?= $a->kategori ?></td>
                                            <td><?= $a->layanan ?></td>
                                            <td>Rp <?= number_format($a->harga, 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($a->harga_api, 0, ',', '.'); ?></td>
                                            <td><?= number_format($a->min, 0, ',', '.'); ?></td>
                                            <td><?= number_format($a->max, 0, ',', '.'); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-rd5 btn-primary" data-toggle="modal" data-target="#detailM<?= $a->id ?>">
                                                    <i class="fa fa-eye"></i></button>
                                            </td>
                                        </tr>


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
        </div>
    </div>
</div>