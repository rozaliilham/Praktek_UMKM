<!-- Begin Page Content -->
<div class="container-fluid">
  <?= $this->session->flashdata('message'); ?>
  <!-- Page Heading -->
  <div class="align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard
      <a target="_blank" href="<?= base_url('dashboard'); ?>" class="float-right d-sm-inline-block btn btn-sm btn-primary btn-rd5"><i class="fas fa-external-link-alt fa-sm text-white-50"></i> User</a>
    </h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="shadow mb-4 ">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> List Data</h6>
        </div>

        <div class="card-body">
          <!-- Earnings (Monthly) Card Example -->
          <div class="card mb-2">
            <div class="card border-left-primary h-100 py-2">
              <div class="card-body pb-3">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Member</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($sum_user, 0, ',', '.') ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-500"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="card mb-2">
            <div class="card border-left-success h-100 py-2">
              <div class="card-body pb-3">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Orderan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($sum_order['harga'], 0, ',', '.') ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-cart-plus fa-2x text-gray-500"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="card mb-2">
            <div class="card border-left-warning h-100 py-2">
              <div class="card-body pb-3">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Deposit</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($sum_depo['get_saldo'], 0, ',', '.') ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-database fa-2x text-gray-500"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
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
              <form action="<?= base_url() . 'admin/update_grafik1'; ?>" method="post">
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
          <?= $this->session->flashdata('message1') ?>
          <div class="chart-area">
            <canvas id="AdminChart"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Content Row -->


  <div class="row">
    <!-- Area Chart -->
    <div class="col-md-12">

      <!-- Bar Chart -->
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Penghasilan Layanan Bulanan</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="ddMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="text-center pr-2 pl-2 dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="ddMenuLink">
              <div class="dropdown-header">Setting</div>
              <form action="<?= base_url() . 'admin/update_grafik2'; ?>" method="post">
                <div class="form-group">
                  <label class="small float-left" for="tahun">Tahun</label>
                  <input type="number" class="form-control mb-1 form-control-sm" id="tahun" name="tahun_bar" placeholder="Tahun" value="<?= $grafik['tahun_bar']; ?>">
                </div>
                <div class="form-group">
                  <label class="small float-left" for="min">Min</label>
                  <input type="number" class="form-control mb-1 form-control-sm" id="min" name="min_bar" placeholder="Min" value="<?= $grafik['min_bar']; ?>">
                </div>
                <div class="form-group">
                  <label class="small float-left" for="max">Max</label>
                  <input type="number" class="form-control form-control-sm" id="max" name="max_bar" placeholder="Max" value="<?= $grafik['max_bar']; ?>">
                </div>
                <div class="dropdown-divider"></div>
                <button type="submit" class="btn btn-sm btn-primary btn-block">Simpan</button>
              </form>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?= $this->session->flashdata('message2') ?>
          <div class="chart-bar">
            <canvas id="BarChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/'); ?>js/demo/chart-bar-demo.js"></script>

  <script type="text/javascript">
    // Area Chart Example
    var ctx = document.getElementById("AdminChart");
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



    // Bar Chart Example
    var ctxx = document.getElementById("BarChart");
    var myBarChart = new Chart(ctxx, {
      type: 'bar',
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
          label: "Total",
          backgroundColor: "#4e73df",
          hoverBackgroundColor: "#2e59d9",
          borderColor: "#4e73df",
          data: [<?= $jan['harga']; ?>,
            <?= $feb['harga']; ?>,
            <?= $mar['harga']; ?>,
            <?= $apr['harga']; ?>,
            <?= $mei['harga']; ?>,
            <?= $jun['harga']; ?>,
            <?= $jul['harga']; ?>,
            <?= $ags['harga']; ?>,
            <?= $sep['harga']; ?>,
            <?= $okt['harga']; ?>,
            <?= $nov['harga']; ?>,
            <?= $des['harga']; ?>
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 20,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 12
            },
            maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              min: <?= $grafik['min_bar']; ?>,
              max: <?= $grafik['max_bar']; ?>,
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
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': Rp ' + number_format(tooltipItem.yLabel, 0, ',', '.') + ',-';
            }
          }
        },
      }
    });
  </script>
