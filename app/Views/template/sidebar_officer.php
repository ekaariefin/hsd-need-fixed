<li class="nav-item">
    <a href="#" class="nav-link <?= ($active === 'Sasaran Bisnis') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-bullseye"></i>
        <p>
            Sasaran Bisnis
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= base_url('/sarbis/entri') ?>" class="nav-link">
                <?= ($active === 'Sasaran Bisnis') ?  '<i class="far fa-dot-circle nav-icon"></i>' : '<i class="far fa-circle nav-icon"></i>'; ?>
                <p>Entri Sasaran Bisnis</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('/sarbis/list') ?>/<?= date('Y'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Sasaran Bisnis</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('/sarbis/riwayat') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Riwayat Sasaran Bisnis</p>
            </a>
        </li>
    </ul>
</li>