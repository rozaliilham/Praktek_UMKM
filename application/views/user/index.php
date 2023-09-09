<!-- Begin Page Content -->
<div class="container-fluid">

  <?= $this->session->flashdata('message'); ?>
  <?= $this->session->flashdata('message1'); ?>

  <!-- Page Heading -->
  <div class="align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard
      <a href="<?= base_url('dashboard/pesanbaru'); ?>" class="float-right d-sm-inline-block btn btn-sm btn-primary btn-rd5"><i class="fas fa-shopping-cart fa-sm text-white"></i></a>
    </h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <?php if ($referral['status'] == 'Aktif') : ?>
      <div class="col-md-12 mb-3">
        <div class="card bg-primary text-white shadow">
          <div class="card-body">
            <b>Dapatkan Saldo Gratis!</b>
            <div class="mt-2 text-white small">Syaratnya Mudah Banget.</div>
            <div class="text-white small">Ajak Temen atau Keluarga kamu untuk mendaftar disini dengan kode Referral kamu.</div>
            <a href="<?= base_url('dashboard/daftar_referral'); ?>" class="mt-3 btn btn-sm btn-warning btn-rd5"><b><i class="fa fa-eye"></i> Cek disini</b></a>
          </div>
        </div>
      </div>
    <?php endif ?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Saya</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($user['saldo'], 0, ',', '.') ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-wallet fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <?php if ($referral['status'] == 'Aktif') : ?>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saldo Refferal</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($user['saldo_referral'], 0, ',', '.') ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-gift fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pesanan</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp <?= number_format($sum_order['harga'], 0, ',', '.') ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Deposit</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($sum_depo['get_saldo'], 0, ',', '.') ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-database fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Content Row -->

    <!-- Area Chart -->
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Pesanan 7 Hari Terakhir</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="text-center pr-2 pl-2 dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Setting</div>
              <form action="<?= base_url() . 'dashboard/update_grafik_user1'; ?>" method="post">
                <div class="form-group">
                  <label class="small float-left" for="min">Min</label>
                  <input type="number" class="form-control mb-1 form-control-sm" id="min" name="min" placeholder="Min" value="<?= $grafik['min']; ?>">
                </div>
                <div class="form-group">
                  <label class="small float-left" for="max">Max</label>
                  <input type="number" class="form-control form-control-sm" id="max" name="max" placeholder="Max" value="<?= $grafik['max']; ?>">
                </div>
                <div class="dropdown-divider"></div>
                <button type="submit" class="btn btn-sm btn-primary btn-block">Simpan</button>
              </form>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="UserChart"></canvas>
          </div>
        </div>
      </div>
    </div>



        <div class="col-md-6">
          <!-- Illustrations -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-bell fa-fw"></i> Berita & Informasi</h6>
            </div>
            <div class="card-body">
              <?php foreach ($berita as $m) : ?>
                <!-- Basic Card Example -->
                <?php if ($m['tipe'] == 'INFO') : ?>
                  <div class="card shadow mb-4 border-left-primary">
                <?php elseif ($m['tipe'] == 'PERINGATAN') : ?>
                  <div class="card shadow mb-4 border-left-warning">
                <?php elseif ($m['tipe'] == 'PENTING') : ?>
                  <div class="card shadow mb-4 border-left-danger">
                <?php endif; ?>
                      <div class="card-header py-3">
                        <h6 class="small m-0 font-weight-bold text-primary"><?= $m['title']; ?>
                          <span class="float-right pr-2"><span class="fa fa-calendar fa-fw"></span> <?= $m['date']; ?></span></h6>
                      </div>
                      <div class="card-body">
                        <?= nl2br(substr($m['konten'], 0, 100)); ?>
                      </div>
                  </div>
              <?php endforeach ?>
                    <a href="<?= base_url('dashboard/berita'); ?>" class="btn btn-block btn-sm btn-primary text-center"><i class="fa fa-eye"></i> Lihat Semua</a>
                  
            </div>
          </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="font-weight-bold text-primary"><i class="mt-3 fa fa-history fa-fw"></i> 10 Riwayat Orderan
                <div class="m-2 font-weight-bold btn-sm float-right">
                  <div id="refr" class="refr">
                    <a id="update" href="<?= base_url('home/update_status/user'); ?>" style="font-size:13px" class="btn btn-primary btn-rd5" role="button"><i class="fa fa-refresh"></i></a>
                  </div>
                  <div id="wait" style="display:none;" class="wait">
                    <button style="font-size:13px" class="btn btn-primary btn-rd5 disabled"><i class="fa fa-refresh fa-spin"></i></button>
                  </div>
                </div>
              </h6>
            </div>
            <div class="card-body">
              <?= $this->session->flashdata('message1'); ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Layanan</th>
                      <th>Harga</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($riw_pem as $d) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $d['date'] ?></td>
                        <td><?= $d['layanan'] ?></td>
                        <td><?= $d['harga'] ?></td>
                        <td><?php if ($d['status'] == 'Success') : ?>
                            <span class="btn btn-primary btn-rd5 btn-pill btn-sm disabled"><?= $d['status'] ?></span>
                          <?php elseif ($d['status'] == 'Pending') : ?>
                            <span class="btn btn-warning btn-rd5 btn-pill btn-sm disabled"><?= $d['status'] ?></span>
                          <?php elseif ($d['status'] == 'Processing') : ?>
                            <span class="btn btn-success btn-rd5 btn-pill btn-sm disabled"><?= $d['status'] ?></span>
                          <?php elseif ($d['status'] == 'Partial') : ?>
                            <span class="btn btn-secondary btn-rd5 btn-pill btn-sm disabled"><?= $d['status'] ?></span>
                          <?php elseif ($d['status'] == 'Error') : ?>
                            <span class="btn btn-danger btn-rd5 btn-pill btn-sm disabled"><?= $d['status'] ?></span>
                          <?php else : ?>
                            <span class="btn btn-primary btn-rd5 btn-pill btn-sm disabled"><?= $d['status'] ?></span>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php $i++;
                    endforeach ?>
                  </tbody>
                </table>
              </div>
              <a href="<?= base_url('dashboard/riwayat_order'); ?>" class="btn btn-block btn-sm btn-primary text-center"><i class="fa fa-eye"></i> Lihat Semua</a>
            </div>
          </div>
        </div>
        
  

        <div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="tambahMLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div id="txt" class="modal-body"></div>
            </div>
          </div>
        </div>

        <?php if ($user['read_news'] == 0) : ?>
          <div class="modal fade show" id="News" tabindex="-1" role="dialog" aria-labelledby="NewsInfo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title mt-0" id="NewsInfo"><b><i class="fa fa-bell text-primary"></i> Berita & Informasi</b></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow: auto;">
                  <?php foreach ($berita as $m) : ?>
                    <!-- Basic Card Example -->
                    <?php if ($m['tipe'] == 'INFO') : ?>
                      <div class="card shadow mb-4 border-left-primary">
                      <?php elseif ($m['tipe'] == 'PERINGATAN') : ?>
                        <div class="card shadow mb-4 border-left-warning">
                        <?php elseif ($m['tipe'] == 'PENTING') : ?>
                          <div class="card shadow mb-4 border-left-danger">
                          <?php endif; ?>
                          <div class="card-header py-3">
                            <h6 class="small m-0 font-weight-bold text-primary"><?= $m['title']; ?>
                              <span class="float-right pr-2"><span class="fa fa-calendar fa-fw"></span> <?= $m['date']; ?></span></h6>
                          </div>
                          <div class="card-body">
                            <?= nl2br(substr($m['konten'], 0, 100)); ?>
                          </div>
                          </div>
                        <?php endforeach ?>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                          <button type="button" id="button_News" class="btn btn-primary" data-dismiss="modal">Saya Sudah Membaca</button>
                        </div>
                      </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif ?>
  </div>
