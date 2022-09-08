<?= $this->include("template/header"); ?>
<?= $this->include("template/sidebar_admin_hsd"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Konfigurasi Deskripsi Penilaian</h3>
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
                    Pilih Subjek Penilaian
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('config/deskripsi-pa/show'); ?>" method="POST">
                    <label>Pilih Subjek Penilaian</label>
                    <select name="nama_petunjuk" class="form-control" required>
                        <option hidden value="">-- Pilih Subjek --</option>
                        <?php foreach ($list as $x) { ?>
                            <option value="<?= $x['nama_petunjuk']; ?>"><?= $x['nama_petunjuk']; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                    <button type="submit" class="btn bg-primary" name="submit_selected_golongan"> <i class="fas fa-check" style="margin-right: 5px;"></i> Submit Subjek </button>
                </form>
            </div>
        </div>
        <?php
        if ($form) {
        ?>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Konfigurasi Deskripsi Subjek Penilaian PA
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('config/deskripsi-pa/update'); ?>" method="POST">
                        <h6><b><?= $info['nama_petunjuk']; ?></b></h6>
                        <hr>
                        <p>
                            <b>Deskripsi: </b>
                        </p>
                        <input type="hidden" name="id_petunjuk" value="<?= $info['id_petunjuk']; ?>">
                        <textarea id="summernote" class="form-control" name="deskripsi"><?= $info['deskripsi']; ?></textarea>
                        <button type="submit" class="btn btn-success" style="margin-top: 20px;"><i class="fas fa-save" style="margin-right: 5px;"></i> Proses Perubahan</button>
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