<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800"><i class="fa fa-history"></i> Riwayat Referral</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th width="20%">Tanggal &amp; Waktu</th>
                                    <th>Aksi</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($referral)) : ?>
                                    <?php foreach ($referral->result() as $a) : ?>
                                        <tr>
                                            <td><?= $a->date . ', ' . $a->time ?></td>
                                            <td> <?php if ($a->aksi  == 'Penambahan Saldo') : ?>
                                                    <span class="btn btn-info btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true"><?= $a->aksi ?></span>
                                                <?php else : ?>
                                                    <span class="btn btn-danger btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true"><?= $a->aksi ?></span>
                                                <?php endif ?>
                                            </td>
                                            <td>Rp <?= number_format($a->nominal, 0, ',', '.'); ?></td>
                                            <td><?= $a->pesan; ?></td>
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