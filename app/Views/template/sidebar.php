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
                <?php if (session()->get('role') != '1' or session()->get('role') != '2') { ?>
                    <a href="<?= base_url('profile') ?>" class="d-block">
                    <?php } else { ?>
                        <a href="#" class="d-block">
                        <?php } ?>
                        <?php
                        if (strlen(session()->get('fnama')) <= 18) {
                            echo session()->get('fnama');
                        } else {
                            echo "<marquee scrolldelay='200'>" . session()->get('fnama') . "</marquee>";
                        } ?><br />
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
                <?php if (session()->get('jabatan') != 'PENGURUS BCA SYARIAH' || session()->satuan_kerja != "PENGURUS BCA SYARIAH" || session()->departemen != "DIREKTUR") { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/penilaian/riwayat') ?>" class="nav-link <?= ($active === 'Riwayat Penilaian') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                Riwayat Penilaian
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if (strtolower(session()->jabatan) !== strtolower("PENGURUS BCA SYARIAH")) : ?>
                    <?php if (session()->get('role') == "3") : ?>
                        <li class="nav-item <?= ($active === 'Tambah Coaching' || $active === 'Riwayat Coaching') ? 'menu-is-opening menu-open active' : ''; ?>">
                            <a href="" class="nav-link <?= ($active === 'Tambah Coaching' || $active === 'Riwayat Coaching') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Data Coaching
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="<?= base_url('/coaching') ?>" class="nav-link <?= ($active === 'Tambah Coaching') ? 'active' : ''; ?>">
                                        <?= ($active === 'Tambah Coaching') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                        <p>Tambah Coaching</p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('/coaching/histori') ?>" class="nav-link <?= ($active === 'Riwayat Coaching') ? 'active' : ''; ?>">
                                        <?= ($active === 'Riwayat Coaching') ?  '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                                        <p>Riwayat Coaching</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php elseif (session()->get('role') == "4") : ?>
                        <li class="nav-item">
                            <a href="<?= base_url('/coaching/histori') ?>" class="nav-link <?= ($active === 'Riwayat Coaching') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Data Coaching
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/coaching') ?>" class="nav-link <?= ($active === 'Tambah Coaching') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Data Coaching
                            </p>
                        </a>
                    </li>

                <?php endif; ?>
                <?php if (session()->get('jabatan') != 'PENGURUS BCA SYARIAH') { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/penilaian/formulir') ?>" class="nav-link <?= ($active === 'Penilaian PA') ? 'active' : ''; ?>">
                            <i class="nav-icon fab fa-wpforms"></i>
                            <p>
                                Formulir Penilaian PA
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- menu tambahan sidebar untuk role tertentu -->
                <?php
                $fgrade = session()->get('fgrade');
                $jabatan = trim(session()->get('jabatan'));
                $fkode_cab = session()->get('fkode_cab');

                // dd('abc');

                //KANTOR PUSAT
                if ($fgrade == "4" and $jabatan == "KEPALA BAGIAN" and $fkode_cab == "99") {
                    echo $this->include("template/sidebar_atasan");
                } else if ($fgrade == '4' and $jabatan == "ASSOCIATE OFFICER") {
                } else if (($fgrade == "5" or $fgrade == "6" or $fgrade == "7" or $fgrade == "99") and $jabatan != "OFFICER" and $fkode_cab == "99") {
                    echo $this->include("template/sidebar_atasan");
                } else if ($fgrade == "5" and $jabatan == "OFFICER") {
                    echo $this->include("template/sidebar_atasan");
                }

                //KANTOR CABANG
                $sidebar_atasan = array(
                    "ASSOCIATE OFFICER",
                    "KEPALA OPERASI CABANG",
                    "KEPALA CABANG",
                    "KEPALA CABANG PEMBANTU",
                    "KEPALA ULS"
                );
                if (in_array(trim($jabatan), $sidebar_atasan)) {
                    echo $this->include("template/sidebar_atasan");
                }


                // dd($jabatan);

                $sidebar_kabag = array(
                    "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                    "KEPALA BAGIAN OPERASIONAL",
                    "KEPALA BAGIAN CUSTOMER SERVICE"
                );
                if (in_array($jabatan, $sidebar_kabag) and $fkode_cab != '99') {
                    echo $this->include("template/sidebar_kabag");
                }

                $sidebar_ao = array(
                    "ACCOUNT OFFICER",
                    "ASSISTANT ACCOUNT OFFICER",
                    "ASSISTANT ACCOUNT OFFICER ",
                    "ASSOCIATE ACCOUNT OFFICER"
                );
                if (in_array($jabatan, $sidebar_ao) and $fkode_cab != '99') {
                    echo $this->include("template/sidebar_officer");
                }


                ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>