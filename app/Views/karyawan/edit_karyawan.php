<?php $validation = \Config\Services::validation(); ?>
<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Detail Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                Formulir Perubahan Data Karyawan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <form action="<?= base_url("/karyawan/update") ?> " method="POST">
                                    <?php csrf_field(); ?>
                                    <tr>
                                        <td style="width: 25%;"><b>NIP</b></td>
                                        <td>
                                            <?= $info['fnip']; ?>
                                            <input type="hidden" name="fnip" value="<?= $info['fnip']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Nama Karyawan</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('fnama')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('fnama') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="fnama" value="<?= $info['fnama']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Jabatan</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('jabatan')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('jabatan') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="jabatan" value="<?= $info['jabatan']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Satuan Kerja</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('satuan_kerja')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('satuan_kerja') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="satuan_kerja" value="<?= $info['satuan_kerja']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Departemen</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('departemen')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('departemen') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="departemen" value="<?= $info['departemen']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Bidang</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('bidang')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bidang') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="bidang" value="<?= $info['bidang']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Fungsi</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('fungsi')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('fungsi') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="fungsi" value="<?= $info['fungsi']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('email')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('email') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="email" value="<?= $info['email']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Golongan</b></td>
                                        <td>
                                            <?php
                                            if ($error = $validation->getError('fgrade')) {
                                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('fgrade') . "</div>";
                                            }
                                            ?>
                                            <input type="text" class="form-control" name="fgrade" value="<?= $info['fgrade']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button type="submit" class="btn btn-success"> <b><i class="fas fa-check" style="margin-right: 5px;"></i>Simpan Perubahan</b></a>
                                        </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
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
            confirmButtonText: 'Lanjutkan'
        });
    <?php } ?>
</script>