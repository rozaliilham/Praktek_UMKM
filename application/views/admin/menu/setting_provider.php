<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Setting Provider</h1>
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Provider SMM</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/setting_provider') ?>" method="post">
                        <div class="form-group">
                            <label>Provider</label>
                            <input type="text" class="form-control" id="provider" name="provider" value="<?= $provider['code']; ?>" onkeyup="convertToUppercase(this)">
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" value="<?= $provider['link']; ?>">
                            <?= form_error('link', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Api ID</label>
                            <input type="text" class="form-control" name="api_id" value="<?= $provider['api_id']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Api Key</label>
                            <input type="text" class="form-control" name="api_key" value="<?= $provider['api_key']; ?>">
                        </div>
                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Link Provider SMM</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('messageLink') ?>
                    <form action="<?= base_url('admin/setting_link_provider') ?>" method="post">
                        <input type="hidden" name="code" value="<?= $provider['code']; ?>">
                        <div class="form-group">
                            <label>Link Akun</label>
                            <input type="text" class="form-control" id="link_akun" name="link_akun" value="<?= $provider['link_akun']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="link_layanan">Link Layanan</label>
                            <input type="text" class="form-control" id="link_layanan" name="link_layanan" value="<?= $provider['link_layanan']; ?>">
                            <?= form_error('link_layanan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Link Order</label>
                            <input type="text" class="form-control" name="link_order" value="<?= $provider['link_order']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Link Status</label>
                            <input type="text" class="form-control" name="link_status" value="<?= $provider['link_status']; ?>">
                        </div>
                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-exchange fa-fw"></i> Konversi Karakter</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('messageKon') ?>
                    <form action="<?= base_url('admin/setting_konversi') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="a1" name="a1" value="<?= $konversi['a1']; ?>">
                                <input type="text" class="form-control" id="a2" name="a2" value="<?= $konversi['a2']; ?>">
                                <input type="text" class="form-control" id="a3" name="a3" value="<?= $konversi['a3']; ?>">
                                <input type="text" class="form-control" id="a4" name="a4" value="<?= $konversi['a4']; ?>">
                                <input type="text" class="form-control" id="a5" name="a5" value="<?= $konversi['a5']; ?>">
                                <input type="text" class="form-control" id="a6" name="a6" value="<?= $konversi['a6']; ?>">
                                <input type="text" class="form-control" id="a7" name="a7" value="<?= $konversi['a7']; ?>">
                                <input type="text" class="form-control" id="a8" name="a8" value="<?= $konversi['a8']; ?>">
                            </div>
                            <div class="col-md-1 text-center">
                                <i class="fa fa-exchange fa-fw"></i>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="b1" name="b1" value="<?= $konversi['b1']; ?>">
                                <input type="text" class="form-control" id="b2" name="b2" value="<?= $konversi['b2']; ?>">
                                <input type="text" class="form-control" id="b3" name="b3" value="<?= $konversi['b3']; ?>">
                                <input type="text" class="form-control" id="b4" name="b4" value="<?= $konversi['b4']; ?>">
                                <input type="text" class="form-control" id="b5" name="b5" value="<?= $konversi['b5']; ?>">
                                <input type="text" class="form-control" id="b6" name="b6" value="<?= $konversi['b6']; ?>">
                                <input type="text" class="form-control" id="b7" name="b7" value="<?= $konversi['b7']; ?>">
                                <input type="text" class="form-control" id="b8" name="b8" value="<?= $konversi['b8']; ?>">
                            </div>
                        </div>
                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Provider Manual</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Provider</label>
                        <input type="text" class="form-control" id="provid" name="provid" value="<?= $manual['code']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="lin" value="<?= $manual['link']; ?>" readonly>
                        <?= form_error('link', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label>Api ID</label>
                        <input type="text" class="form-control" name="api_i" value="<?= $manual['api_id']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Api Key</label>
                        <input type="text" class="form-control" name="api_ke" value="<?= $manual['api_key']; ?>" readonly>
                    </div>

                    <!-- <button type="button" name="kirim" class="btn btn-primary btn-rd5 disabled">Submit</button> -->

                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->
<script>
    function convertToUppercase(el) {
        if (!el || !el.value) return;
        el.value = el.value.toUpperCase();
    }
</script>