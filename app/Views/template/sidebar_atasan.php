    <?php if (session()->get('fgrade') != '99') { ?>
        <li class="nav-item <?= ($active === 'entri_sarbis' || $active === 'lihat_sarbis' || $active === 'riwayat_sarbis') ? 'menu-is-opening menu-open active' : ''; ?>">
            <a href="#" class="nav-link <?= ($active === 'entri_sarbis' || $active === 'lihat_sarbis' || $active === 'riwayat_sarbis') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-bullseye"></i>
                <p>
                    Sasaran Bisnis
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('/sarbis/entri') ?>" class="nav-link <?= ($active === 'entri_sarbis') ? 'active' : ''; ?>">
                        <?= ($active === 'entri_sarbis') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                        <p>Entri Sasaran Bisnis</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/sarbis/list') ?>/<?= date('Y'); ?>" class="nav-link <?= ($active === 'lihat_sarbis') ? 'active' : ''; ?>">
                        <?= ($active === 'lihat_sarbis') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                        <p>Lihat Sasaran Bisnis</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/sarbis/riwayat') ?>" class="nav-link <?= ($active === 'riwayat_sarbis') ? 'active' : ''; ?>">
                        <?= ($active === 'riwayat_sarbis') ? '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                        <p>Riwayat Sasaran Bisnis</p>
                    </a>
                </li>
            </ul>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a href="<?= base_url('penilaian/daftar_karyawan') ?>" class="nav-link <?= ($active === 'Karyawan') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Daftar Karyawan
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('penilaian/otorisasi') ?>" class="nav-link <?= ($active === 'Otorisasi PA') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
                Otorisasi PA
            </p>
        </a>
    </li>
    <?php if (session()->get('fgrade') == '6' or session()->get('fgrade') == '7' or session()->get('fgrade') == '99' or session()->get('fgrade') == '5'  or session()->get('fgrade') == '4') { ?>
        <li class="nav-item">
            <a href="<?= base_url('sarbis/otorisasi') ?>" class="nav-link <?= ($active === 'Otorisasi Sarbis') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <p>
                    Otorisasi Sasaran Bisnis
                </p>
            </a>
        </li>
    <?php } ?>