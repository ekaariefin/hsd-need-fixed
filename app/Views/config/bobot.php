<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfigurasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Konfigurasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Pilih Golongan Jabatan
                </div>
            </div>
            <div class="card-body">
                <div class="alert bg-primary alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Informasi!</h5>Segala perubahan berkaitan dengan bobot penilaian akan mempengaruhi penilaian PA Tahun Berjalan dan tidak mempengaruhi penilaian PA Tahun Sebelumnya</li>
                </div>
                <form action="<?= base_url('config/bobot/to_form'); ?>" method="POST">
                    <label>Pilih Golongan</label>
                    <select name="golongan" class="form-control" required>
                        <option value="">-- Pilih Golongan Jabatan --</option>
                        <option value="123-KP">GOLONGAN 1/2/3 (KANTOR PUSAT)</option>
                        <option value="123-KC">GOLONGAN 1/2/3 (KANTOR CABANG)</option>
                        <option value="4F">GOLONGAN 4 FUNGSIONAL (KANTOR PUSAT)</option>
                        <option value="4S-KP">GOLONGAN 4 STRUKTURAL (KANTOR PUSAT)</option>
                        <option value="4S-KC">GOLONGAN 4 STRUKTURAL (KANTOR CABANG)</option>
                        <option value="5F">GOLONGAN 5 FUNGSIONAL (KANTOR PUSAT)</option>
                        <option value="5S">GOLONGAN 5 STRUKTURAL (KANTOR PUSAT)</option>
                        <option value="67">GOLONGAN 6/7 (KANTOR PUSAT)</option>

                        <option value="KEPALA ULS">KEPALA ULS (KANTOR CABANG)</option>
                        <option value="KEPALA CABANG PEMBANTU">KEPALA KCP REGULER (KANTOR CABANG)</option>
                        <option value="KEPALA OPERASI CABANG">KEPALA KOC (KANTOR CABANG)</option>
                        <option value="KEPALA CABANG">KEPALA KCU (KANTOR CABANG)</option>
                        <option value="ACCOUNT OFFICER">ACCOUNT OFFICER REGULER (KANTOR CABANG)</option>
                    </select>
                    <br />
                    <button type="submit" class="btn bg-primary" name="submit_selected_golongan"> <i class="fas fa-check" style="margin-right: 5px;"></i> Submit Golongan </button>
                </form>
            </div>
        </div>
        <?php
        if ($form) {
        ?>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Konfigurasi Bobot Penilaian PA
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('config/bobot/update'); ?>" method="POST">
                        <table class="table table-bordered table-hover" style="width: 80%;">
                            <?php foreach ($listForm as $x) { ?>
                                <tr>
                                    <td style="width: 40%;"><?= $x['nama_bobot']; ?></td>
                                    <td>
                                        <input type="text" class="form-control" name="nilai_bobot_<?= $x['nama_bobot']; ?>" value="<?= $x['nilai_bobot']; ?>">
                                        <input type="hidden" class="form-control" name="golongan" value="<?= $selected_form; ?>">
                                        <input type="hidden" class="form-control" name="fkode_cab" value="<?= $x['fkode_cab']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="2">
                                    <div class="float-right">
                                        <button onclick='window.location.reload(true);' class="btn btn-warning"><i class="fas fa-redo" style="margin-right: 5px;"></i>Batalkan Perubahan</button>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save" style="margin-right: 5px;"></i>Simpan Perubahan</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        <?php } ?>
    </section>
</div>a

<?= $this->include("template/footer"); ?>
<script>
    <?php if (session()->getFlashdata('swal_icon')) { ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon') ?>',
            title: '<?= session()->getFlashdata('swal_title') ?>',
            text: '<?= session()->getFlashdata('swal_text') ?>',
            allowOutsideClick: false,
            confirmButtonText: 'Lanjutkan'
        })
    <?php } ?>
</script>