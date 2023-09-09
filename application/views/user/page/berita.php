<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Berita & Informasi</h1>
        </div>

        <!-- Page Wrapper -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-bell fa-fw"></i> Berita & Informasi</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($berita)) : ?>
                                <?php foreach ($berita->result() as $m) : ?>
                                    <!-- Basic Card Example -->
                                    <?php if ($m->tipe == 'INFO') : ?>
                                        <div class="card shadow mb-4 border-left-primary">
                                        <?php elseif ($m->tipe == 'PERINGATAN') : ?>
                                            <div class="card shadow mb-4 border-left-warning">
                                            <?php elseif ($m->tipe == 'PENTING') : ?>
                                                <div class="card shadow mb-4 border-left-danger">
                                                <?php else : ?>
                                                    <li class="nav-item">
                                                    <?php endif; ?>
                                                    <div class="card-header py-3">
                                                        <h6 class="small m-0 font-weight-bold text-primary"><?= $m->title ?>
                                                            <span class="float-right"><span class="fa fa-calendar fa-fw"></span> <?= $m->date ?></span></h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <?= $m->konten ?>
                                                    </div>
                                                </div>

                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <div class="card shadow mb-4 border-left-danger">
                                                <div class="card-body">
                                                    Data tidak ada
                                                </div>
                                            </div>
                                            </tr>
                                        <?php endif ?>
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