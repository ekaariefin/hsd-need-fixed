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
                <a href="#" class="d-block"><?= session()->get('fnama'); ?><br />
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
                        <p> Beranda </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user') ?>" class="nav-link <?= ($active === 'user') ? 'active' : ''; ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p> Daftar User </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('log') ?>" class="nav-link <?= ($active === 'log') ? 'active' : ''; ?>">
                        <i class="nav-icon fa fa-clipboard-list"></i>
                        <p> Audit Trail</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>