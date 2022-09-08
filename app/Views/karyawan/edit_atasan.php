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
                        <li class="breadcrumb-item active">Ubah Detail Atasan Pekerja</li>
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
                                Formulir Perubahan Atasan Pekerja
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <form action="<?= base_url("/karyawan/update_spv") ?> " method="POST">
                                    <?php csrf_field(); ?>
                                    <tr>
                                        <td style="width: 25%;"><b>NIP</b></td>
                                        <td>
                                            <?= $info['fnip']; ?>
                                            <input type="hidden" name="user_nip" value="<?= $info['fnip']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%;"><b>Nama Karyawan</b></td>
                                        <td>
                                            <?= $info['fnama']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%;"><b>Nama Atasan<br><small><i>saat ini</i></small></b></td>
                                        <td>
                                            <?= $atasan1_nama ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Nama Atasan<br><small><i>pengganti</i></small></b></td>
                                        <td><input name="employee_name" type="text" class="form-control" id="name" placeholder="Nama Atasan" required></td>
                                    </tr>
                                    <tr>
                                        <td><b>NIP Atasan</b></td>
                                        <td><input readonly name="atasan_nip" type="text" class="form-control" id="nip" placeholder="NIP Atasan"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Golongan</b></td>
                                        <td><input readonly name="gol" type="text" class="form-control" id="gol" placeholder="Gol. Atasan"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Jabatan</b></td>
                                        <td><input readonly name="jabatan" type="text" class="form-control" id="jabatan" placeholder="Jabatan Atasan"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Unit Kerja/Cabang</b></td>
                                        <td><input readonly name="unit" type="text" class="form-control" id="unit" placeholder="Unit Kerja/Cabang Atasan"></td>
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