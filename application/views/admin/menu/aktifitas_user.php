<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Penggunaa Saldo</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/aktifitas_user'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Sortir Nama</label>
                                <select class="form-control" name="sortir">
                                    <option value="">Tipe</option>
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
                                <label>Cari Member</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik username member" value="">
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
                                <th>No</th>
                                <th>Member</th>
                                <th>Aksi</th>
                                <th>Browser</th>
                                <th>OS</th>
                                <th>IP</th>
                                <th>Tanggal & Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if (!empty($daftar)) : ?>
                                <?php
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><?= $i + $this->uri->segment(3); ?></td>
                                        <td> <?= $a->username ?></td>
                                        <td><?php if ($a->aksi == 'Masuk') : ?>
                                                <span class="badge badge-success btn-rd5 p-2"><?= $a->aksi ?></span>
                                            <?php elseif ($a->aksi == 'Keluar') : ?>
                                                <span class="badge badge-danger btn-rd5 p-2"><?= $a->aksi ?></span>
                                        </td><?php endif ?>

                                    <td><?= $a->browser ?></td>
                                    <td><?= $a->os ?></td>
                                    <td><?= $a->ip ?></td>
                                    <td><?= $a->date ?>, <?= $a->time ?></td>
                                    </tr>

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