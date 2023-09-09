<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    Rp <?= number_format($tot_reff['jumlah_reff'], 0, ',', '.') ?>
                    <div class="text-gray-300 small">Dari <?= $sum_reff ?> user </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-bar"></i> Grafik Income Bulanan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="p-2 dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="text-center dropdown-header">Setting</div>
                            <form action="<?= base_url() . 'dashboard/update_grafik_user'; ?>" method="post">
                                <div class="form-group">
                                    <label class="small float-left" for="tahun">Tahun</label>
                                    <input type="number" class="form-control mb-1 form-control-sm" id="tahun" name="tahun_ref" placeholder="Tahun" value="<?= $grafik['tahun_ref']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="small float-left" for="min">Min</label>
                                    <input type="number" class="form-control mb-1 form-control-sm" id="min" name="min_ref" placeholder="Min" value="<?= $grafik['min_ref']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="small float-left" for="max">Max</label>
                                    <input type="number" class="form-control form-control-sm" id="max" name="max_ref" placeholder="Max" value="<?= $grafik['max_ref']; ?>">
                                </div>
                                <div class="dropdown-divider"></div>
                                <button type="submit" class="btn btn-sm btn-primary btn-block">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
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
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
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
                data: [
                    <?php if ($jan['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $jan['jumlah']; ?>,
                    <?php if ($feb['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $feb['jumlah']; ?>,
                    <?php if ($mar['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $mar['jumlah']; ?>,
                    <?php if ($apr['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $apr['jumlah']; ?>,
                    <?php if ($mei['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $mei['jumlah']; ?>,
                    <?php if ($jun['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $jun['jumlah']; ?>,
                    <?php if ($jul['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $jul['jumlah']; ?>,
                    <?php if ($ags['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $ags['jumlah']; ?>,
                    <?php if ($sep['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $sep['jumlah']; ?>,
                    <?php if ($okt['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $okt['jumlah']; ?>,
                    <?php if ($nov['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $nov['jumlah']; ?>,
                    <?php if ($des['jumlah'] == NULL) {
                        echo 0;
                    }
                    echo $des['jumlah']; ?>
                ],
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
                        min: <?= $grafik['min_ref']; ?>,
                        max: <?= $grafik['max_ref']; ?>,
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