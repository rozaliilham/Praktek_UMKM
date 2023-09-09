<?php
$status       = $this->db->get_where('tiket', ['status' => 'Pending'])->num_rows();
$status_depo  = $this->db->get_where('deposit', ['status' => 'Pending'])->num_rows();
$status_wd    = $this->db->get_where('withdraw', ['status' => 'Pending'])->num_rows();
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3"><?= $web['nama_web']; ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url('admin'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu Admin
  </div>

  <!-- Nav Item - Trophy-->
  <?php if ($type == "Daftar Member | ") : ?>
    <li class="nav-item active">
    <?php else : ?>
    <li class="nav-item">
    <?php endif; ?>

    <a class="nav-link" href="<?= base_url('admin/daftar_member'); ?>">
      <i class="fas fa-fw fa-user"></i>
      <span>Daftar Member</span>
    </a>
    </li>

    <!-- Nav Item - Charts -->
    <?php if ($type == "Daftar Orderan | ") : ?>
      <li class="nav-item active">
      <?php else : ?>
      <li class="nav-item">
      <?php endif; ?>

      <a class="nav-link" href="<?= base_url('admin/daftar_orderan'); ?>">
        <i class="fas fa-fw fa-cart-plus"></i>
        <span>Daftar Orderan</span>
      </a>
      </li>

      <!-- Nav Item - Charts -->
      <?php if ($type == "Daftar Layanan | ") : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>

        <a class="nav-link" href="<?= base_url('admin/daftar_layanan'); ?>">
          <i class="fas fa-fw fa-list"></i>
          <span>Daftar Layanan</span>
        </a>
        </li>

        <?php if ($type == "Daftar Kategori | ") : ?>
          <li class="nav-item active">
          <?php else : ?>
          <li class="nav-item">
          <?php endif; ?>

          <a class="nav-link" href="<?= base_url('admin/daftar_kategori'); ?>">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Daftar Kategori</span>
          </a>
          </li>

          <?php if ($type == "Daftar Deposit | ") : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>

            <a class="nav-link" href="<?= base_url('admin/daftar_deposit'); ?>">
              <i class="fas fa-fw fa-credit-card"></i>
              <span>Daftar Deposit</span>
              <?php if (!$status_depo == 0) : ?>
                <span class="ml-2 badge badge-danger"><?= $status_depo ?></span>
              <?php endif ?>
            </a>
            </li>

            <?php if ($type == "Daftar Tiket | ") : ?>
              <li class="nav-item active">
              <?php else : ?>
              <li class="nav-item">
              <?php endif; ?>

              <a class="nav-link" href="<?= base_url('admin/daftar_tiket'); ?>">
                <i class="fas fa-fw fa-paper-plane"></i>
                <span>Daftar Tiket </span>
                <?php if (!$status == 0) : ?>
                  <span class="ml-2 badge badge-danger"><?= $status ?></span>
                <?php endif ?>
              </a>
              </li>

              <?php if ($type == "Daftar Withdraw | ") : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>

                <a class="nav-link" href="<?= base_url('admin/daftar_withdraw'); ?>">
                  <i class="fas fa-fw fa-money"></i>
                  <span>Daftar Withdraw </span>
                  <?php if (!$status_wd == 0) : ?>
                    <span class="ml-2 badge badge-danger"><?= $status_wd ?></span>
                  <?php endif ?>
                </a>
                </li>

                <?php if ($type == "Daftar Berita | ") : ?>
                  <li class="nav-item active">
                  <?php else : ?>
                  <li class="nav-item">
                  <?php endif; ?>

                  <a class="nav-link" href="<?= base_url('admin/daftar_berita'); ?>">
                    <i class="fas fa-fw fa-bell"></i>
                    <span>Daftar Berita</span>
                  </a>
                  </li>

                  <!-- Divider -->
                  <hr class="sidebar-divider">

                  <!-- Heading -->
                  <div class="sidebar-heading">
                    Aktifitas
                  </div>


                  <?php if ($type == "Penggunaan Saldo | ") : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>

                    <a class="nav-link" href="<?= base_url('admin/penggunaan_saldo'); ?>">
                      <i class="fas fa-fw fa-history"></i>
                      <span>Penggunaan Saldo</span>
                    </a>
                    </li>


                    <?php if ($type == "Aktifitas User | ") : ?>
                      <li class="nav-item active">
                      <?php else : ?>
                      <li class="nav-item">
                      <?php endif; ?>

                      <a class="nav-link" href="<?= base_url('admin/aktifitas_user'); ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Aktifitas User</span>
                      </a>
                      </li>

                      <!-- Divider -->
                      <hr class="sidebar-divider">

                      <!-- Heading -->
                      <div class="sidebar-heading">
                        Pengaturan
                      </div>

                      <!-- Nav Item - Tables -->
                      <?php if ($type == "Setting Website | ") : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>

                        <a class="nav-link" href="<?= base_url('admin/website'); ?>">
                          <i class="fas fa-fw fa-globe"></i>
                          <span>Website</span></a>
                        </li>

                        <!-- Nav Item - Tables -->
                        <?php if ($type == "Setting email sender | ") : ?>
                          <li class="nav-item active">
                          <?php else : ?>
                          <li class="nav-item">
                          <?php endif; ?>

                          <a class="nav-link" href="<?= base_url('admin/email_sender'); ?>">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>Email sender</span></a>
                          </li>
                          <!-- Nav Item - Tables -->

                          <?php if ($type == "Setting Kontak | ") : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>

                            <a class="nav-link" href="<?= base_url('admin/kontak'); ?>">
                              <i class="fas fa-fw fa-phone"></i>
                              <span>Kontak</span>
                            </a>
                            </li>

                            <?php if ($type == "Setting Payment | ") : ?>
                              <li class="nav-item active">
                              <?php else : ?>
                              <li class="nav-item">
                              <?php endif; ?>

                              <a class="nav-link" href="<?= base_url('admin/payment'); ?>">
                                <i class="fas fa-fw fa-credit-card"></i>
                                <span>Payment</span>
                              </a>
                              </li>

                            <?php if ($type == "Payment Otomatis | ") : ?>
                              <li class="nav-item active">
                              <?php else : ?>
                              <li class="nav-item">
                              <?php endif; ?>

                              <a class="nav-link" href="<?= base_url('admin/payment_oto'); ?>">
                                <i class="fas fa-fw fa-credit-card"></i>
                                <span>Payment Oto</span>
                              </a>
                              </li>

                              <?php if ($type == "Setting Keuntungan | ") : ?>
                                <li class="nav-item active">
                                <?php else : ?>
                                <li class="nav-item">
                                <?php endif; ?>

                                <a class="nav-link" href="<?= base_url('admin/keuntungan'); ?>">
                                  <i class="fas fa-fw fa-line-chart"></i>
                                  <span>Keuntungan</span>
                                </a>
                                </li>
                                <!-- 
                            <?php if ($type == "Setting Keuntungan | ") : ?>
                              <li class="nav-item active">
                              <?php else : ?>
                              <li class="nav-item">
                              <?php endif; ?>

                              <a class="nav-link" href="<?= base_url('admin/keuntungan'); ?>">
                                <i class="fas fa-fw fa-money-bill"></i>
                                <span>Keuntungan</span>
                              </a>
                              </li> -->

                                <!-- Divider -->
                                <hr class="sidebar-divider">

                                <!-- Heading -->
                                <div class="sidebar-heading">
                                  Provider
                                </div>

                                <!-- Nav Item - Tables -->
                                <?php if ($type == "Saldo Pusat | ") : ?>
                                  <li class="nav-item active">
                                  <?php else : ?>
                                  <li class="nav-item">
                                  <?php endif; ?>

                                  <a class="nav-link" href="<?= base_url('admin/saldo_pusat'); ?>">
                                    <i class="fas fa-fw fa-file"></i>
                                    <span>Saldo Pusat</span>
                                  </a>
                                  </li>
                                  <!-- Nav Item - Tables -->

                                  <!-- Nav Item - Tables -->
                                  <?php if ($type == "Setting Provider | ") : ?>
                                    <li class="nav-item active">
                                    <?php else : ?>
                                    <li class="nav-item">
                                    <?php endif; ?>

                                    <a class="nav-link" href="<?= base_url('admin/setting_provider'); ?>">
                                      <i class="fas fa-fw fa-cog"></i>
                                      <span>Setting Provider</span>
                                    </a>
                                    </li>
                                    <!-- Nav Item - Tables -->

                                    <!-- Divider -->
                                    <hr class="sidebar-divider d-none d-md-block">

                                    <!-- Sidebar Toggler (Sidebar) -->
                                    <div class="text-center d-none d-md-inline">
                                      <button class="rounded-circle border-0" id="sidebarToggle"></button>
                                    </div>

</ul>
<!-- End of Sidebar -->