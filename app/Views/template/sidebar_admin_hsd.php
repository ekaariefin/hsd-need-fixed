<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- logo bcas -->
    <a href="<?= base_url('/') ?>" class="brand-link d-flex justify-content-center">
        <span class="brand-text font-weight-light"><img src="<?= base_url('/public/') ?>/dist/img/bcas.png" height="30"></span>
    </a>

    <!-- Sidebar -->
    <div class=" sidebar">
        <!-- main sidebar -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="display: flex; align-items: center; justify-content: center;">
                <img src="<?= base_url('/public/') ?>/dist/img/blank_photo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block"><?= session()->get('fnama'); ?><br />
                    <small>
                        <?= session()->get('jabatan'); ?>
                    </small>
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link <?= ($active === 'Dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('karyawan') ?>" class="nav-link <?= ($active === 'Karyawan') ? 'active' : ''; ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Daftar Karyawan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('coaching/histori-all') ?>" class="nav-link <?= ($active === 'Riwayat Coaching') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Riwayat Coaching
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/penilaian/all') ?>" class="nav-link  <?= ($active === 'Riwayat Penilaian') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Riwayat Penilaian
                        </p>
                    </a>
                </li>

                <li class="nav-item <?= ($active === 'conf_coaching' || $active === 'conf_sarbis' || $active === 'conf_pa' || $active === "conf_bobot" || $active === 'conf_detail_pa') ? 'menu-is-opening menu-open active' : ''; ?>">

                    <a href="#" class="nav-link <?= ($active === 'conf_coaching' || $active === 'conf_sarbis' || $active === 'conf_pa' || $active === "conf_bobot" || $active === 'conf_detail_pa') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Konfigurasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('/config/coaching') ?>" class="nav-link <?= ($active === 'conf_coaching') ? 'active' : ''; ?>">
                                <?= ($active === 'conf_coaching') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Coaching</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/config/sarbis') ?>" class="nav-link <?= ($active === 'conf_sarbis') ? 'active' : ''; ?>">
                                <?= ($active === 'conf_sarbis') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Sarbis dan Kinerja</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/config/form_pa') ?>" class="nav-link <?= ($active === 'conf_pa') ? 'active' : ''; ?>">
                                <?= ($active === 'conf_pa') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Formulir PA</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/config/bobot') ?>" class="nav-link <?= ($active === 'conf_bobot') ? 'active' : ''; ?>">
                                <?= ($active === 'conf_bobot') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Bobot Penilaian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/config/deskripsi-pa') ?>" class="nav-link <?= ($active === 'conf_detail_pa') ? 'active' : ''; ?>">
                                <?= ($active === 'conf_detail_pa') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Detail Penilaian PA</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?= ($active === 'entri_sp' || $active === 'riwayat_sp') ? 'menu-is-opening menu-open active' : ''; ?>">

                    <a href="#" class="nav-link <?= ($active === 'entri_sp' || $active === 'riwayat_sp') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>
                            Sanksi/Pelanggaran
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('/sp/add') ?>" class="nav-link">
                                <?= ($active === 'entri_sp') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Entri Sanksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/sp/list') ?>" class="nav-link">
                                <?= ($active === 'riwayat_sp') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                <p>Riwayat Sanksi</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>