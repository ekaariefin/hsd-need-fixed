<?= $this->include("template/header"); ?>


<div class="content-wrapper" style="padding-bottom: 5px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"> <a href="<?= base_url('config/coaching'); ?>">Konfigurasi</a></li>
                        <li class="breadcrumb-item active">Coaching</li>

                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="content" class="content">

        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h6 class="card-title">Jadwal Pengisian Coaching</h6>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">I. Periode Januari-Juni</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <h6>Pembukaan Formulir</h6>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="custom-select form-control" id="tanggal_buka_1" disabled>
                                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                                            <option value="<?= $i; ?>" <?= (($tanggal_buka_1 = (int)date('d', $periode_coaching[1]['tanggal_buka'])) === $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <select class="custom-select form-control" id="bulan_buka_1" onchange="selectDate(this.id)" disabled>
                                                    <?php $i = 1 ?>
                                                    <?php foreach ($months as $bulan) : ?>
                                                        <option value="<?= $i; ?>" <?= (($bulan_buka_1 = (int)date('m', $periode_coaching[1]['tanggal_buka'])) === $i) ? 'selected' : ''; ?>><?= $bulan; ?></option>
                                                        <?php $i++ ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <h6>Penutupan Formulir</h6>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="custom-select form-control" id="tanggal_tutup_1" disabled>
                                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                                            <option value="<?= $i; ?>" <?= (($tanggal_tutup_1 = (int)date('d', $periode_coaching[1]['tanggal_tutup'])) === $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <select class="custom-select form-control" id="bulan_tutup_1" onchange="selectDate(this.id,1,'tutup')" disabled>
                                                    <?php $i = 1 ?>
                                                    <?php foreach ($months as $bulan) : ?>
                                                        <option value="<?= $i; ?>" <?= (($bulan_tutup_1 = (int)date('m', $periode_coaching[1]['tanggal_tutup'])) === $i) ? 'selected' : ''; ?>><?= $bulan; ?></option>
                                                        <?php $i++ ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col" id="edit-btn-1">
                                                <button type="button" class="btn btn-warning" id="edit-btn" onclick="editConfigCoaching('1', 'open')"><i class="fas fa-edit" style="margin-right:5px;"></i>Edit</button>
                                            </div>
                                            <div class="row">
                                                <div class="col" hidden id="save-btn-1">
                                                    <button type="button" class="btn btn-secondary" onclick="editConfigCoaching('1', 'close')"><i class="fas fa-times" style="margin-right:5px;"></i>Batal</button>
                                                    <button type="button" class="btn btn-success" onclick="savePeriodeSetting('1')"><i class="fas fa-save" style="margin-right:5px;"></i>Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">II. Periode Juli-Desember</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <h6>Pembukaan Formulir</h6>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="custom-select form-control" id="tanggal_buka_2" disabled>
                                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                                            <option value="<?= $i; ?>" <?= (($tanggal_buka_2 = (int)date('d', $periode_coaching[2]['tanggal_buka'])) === $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <select class="custom-select form-control" id="bulan_buka_2" onchange="selectDate(this.id,2)" disabled>
                                                    <?php $i = 1 ?>
                                                    <?php foreach ($months as $bulan) : ?>
                                                        <option value="<?= $i; ?>" <?= (($bulan_buka_2 = (int)date('m', $periode_coaching[2]['tanggal_buka'])) === $i) ? 'selected' : ''; ?>><?= $bulan; ?></option>
                                                        <?php $i++ ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <h6>Penutupan Formulir</h6>
                                            </div>
                                            <div class=" col">
                                                <div class="form-group">
                                                    <select class="custom-select form-control" id="tanggal_tutup_2" disabled>
                                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                                            <option value="<?= $i; ?>" <?= (($tanggal_tutup_2 = (int)date('d', $periode_coaching[2]['tanggal_tutup'])) === $i) ? 'selected' : ''; ?>><?= $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <select class="custom-select form-control" id="bulan_tutup_2" onchange="selectDate(this.id,2,'tutup')" disabled>
                                                    <?php $i = 1 ?>
                                                    <?php foreach ($months as $bulan) : ?>
                                                        <option value="<?= $i; ?>" <?= (($bulan_tutup_2 = (int)date('m', $periode_coaching[2]['tanggal_tutup'])) === $i) ? 'selected' : ''; ?>><?= $bulan; ?></option>
                                                        <?php $i++ ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">

                                        <div class="row">
                                            <div class="col" id="edit-btn-2">
                                                <button type="button" class="btn btn-warning" id="edit-btn" onclick="editConfigCoaching('2', 'open')"><i class="fas fa-edit" style="margin-right:5px;"></i>Edit</button>
                                            </div>
                                            <div class="row">
                                                <div class="col" hidden id="save-btn-2">
                                                    <button type="button" class="btn btn-secondary" onclick="editConfigCoaching('2', 'close')"><i class="fas fa-times" style="margin-right:5px;"></i>Batal</button>
                                                    <button type="button" class="btn btn-success" onclick="savePeriodeSetting('2')"><i class="fas fa-save" style="margin-right:5px;"></i>Simpan</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>



    </section>
</div>

<?= $this->include("template/footer"); ?>

<script>
    var date = new Date();
    var buka_1 = new Date(<?= date('Y'); ?>, <?= $bulan_buka_1 - 1; ?>, <?= $tanggal_buka_1; ?>);
    var buka_2 = new Date(<?= date('Y'); ?>, <?= $bulan_buka_2 - 1; ?>, <?= $tanggal_buka_2; ?>);
    var tutup_1 = new Date(<?= date('Y'); ?>, <?= $bulan_tutup_1 - 1; ?>, <?= $tanggal_tutup_1; ?>);
    var tutup_2 = new Date(<?= date('Y'); ?>, <?= $bulan_tutup_2 - 1; ?>, <?= $tanggal_tutup_2; ?>);

    function setDate() {
        $("#tanggal_buka_1").val(buka_1.getDate());
        $("#bulan_buka_1").val(buka_1.getMonth() + 1);
        $("#tanggal_tutup_1").val(tutup_1.getDate());
        $("#bulan_tutup_1").val(tutup_1.getMonth() + 1);


        $("#tanggal_buka_2").val(buka_2.getDate());
        $("#bulan_buka_2").val(buka_2.getMonth() + 1);
        $("#tanggal_tutup_2").val(tutup_2.getDate());
        $("#bulan_tutup_2").val(tutup_2.getMonth() + 1);
    }
</script>