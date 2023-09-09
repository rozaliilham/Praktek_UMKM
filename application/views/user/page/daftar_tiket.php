<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Daftar Tiket</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">

        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form class="form-horizontal" action="<?= base_url() . 'dashboard/daftar_tiket'; ?>" method="post">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>Kolom Sortir</label>
                                <select class="form-control" name="kolom">
                                    <option value="">Kolom..</option>
                                    <option value="date">Tanggal &amp; Waktu</option>
                                    <option value="update_terakhir">Update Terakhir</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Filter Subjek</label>
                                <select class="form-control" name="subjek">
                                    <option value="">Semua</option>
                                    <option value="Pesanan">Pesanan</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Filter Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Semua</option>
                                    <option value="Respon">Respon</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Waiting">Waiting</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Buat Tiket</label>
                                <a href="<?= base_url('dashboard/buat_tiket') ?>" role="button" class="btn btn-block btn-success"><i class="fa fa-edit"></i> Buat Tiket Baru</a>
                            </div>
                        </div>
                    </form>


                    <div class="table-responsive" id="myTable">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th>Id Tiket</th>
                                    <th>Tgl &amp; Waktu</th>
                                    <th>Update Terakhir</th>
                                    <th>Subjek</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tiket)) : ?>
                                    <?php foreach ($tiket->result() as $a) : ?>
                                        <tr>
                                            <td>
                                                <button type="badge" class="badge btn-sm btn-rd5 badge-secondary" data-toggle="modal" data-target="#detailM<?= $a->id ?>">
                                                    <?= $a->id_tiket ?></button>

                                            </td>
                                            <td><?= $a->date . ' - ' . $a->time ?></td>
                                            <td><?= $a->update_terakhir ?></td>
                                            <td><span class="btn btn-success font-weight-bold btn-pill btn-sm disabled" aria-disabled="true"><?= $a->subjek ?></span></td>
                                            <td>
                                                <?php if ($a->status  == 'Responded') : ?>
                                                    <span class="btn btn-success btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Respon</span>
                                                <?php elseif ($a->status  == 'Pending') : ?>
                                                    <span class="btn btn-warning btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Pending</span>
                                                <?php elseif ($a->status  == 'Waiting') : ?>
                                                    <span class="btn btn-info btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Waiting</span>
                                                <?php elseif ($a->status  == 'Closed') : ?>
                                                    <span class="btn btn-danger btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Closed</span>
                                                <?php endif ?>
                                            </td>
                                            <td> <?php if ($a->status == 'Closed') : ?>
                                                    <button class="btn btn-sm btn-rd5 btn-warning">
                                                        <i class="fa fa-times-circle"></i> Tertutup
                                                    </button>
                                                <?php else : ?>
                                                    <a href="<?= base_url('user/'); ?>balas_tiket/<?= $a->id_tiket ?>" class="btn btn-primary btn-rd5 btn-pill btn-sm"><i class="fa fa-reply"></i> Balas</a>
                                                <?php endif ?>
                                            </td>
                                        </tr>


                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailMLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailMLabel">Detail Tiket</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>ID Tiket : #<?= $a->id_tiket ?></h4>
                                                        <p><b>Subjek : <?= $a->subjek ?></b> <br><br>Catatan :
                                                            <?php if ($a->status == 'Respon') : ?>
                                                                <span class="btn btn-sm btn-rd5 btn-success float-right disabled">Respon</span>
                                                            <?php elseif ($a->status == 'Pending') : ?>
                                                                <span class="btn btn-sm btn-rd5 btn-warning float-right disabled">Pending</span>
                                                            <?php elseif ($a->status == 'Waiting') : ?>
                                                                <span class="btn btn-sm btn-rd5 btn-info float-right disabled">Waiting</span>
                                                            <?php endif ?>
                                                        </p>
                                                        <div class="alert alert-dark" role="alert">
                                                            <?= $a->pesan ?></div>

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