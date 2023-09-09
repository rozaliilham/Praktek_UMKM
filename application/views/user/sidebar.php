<?php
$users = $this->session->userdata('username');
$this->db->where('user', $users);
$status = $this->db->get_where('tiket', ['status' => 'Responded'])->num_rows();
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
    <div class="sidebar-brand-icon">
      <i class="fas fa-home"></i>
    </div>
    <div class="sidebar-brand-text mx-3"><?= $web['nama_web']; ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <?php if ($type == "Dahboard | ") : ?>
    <li class="nav-item active">
    <?php else : ?>
    <li class="nav-item">
    <?php endif; ?>

    <a class="nav-link" href="<?= base_url(); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Menu User
    </div>

    <!-- Nav Item - Trophy-->
    <?php if ($type == "Top User | ") : ?>
      <li class="nav-item active">
      <?php else : ?>
      <li class="nav-item">
      <?php endif; ?>

      <a class="nav-link" href="<?= base_url('dashboard/topuser'); ?>">
        <i class="fas fa-fw fa-trophy"></i>
        <span>Top User</span>
      </a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <?php if ($type == 'Pesan Baru | ') : ?>
        <li class="nav-item active">
        <?php elseif ($type == 'Riwayat Oder | ') : ?>
        <li class="nav-item active">
        <?php elseif ($type == 'Grafik Order | ') : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Order</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilih Menu :</h6>
            <a class="collapse-item" href="<?= base_url('dashboard/pesanbaru'); ?>">Pesan Baru</a>
            <a class="collapse-item" href="<?= base_url('dashboard/riwayat_order'); ?>">Riwayat</a>
            <a class="collapse-item" href="<?= base_url('dashboard/grafik'); ?>">Grafik</a>
          </div>
        </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <?php if ($type == 'Deposit Baru | ') : ?>
          <li class="nav-item active">
          <?php elseif ($type == 'Riwayat Deposit | ') : ?>
          <li class="nav-item active">
          <?php else : ?>
          <li class="nav-item">
          <?php endif; ?>

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-university"></i>
            <span>Deposit</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Pilih Menu :</h6>
              <a class="collapse-item" href="<?= base_url('dashboard/deposit'); ?>">Deposit Baru</a>
              <a class="collapse-item" href="<?= base_url('dashboard/riwayat_depo'); ?>">Riwayat</a>
            </div>
          </div>
          </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <?php if ($type == 'Withdraw | ') : ?>
          <li class="nav-item active">
          <?php elseif ($type == 'Data Withdraw | ') : ?>
          <li class="nav-item active">
          <?php else : ?>
          <li class="nav-item">
          <?php endif; ?>

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities23" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-money"></i>
            <span>Withdraw</span>
          </a>
          <div id="collapseUtilities23" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Pilih Menu :</h6>
              <a class="collapse-item" href="<?= base_url('dashboard/withdraw'); ?>">Withdraw</a>
              <a class="collapse-item" href="<?= base_url('dashboard/data_withdraw'); ?>">Data Withdraw</a>
            </div>
          </div>
          </li>

          <!-- Nav Item - Pages Collapse Menu -->
          <?php if ($type == 'Buat Tiket | ') : ?>
            <li class="nav-item active">
            <?php elseif ($type == 'Daftar Tiket | ') : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-envelope"></i>
              <span>Tiket</span>
              <?php if (!$status == 0) : ?>
                <span class="ml-2 badge badge-danger"><?= $status ?></span>
              <?php endif ?>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilih Menu :</h6>
                <a class="collapse-item" href="<?= base_url('dashboard/buat_tiket'); ?>">Buat Tiket</a>
                <a class="collapse-item" href="<?= base_url('dashboard/daftar_tiket'); ?>">Daftar Tiket
                  <?php if (!$status == 0) : ?>
                    <span class="ml-2 badge badge-danger"><?= $status ?></span>
                  <?php endif ?>
                </a>
              </div>
            </div>
            </li>

            <!-- Nav Item - Charts -->
            <?php $persen = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();
            if ($persen['status'] == 'Aktif') : ?>
              <?php if ($type == 'Daftar Referral | ') : ?>
                <li class="nav-item active">
                <?php elseif ($type == 'Riwayat Referral | ') : ?>
                <li class="nav-item active">
                <?php elseif ($type == 'Grafik Referral | ') : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess1" aria-expanded="true" aria-controls="collapsePages">
                  <i class="fas fa-fw fa-tv"></i>
                  <span>Referral</span>
                </a>
                <div id="collapsePagess1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pilih Menu :</h6>
                    <a class="collapse-item" href="<?= base_url('dashboard/daftar_referral'); ?>">Daftar</a>
                    <a class="collapse-item" href="<?= base_url('dashboard/referral'); ?>">Grafik</a>
                    <a class="collapse-item" href="<?= base_url('dashboard/riwayat_referral'); ?>">Riwayat</a>
                  </div>
                </div>
                </li>
              <?php endif ?>
              <!-- Nav Item - Charts -->
              <?php if ($type == "Daftar Harga | ") : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>

                <a class="nav-link" href="<?= base_url('dashboard/daftar_harga'); ?>">
                  <i class="fas fa-fw fa-list-alt"></i>
                  <span>Daftar Harga</span>
                </a>
                </li>

              <!-- Nav Item - Charts -->
              <?php if ($type == "Dokumentasi | ") : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>

                <a class="nav-link" href="<?= base_url('dashboard/dokumentasi'); ?>">
                  <i class="fas fa-fw fa-book"></i>
                  <span>Dokumentasi API</span>
                </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                  Halaman
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <?php if ($type == 'Kontak Kami | ') : ?>
                  <li class="nav-item active">
                  <?php elseif ($type == 'Ketentuan Layanan | ') : ?>
                  <li class="nav-item active">
                  <?php elseif ($type == 'Pertanyaan Umum | ') : ?>
                  <li class="nav-item active">
                  <?php else : ?>
                  <li class="nav-item">
                  <?php endif; ?>

                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesss" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Informasi</span>
                  </a>
                  <div id="collapsePagesss" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Pilih Menu :</h6>
                      <a class="collapse-item" href="<?= base_url('dashboard/kontak'); ?>">Kontak kami</a>
                      <a class="collapse-item" href="<?= base_url('dashboard/ketentuan'); ?>">Ketentuan Layanan</a>
                      <a class="collapse-item" href="<?= base_url('dashboard/pertanyaan'); ?>">Pertanyaan Umum</a>
                    </div>
                  </div>
                  </li>

                  <!-- Nav Item - Pages Collapse Menu -->
                  <?php if ($type == 'Log Aktifitas | ') : ?>
                    <li class="nav-item active">
                    <?php elseif ($type == 'Mutasi Saldo | ') : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif ?>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseP" aria-expanded="true" aria-controls="collapsePages">
                      <i class="fas fa-fw fa-history"></i>
                      <span>Log</span>
                    </a>
                    <div id="collapseP" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Menu :</h6>
                        <a class="collapse-item" href="<?= base_url('dashboard/aktifitas'); ?>">Aktifitas</a>
                        <a class="collapse-item" href="<?= base_url('dashboard/mutasi'); ?>">Mutasi Saldo</a>
                      </div>
                    </div>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                      Akun
                    </div>

                    <!-- Nav Item - Tables -->
                    <li class="nav-item">
                      <a class="nav-link" href="<?= base_url('user/setting'); ?>">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Setting</span></a>
                    </li>
                    <!-- Nav Item - Tables -->
                    <li class="nav-item">
                      <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Keluar</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                      <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

</ul>
<!-- End of Sidebar -->