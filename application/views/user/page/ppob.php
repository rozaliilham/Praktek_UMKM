<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Pemesanan Baru</h1>
            <p class="mb-4"><i class="fa fa-info-circle fa-fw"></i> Baca Informasi yang terletak dikanan (PC/Tablet) / dibawah (Smartphone) form sebelum melakukan Submit!</p>
        </div>

        <!-- DataTales Example -->
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-shopping-cart fa-fw"></i> Pesanan Baru</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form class="form-horizontal" action="<?= base_url('dashboard/pesanbaru') ?>" method="post">
                        <div id="panel_list" class="">
                            <div class="form-group">
                                <label class="control-label" for="pesan">Tujuan</label>
                                <input type="number" class="form-control" id="nomor" name="target" value="<?= set_value('target'); ?>">
                                <?= form_error('target', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div id="rep" class="row" style="margin-top: 5px;">
                            </div>
                            <div id="catatan"></div>
                            <div id="koin"></div>
                            <div id="ajx" class="row" style="margin-top: 5px;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jumlah Pesan *</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" onkeyup="get_total(this.value).value;">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Total Harga</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="total" placeholder="0" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-danger btn-rd5 btn-bold" onclick="document.getElementById('InputID').value = ''">Reset</button>
                        <button type=" submit" name="kirim" class="float-right btn btn-primary btn-rd5 btn-bold">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.exs').click(function() {
            $('.exs').hide();
            $('#panel_list').removeClass('isi_p');
            $('#ajx').hide();
            $('#rep').show();
        });
        $('#nomor').on('keyup change input', function(e) {
            var char = $(this).val().length;
            if (char == 0) {
                normal();
            } else {
                $('#panel_list').addClass('isi_p');
                $('#ajx').show();
            }
            if ($('#tipe').val() != '0') {
                $('.type_l').html("");

                var nmr = $(this).val().split("");
                if (nmr[0] == '+') {
                    nomor($(this).val(), 6);
                } else if (nmr[0] == '6') {
                    nomor($(this).val(), 5);
                } else if (nmr[0] == '0') {
                    nomor($(this).val(), 4);
                } else {

                }
            } else {
                if (empty(char)) {
                    $('.type_l').html("")
                } else {
                    $('.type_l').html("<p style='color:red;'>pilih tipe Layanan</>")
                }

            }
        });

        $('#nomor').click(function() {
            $('.exs').show();
            $('#panel_list').addClass('isi_p');
            $('#ajx').show();
            $('#rep').hide();
        });
        normal();

        function normal() {
            $('.exs').hide();
            $('#panel_list').removeClass('isi_p');
            $('#ajx').hide();
        }

        function nomor(nomor, lengths) {
            var tipe = $('#tipe').val();
            var swit = 'reqnmr';
            var nomor = nomor;
            $.ajax({
                type: "POST",
                url: "<?= site_url('dashboard/get_pulsa'); ?>",
                data: {
                    nomor: nomor,
                    tipe: tipe,
                    swit: swit
                },
                success: function(response) {
                    var res = $.parseJSON(response);
                    var data = '';
                    var no = 1;
                    for (var i = 0; i < res.length; i++) {
                        // var la = ((res[i]['layanan'].split(" ").length == 2)?res[i]['layanan'].split(" ")[1]:res[i]['layanan']);
                        var la = res[i]['layanan'];
                        data += '<div class="col-12 list_pls" style="cursor:pointer"'
                        data += 'data-layanan="' + la +
                            '"data-harga="' + res[i]['harga'] +
                            '"data-operator="' + res[i]['operator'] +
                            '"data-id="' + res[i]['id'] +
                            '"data-service_id="' + res[i]['service_id'] +
                            '"data-tipe="' + res[i]['tipe'] +
                            '"data-deskripsi="' + res[i]['deskripsi'] + '">'
                        data += '<div class="card mb-3 clasesItem" style="border:1px solid #ccc;">'
                        data += '<div class="card-body ">'
                        data += '<h6 class="card-title m-0">' + la + ' <span style="float: right; color: #fb4802;">' + format(res[i]['harga']) + '</span></h6>'
                        data += '<p class="card-text">' + res[i]['deskripsi'] + '</p>'
                        data += ' </div>'
                        data += '</div>'
                        data += '</div>'
                    }
                    $('#ajx').html(data);
                    $('.list_pls').click(function() {
                        $('#rep').show();
                        $('#layanan').val($(this).data('service_id'));
                        normal();
                        layanan($(this).data('service_id'));
                        $('#operator').val($(this).data('operator'));
                        //requstOp($(this).data('tipe'),$(this).data('operator'));
                        rep = '<div class="col-12 " style="cursor:pointer">'
                        rep += '<div class="card mb-3" style="border:1px solid #ccc; color: #fff; background-color: #039dfc;">'
                        rep += '<div class="card-body">'
                        rep += '<h6 class="card-title m-0">' + $(this).data('layanan') + ' <span style="float: right; color: #fb4802;">' + format(parseInt($(this).data('harga'))) + '</span></h6>'
                        rep += '<p class="card-text">' + $(this).data('deskripsi') + '</p>'
                        rep += ' </div>'
                        rep += '</div>'
                        rep += '</div>'
                        $('#rep').html(rep);
                    })
                }
            });
        }

        function requstOp(tipe, kode) {
            $.ajax({
                url: '<?= site_url('dashboard/get_pulsa'); ?>',
                data: {
                    tipe: tipe,
                    kode: kode,
                    swit: 'reqOpr'
                },
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $('#operator').val(msg);
                }
            });
        }
    });

    function get_total(quantity) {
        var rate = $("#harga").val();
        var result = eval(quantity) * rate;
        if (result == NaN) {
            result = 0; //use result at the place you want
            $('#total').val(result);
        }
        $('#total').val(result);
    }
</script>