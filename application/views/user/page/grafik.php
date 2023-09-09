<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <!-- Page Heading -->
    <div class="col-md-12 text-center">
      <h1 class="h4 mb-2 text-gray-800">History Order</h1>
      <p class="mb-4"><i class="fa fa-info-circle fa-fw"></i> Untuk melihat details pesanan silahkan klik/tekan order id maka akan tampil details pemesanan anda.</p>
    </div>

    <div class="col-xl-12 col-lg-12">
      <div class="card bg-info text-white shadow">
        <div class="card-body">
          <?= $sum_order ?> Pesanan
          <div class="text-gray-300 small">Dengan Total Rp <?= number_format($tot_order['harga'], 0, ',', '.') ?></div>
        </div>
      </div>
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Pemesanan</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
              <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
              </div>
              <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
              </div>
            </div>
            <canvas id="UserChartt" style="display: block; width: 545px; height: 320px;" width="545" height="320" class="chartjs-render-monitor"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>

<script type="text/javascript">
  // Area Chart Example
  var ctx = document.getElementById("UserChartt");
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
                  print "0";
                };
                echo $sum_grafik1['harga']; ?>, <?php if ($sum_grafik2['harga'] == NULL) {
                                                  print "0";
                                                };
                                                echo $sum_grafik2['harga']; ?>, <?php if ($sum_grafik3['harga'] == NULL) {
                                                                                  print "0";
                                                                                };
                                                                                echo $sum_grafik3['harga']; ?>, <?php if ($sum_grafik4['harga'] == NULL) {
                                                                                                                  print "0";
                                                                                                                };
                                                                                                                echo $sum_grafik4['harga']; ?>, <?php if ($sum_grafik5['harga'] == NULL) {
                                                                                                                                                  print "0";
                                                                                                                                                };
                                                                                                                                                echo $sum_grafik5['harga']; ?>, <?php if ($sum_grafik6['harga'] == NULL) {
                                                                                                                                                                                  print "0";
                                                                                                                                                                                };
                                                                                                                                                                                echo $sum_grafik6['harga']; ?>, <?php if ($sum_grafik7['harga'] == NULL) {
                                                                                                                                                                                                                  print "0";
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
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return '' + number_format(value);
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
            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });
</script>