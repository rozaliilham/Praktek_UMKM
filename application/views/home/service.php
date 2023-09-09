        <!-- Start Service -->
        <section class="features">
            <div class="container">

                <div class="row mb-5">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="box">
                            <h4 class="m-t-0 header-title text-center"><b>Daftar Harga Layanan</b></h4>
                            <form class="form-horizontal" role="form" method="POST">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori" required>
                                        <option value="0">Pilih Salah Satu</option>
                                        <?php foreach ($kategori as $row) : ?>
                                            <option value="<?= $row->kode; ?>"><?= $row->nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body shadow p-3 mb-5 bg-white rounded" id="layanan"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Service -->

        </div>
        <!-- End App -->

        <script type="text/javascript" src="<?= base_url() . 'assets/js/jquery-3.3.1.js' ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#kategori').change(function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('home/getService'); ?>',
                        data: {
                            kategori: this.value
                        },
                        cache: false,
                        success: function(response) {
                            $('#layanan').html(response).show(600);;
                        }
                    });
                });
            });
        </script>