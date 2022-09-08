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
<?php if (session()->get('fgrade') == '6' or session()->get('fgrade') == '7') { ?>
    <li class="nav-item">
        <a href="<?= base_url('sarbis/otorisasi') ?>" class="nav-link <?= ($active === 'Otorisasi Sarbis') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>
                Otorisasi Sasaran Bisnis
            </p>
        </a>
    </li>
<?php } ?>