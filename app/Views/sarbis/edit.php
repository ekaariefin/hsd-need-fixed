<?php $validation = \Config\Services::validation(); ?>
<?= $this->include("template/header"); ?>
<?= $this->include("template/sidebar"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Sasaran Bisnis dan Kinerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Surat Peringatan</li>
                    </ol>
                </div>
            </div>
        </div>
        <form action="<?= base_url("/sarbis/process_edit") ?> " method="POST">
            <?php csrf_field(); ?>
            <section class="content">
                <div class="card card-primary animate__animated animate__bounceInRight">
                    <div class="card-header">
                        <div class="card-title">
                            Identitas Karyawan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input readonly name="employee_name" type="text" value="<?= session()->get('fnama') ?>" class="form-control" id="name" placeholder="Nama Karyawan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-3">
                                <input readonly name="user_sp" type="text" class="form-control" value="<?= session()->get('fnip') ?>">
                            </div>

                            <label for="gol" class="col-sm-3 col-form-label text-right">Gol.</label>
                            <div class="col-sm-3">
                                <input readonly name="gol" type="text" class="form-control" id="gol" value="<?= session()->get('fgrade') ?>" placeholder="Golongan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input readonly name="jabatan" type="text" class="form-control" id="jabatan" value="<?= session()->get('jabatan') ?>" placeholder="Jabatan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-sm-3 col-form-label">Satuan Kerja</label>
                            <div class="col-sm-9">
                                <input readonly name="unit" type="text" class="form-control" id="unit" value="<?= session()->get('satuan_kerja') ?>" placeholder="Unit Kerja/Cabang">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Formulir Perubahan Sasaran Bisnis dan Kinerja
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Tahun Sasaran Bisnis / Kinerja</label>
                            <div class="col-sm-9">
                                <input readonly name="tahun_sarbis" type="text" value="<?= $detailSarbis['tahun_sarbis']; ?> " class="form-control" id="tahun_sarbis">
                            </div>
                        </div>
                        <br />

                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Informasi!</h5>
                            - Pastikan Jumlah Keseluruhan Bobot Berjumlah 100%. <br />
                            - Pengisian Bobot hanya memasukkan Nilai Persen tanpa diikuti Karakter %.<br />
                            - Sasaran Bisnis dan Kinerja ke-1 hingga ke-5 Wajib, ke-6 dan ke-7 Opsional.<br />
                            - Perubahan Sasaran Bisnis akan memerlukan Otorisasi atasan anda.
                        </div>

                        <table class="table table-hover table-bordered">
                            <tr>
                                <td colspan="2" style="text-align: center; vertical-align: middle;"><b>DETAIL SASARAN BISNIS DAN KINERJA</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: middle"><b>DESKRIPSI SASARAN BISNIS</b></td>
                                <td style="text-align: center; vertical-align: middle"><b>BOBOT</b><br /><small>Contoh: 0,10 untuk 10%</small></td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis1')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis1') . "</div>";
                                    }
                                    ?>
                                    <input type="hidden" name="id_sarbis" value="<?= $detailSarbis['id_sarbis']; ?>">
                                    <textarea type="text" class="form-control" name="desc_sarbis1" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 1"><?= $detailSarbis['desc_sarbis1']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis1')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis1') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control" name="bobot_sarbis1" value="<?= $detailSarbis['bobot_sarbis1']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis2')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis2') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis2" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 2"><?= $detailSarbis['desc_sarbis2']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis2')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis2') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control" name="bobot_sarbis2" value="<?= $detailSarbis['bobot_sarbis2']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis3')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis3') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis3" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 3"><?= $detailSarbis['desc_sarbis3']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis3')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis3') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control" name="bobot_sarbis3" value="<?= $detailSarbis['bobot_sarbis3']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis4')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis4') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis4" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 4"><?= $detailSarbis['desc_sarbis4']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis4')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis4') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control" name="bobot_sarbis4" value="<?= $detailSarbis['bobot_sarbis4']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis5')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis5') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis5" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 5"><?= $detailSarbis['desc_sarbis5']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis5')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis5') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control" name="bobot_sarbis5" value="<?= $detailSarbis['bobot_sarbis5']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <textarea type="text" class="form-control" name="desc_sarbis6" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 6"><?= $detailSarbis['desc_sarbis6']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <input type="text" class="form-control" name="bobot_sarbis6" value="<?= $detailSarbis['bobot_sarbis6']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <textarea type="text" class="form-control" name="desc_sarbis7" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 7"><?= $detailSarbis['desc_sarbis7']; ?></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <input type="text" class="form-control" name="bobot_sarbis7" value="<?= $detailSarbis['bobot_sarbis7']; ?>" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Pernyataan
                        </div>
                    </div>
                    <div class="card-body">
                        <i>Dengan ini saya menyatakan sudah mengisi formulir ini dengan penuh kesadaran dan dengan data yang sebenar-benarnya.</i>
                        <button type="submit" name="submit_form_sp" class="btn btn-primary" style="margin-top: 20px;"><i class="fas fa-envelope-open-text"></i> Kirim Formulir</button>
                    </div>
                </div>
        </form>
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
            confirmButtonText: 'Saya Mengerti'
        }).then(function() {
            <?php
            session()->setFlashdata('swal_icon', '');
            ?>
            window.location.href = "<?= base_url('sarbis/list'); ?>";
        })
    <?php } ?>
</script>