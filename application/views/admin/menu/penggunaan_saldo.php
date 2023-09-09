<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Penggunaa Saldo</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/penggunaan_saldo'; ?>" method="post">
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
                                <label>Filter Tipe</label>
                                <select class="form-control" name="tipe">
                                    <option value="">Semua</option>
                                    <option value="Layanan">Layanan</option>
                                    <option value="Deposit">Deposit</option>
                                    <option value="Referral">Referral</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Nama</label>
                                <input type="text" class="form-control" name="cari" placeholder="Ketik Nama Member" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                            </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Tanggal & Waktu</th>
                                <th>Member</th>
                                <th>Aksi</th>
                                <th width="13%">Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if (!empty($daftar)) : ?>
                                <?php
                                foreach ($daftar->result() as $a) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?php if ($a->tipe == 'Layanan') : ?>
                                                <span class="badge badge-success btn-rd5 p-2"><?= $a->tipe ?></span>
                                            <?php elseif ($a->tipe == 'Deposit') : ?>
                                                <span class="badge badge-warning btn-rd5 p-2"><?= $a->tipe ?></span>
                                            <?php elseif ($a->tipe == 'Referral') : ?>
                                                <span class="badge badge-info btn-rd5 p-2"><?= $a->tipe ?></span>
                                            <?php endif ?></td>
                                        <td><?= $a->date ?>, <?= $a->time ?></td>
                                        <td> <?= $a->username ?></td>
                                        <td><?php if ($a->aksi == 'Penambahan Saldo') : ?>
                                                <span class="badge badge-success btn-rd5 p-2"><?= $a->aksi ?></span>
                                            <?php elseif ($a->aksi == 'Pengurangan Saldo') : ?>
                                                <span class="badge badge-danger btn-rd5 p-2"><?= $a->aksi ?></span>
                                            <?php endif ?></td>
                                        <td>Rp <?= number_format($a->nominal, 0, ',', '.') ?></td>
                                        <td><?= $a->pesan ?></td>
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