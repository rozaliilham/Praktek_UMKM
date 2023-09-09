<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800"><i class="fa fa-history"></i> Log Aktifitas</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <form style="margin: 20px 0;" action="<?= base_url() . 'dashboard/aktifitas'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Kolom Sortir</label>
                                <select class="form-control" name="kolom">
                                    <option value="">Pilih Kolom</option>
                                    <option value="date">Tanggal</option>
                                    <option value="ip">Alamat IP</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Tipe Sortir</label>
                                <select class="form-control" name="tipe">
                                    <option value="">Pilih Tipe</option>
                                    <option value="ASC">ASC</option>
                                    <option value="DESC">DESC</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Filter Aksi</label>
                                <select class="form-control" name="aksi">
                                    <option value="">Semua</option>
                                    <option value="Masuk">Masuk</option>
                                    <option value="Keluar">Keluar</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                                <!-- <button type="submit" class="btn btn-block btn-primary">Filter</button> -->
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTablee">
                            <thead>
                                <tr>
                                    <th>Tanggal &amp; Waktu</th>
                                    <th>Browser</th>
                                    <th>OS</th>
                                    <th>Alamat IP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($aktifitas)) : ?>
                                    <?php foreach ($aktifitas->result() as $a) : ?>
                                        <tr>
                                            <td><?= $a->date . ', ' . $a->time ?></td>
                                            <td><?= $a->browser; ?></td>
                                            <td><?= $a->os; ?></td>
                                            <td><?= $a->ip; ?></td>
                                            <td><?php if ($a->aksi  == 'Masuk') : ?>
                                                    <span class="btn btn-info btn-rd5 btn-pill btn-sm disabled" aria-disabled="true"><?= $a->aksi ?></span>
                                                <?php else : ?>
                                                    <span class="btn btn-danger btn-rd5 btn-pill btn-sm disabled" aria-disabled="true"><?= $a->aksi ?></span>
                                                <?php endif ?></td>
                                        </tr>
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