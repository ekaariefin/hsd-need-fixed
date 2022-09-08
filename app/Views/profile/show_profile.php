<?= $this->include("template/header"); ?>
<?= $this->include("template/sidebar"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Informasi Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                Detail Informasi Karyawan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td style="width: 30%;"><b>NIP</b></td>
                                    <td><?= $info['fnip']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Nama Karyawan</b></td>
                                    <td><?= $info['fnama']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Jabatan</b></td>
                                    <td><?= $info['jabatan']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Satuan Kerja</b></td>
                                    <td><?= $info['satuan_kerja']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Departemen</b></td>
                                    <td><?= $info['departemen']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Bidang</b></td>
                                    <td><?= $info['bidang']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Fungsi</b></td>
                                    <td><?= $info['fungsi']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Golongan</b></td>
                                    <td><?= $info['fgrade']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>
                                        <?php
                                            if(empty($info['email'])){
                                                echo "<i>Email belum terdaftar</i>";
                                            }
                                            else {
                                                echo $info['email'];
                                            }
                                        ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td><b>Lokasi Kerja</b></td>
                                    <td>
                                        <?php
                                            if($info['fkode_cab'] == "99"){
                                                echo "KANTOR PUSAT";
                                            }
                                            else {
                                                echo "KANTOR CABANG";
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            
                            <table class="table" style="border: none;">
                                <tr style="border: none;">
                                    <td class="d-flex justify-content-end" style="border: none;">
                                        <a href="<?= base_url() ?>/profile/change-email" type="button" id="BtnEdit" class="btn btn-warning "> <b><i class="fas fa-edit" style="margin-right: 5px;"></i>Perbarui Email</b></a>
                                    </td>
                                </tr>
                                <div class="d-flex justify-content-end">
                                    
                                </div>
                            </table>
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