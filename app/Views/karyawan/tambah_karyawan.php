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
                        <li class="breadcrumb-item active">Tambah Karyawan</li>
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
                                Formulir Tambah Data Karyawan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <form action="<?= base_url("/karyawan/update") ?> " method="POST">
                                    <?php csrf_field(); ?>
                                    <tr>
                                        <td style="width: 25%;"><b>NIP</b></td>

                                        <td><input type="text" class="form-control" name="fnip"></td>

                                    </tr>
                                    <tr>
                                        <td><b>Nama Karyawan</b></td>
                                        <td><input type="text" class="form-control" name="fnama"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Jabatan</b></td>
                                        <td><input type="text" class="form-control" name="jabatan"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Fungsi</b></td>
                                        <td><input type="text" class="form-control" name="fungsi"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Bidang</b></td>
                                        <td><input type=" text" class="form-control" name="bidang"></td>
                                    </tr>

                                    <tr>
                                        <td><b>Departemen</b></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="departemen" class="form-control select2bs4" style="width: 100%;">
                                                    <option value="99999" disabled hidden selected>--PILIH DEPARTEMEN--</option>
                                                    <?php foreach ($departemen as $departemen) : ?>
                                                        <option value="<?= $departemen['id']; ?>"><?= $departemen['nama_departemen']; ?></option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Satuan Kerja</b></td>
                                        <td><input type="text" class="form-control" name="satuan_kerja" readonly></td>
                                    </tr>


                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><input type="text" class="form-control" name="email"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Golongan</b></td>
                                        <td><input type=" text" class="form-control" name="fgrade" placeholder="isikan golongan karyawan"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button type="submit" class="btn btn-success"> <b><i class="fas fa-check" style="margin-right: 5px;"></i>Simpan</b></a>
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