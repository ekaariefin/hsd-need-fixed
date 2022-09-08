<?php $validation = \Config\Services::validation(); ?>

<?= $this->include("template/header"); ?>
<?= $this->include("template/sidebar_admin_hsd"); ?>
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
        <div class="card card-lightblue">
            <div class="card-header">
                <div class="card-title">
                    Konfigurasi Waktu Isi Formulir Sasaran Bisnis dan Kinerja
                </div>
            </div>
            <div class="card-body">
                <div class="alert bg-lightblue alert-dismissible" style="margin-top: 20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Informasi!</h5>
                    <ol>
                        <li>Harap lakukan perubahan dengan hati-hati dan berdasarkan instruksi dari atasan anda.</li>
                    </ol>
                </div>
                <form action="<?= base_url("/config/update_sarbis") ?>" method="POST">
                    <?php csrf_field(); ?>
                    <?php
                    $date_start = $date['date_start'];
                    $date_end   = $date['date_end'];
                    ?>
                    <label>Waktu Mulai Isi Formulir</label>
                    <?php
                    if ($error = $validation->getError('date_start')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('date_start') . "</div>";
                    }
                    ?>
                    <input type="date" name="date_start" class="form-control" value="<?= $date_start; ?>" placeholder="dd-mm-yyyy" min="2010-04-05" max="2050-12-31">


                    <br />
                    <label>Waktu Akhir Isi Formulir</label>
                    <?php
                    if ($error = $validation->getError('date_end')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('date_end') . "</div>";
                    }
                    ?>
                    <input type="date" name="date_end" class="form-control" value="<?= $date_end; ?>" placeholder="dd-mm-yyyy" min="2010-04-05" max="2050-12-31">
                    <br />
                    <button type="submit" class="btn bg-lightblue" name="submit_sarbis_deadline_date"> <i class="fas fa-external-link-alt" style="margin-right: 5px;"></i> Proses Pembukaan Formulir </button>
                </form>
            </div>
        </div>

    </section>
</div>
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