<?php



?>

<div class="card card-primary">
    <div class="card-header">
        <div class="card-title">
            Beranda
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $count_all_pekerja; ?></h3>
                        <p>Karyawan Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="<?= base_url('karyawan'); ?>" class="small-box-footer">
                        Lebih Lanjut <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $count_coaching; ?></h3>
                        <p>Coaching <?= $descPeriod; ?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <a href="<?= base_url('coaching/histori-all'); ?>" class="small-box-footer">
                        Lebih Lanjut <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $count_pa; ?></h3>
                        <p>Penilaian Kinerja</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <a href="<?= base_url('penilaian/all'); ?>" class="small-box-footer">
                        Lebih Lanjut <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $count_all_sp; ?></h3>
                        <p>Sanksi Diterbitkan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <a href="<?= base_url('sp/list') ?>" class="small-box-footer">
                        Lebih Lanjut <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <h5>Grafik Jumlah Karyawan (Kantor Pusat)</h5>
                <br />
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>