</div>

            <!-- Page level plugins -->
            <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>

            <script type="text/javascript">
              $(document).ready(function() {
                //Refresh data
                $(document).ajaxStart(function() {
                  $("#wait").css("display", "block");
                  $("#refr").css("display", "none");
                });
                $(document).ajaxComplete(function() {
                  $("#wait").css("display", "none");
                  $("#refr").css("display", "block");
                });
                $("#update").click(function() {
                  $("#txt").load("<?= site_url('home/update_status/user'); ?>");
                });

                $('#News').modal('show');

                $('#button_News').click(function() {
                  $.ajax({
                    type: "GET",
                    url: "<?= site_url('user/get_news'); ?>"
                  });
                })
              });
              // Area Chart Example
              var ctx = document.getElementById("UserChart");
              var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: ["<?= $grafik1['date']; ?>", "<?= $grafik2['date']; ?>", "<?= $grafik3['date']; ?>", "<?= $grafik4['date']; ?>", "<?= $grafik5['date']; ?>", "<?= $grafik6['date']; ?>", "<?= $grafik7['date']; ?>"],
                  datasets: [{
                    label: "Total",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [<?php if ($sum_grafik1['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik1['harga'] . ',';
                            if ($sum_grafik2['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik2['harga'] . ',';
                            if ($sum_grafik3['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik3['harga'] . ',';
                            if ($sum_grafik4['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik4['harga'] . ',';
                            if ($sum_grafik5['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik5['harga'] . ',';
                            if ($sum_grafik6['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik6['harga'] . ',';
                            if ($sum_grafik7['harga'] == NULL) {
                              echo "0";
                            };
                            echo $sum_grafik7['harga']; ?>],
                  }],
                },
                options: {
                  maintainAspectRatio: false,
                  layout: {
                    padding: {
                      left: 10,
                      right: 25,
                      top: 25,
                      bottom: 0
                    }
                  },
                  scales: {
                    xAxes: [{
                      time: {
                        unit: 'date'
                      },
                      gridLines: {
                        display: false,
                        drawBorder: false
                      },
                      ticks: {
                        maxTicksLimit: 7
                      }
                    }],
                    yAxes: [{
                      ticks: {
                        min: <?= $grafik['min']; ?>,
                        max: <?= $grafik['max']; ?>,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                          return number_format(value, 0, ',', '.');
                        }
                      },
                      gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                      }
                    }],
                  },
                  legend: {
                    display: false
                  },
                  tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                      label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Rp ' + number_format(tooltipItem.yLabel, 0, ',', '.') + ',-';
                      }
                    }
                  }
                }
              });
            </script>

            <!--Start of Tawk.to Script-->
            <script type="text/javascript">
              var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
              (function() {
                var s1 = document.createElement("script"),
                  s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/5eca19f8c75cbf1769eec926/1ep37heni';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
              })();
            </script>
            <!--End of Tawk.to Script-->