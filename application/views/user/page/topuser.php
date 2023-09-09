<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <!-- Page Heading -->
    <div class="col-md-12 text-center">
      <h1 class="h4 mb-2 text-gray-800">PENGGUNA TERATAS</h1>
      <p class="mb-4">Dibawah ini merupakan top 7 pengguna dengan total pemesanan dan deposit tertinggi bulan ini. <br />Terimakasih telah menjadi pelanggan setia kami!</p>
    </div>

    <!-- DataTales Example -->
    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-trophy fa-fw"></i> 7 Pesanan Sosial Media Terbanyak</h6>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="50px">Peringkat</th>
                  <th>Nama</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($top_user as $top) : ?>
                  <?php if ($no == 1) {
                    $icon = '<i class="fa fa-trophy fa-fw text-warning"></i>';
                    $label = "success";
                  } else if ($no == 2) {
                    $icon = '';
                    $label = "primary";
                  } else if ($no == 3) {
                    $icon = '';
                    $label = "info";
                  } else if ($no == 4) {
                    $icon = '';
                    $label = "warning";
                  } else if ($no == 5) {
                    $icon = '';
                    $label = "secondary";
                  } else if ($no == 6) {
                    $icon = '';
                    $label = "dark";
                  } else if ($no == 7) {
                    $icon = '';
                    $label = "danger";
                  } ?>
                  <tr>
                    <td class="text-center">
                      <button class="btn-circle btn-<?= $label ?> btn-sm"><?= $no ?></button>
                    </td>
                    <td><?= $icon ?> <?= $top['username']; ?></td>
                    <td>Rp <?= number_format($top['jumlah'], 0, ',', '.'); ?> (<?= $top['total']; ?>)</td>
                  </tr>
                <?php $no++;
                endforeach ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>


    <!-- DataTales Example -->
    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-trophy fa-fw"></i> 7 Deposit Terbanyak</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="50px">Peringkat</th>
                  <th>Nama</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($top_depo as $top) : ?>
                  <?php if ($no == 1) {
                    $icon = '<i class="fa fa-trophy fa-fw text-warning"></i>';
                    $label = "success";
                  } else if ($no == 2) {
                    $icon = '';
                    $label = "primary";
                  } else if ($no == 3) {
                    $icon = '';
                    $label = "info";
                  } else if ($no == 4) {
                    $icon = '';
                    $label = "warning";
                  } else if ($no == 5) {
                    $icon = '';
                    $label = "secondary";
                  } else if ($no == 6) {
                    $icon = '';
                    $label = "dark";
                  } else if ($no == 7) {
                    $icon = '';
                    $label = "danger";
                  } ?>
                  <tr>
                    <td class="text-center">
                      <button class="btn-circle btn-<?= $label ?> btn-sm"><?= $no ?></button>
                    </td>
                    <td><?= $icon ?> <?= $top['username']; ?></td>
                    <td>Rp <?= number_format($top['jumlah'], 0, ',', '.'); ?> (<?= $top['total']; ?>)</td>
                  </tr>
                <?php $no++;
                endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Page Heading -->
    <div class="col-md-12 text-center">
      <h1 class="h4 mb-2 text-gray-800">LAYANAN TERATAS</h1>
      <p class="mb-4">Dibawah ini merupakan top 7 layanan dengan total pemesanan tertinggi bulan ini.<br />
        Anda dapat menjadikan daftar di bawah sebagai patokan untuk melakukan pemesanan.</p>
    </div>

    <!-- DataTales Example -->
    <div class="col-lg-8 offset-lg-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-trophy fa-fw"></i> 7 Layanan Populer</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Peringkat</th>
                  <th>Nama</th>
                  <th width="200px">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($top_layanan as $top) : ?>
                  <?php if ($no == 1) {
                    $icon = '<i class="fa fa-trophy fa-fw text-warning"></i>';
                    $label = "success";
                  } else if ($no == 2) {
                    $icon = '';
                    $label = "primary";
                  } else if ($no == 3) {
                    $icon = '';
                    $label = "info";
                  } else if ($no == 4) {
                    $icon = '';
                    $label = "warning";
                  } else if ($no == 5) {
                    $icon = '';
                    $label = "secondary";
                  } else if ($no == 6) {
                    $icon = '';
                    $label = "dark";
                  } else if ($no == 7) {
                    $icon = '';
                    $label = "danger";
                  } ?>
                  <tr>
                    <td class="text-center">
                      <button class="btn-circle btn-<?= $label ?> btn-sm"><?= $no ?></button>
                    </td>
                    <td><?= $icon ?> <?= substr($top['layanan'], 0, 35); ?>..</td>
                    <td>Rp <?= number_format($top['jumlah'], 0, ',', '.'); ?> (<?= $top['total']; ?>)</td>
                  </tr>
                <?php $no++;
                endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- /.container-fluid -->