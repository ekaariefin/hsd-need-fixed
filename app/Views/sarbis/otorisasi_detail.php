<?= $this->include("template/header"); ?>
<?= $this->include("template/sidebar"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sasaran Bisnis dan Kinerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sasaran Bisnis dan Kinerja</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Informasi Karyawan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td style="width: 20%; font-weight:bold">NIP</td>
                        <td style="width: 30%;"><?= $detailSarbis['user_nip']; ?></td>
                        <td style="width: 20%; font-weight:bold">Nama Karyawan</td>
                        <td style="width: 30%; text-transform: uppercase;"><?= $detailSarbis['fnama']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; font-weight:bold">Jabatan</td>
                        <td><?= $detailSarbis['jabatan']; ?> </td>
                        <td style="width: 20%; font-weight:bold">Satuan Kerja</td>
                        <td><?= $detailSarbis['satuan_kerja']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; font-weight:bold">Departemen/Cabang</td>
                        <td><?= $detailSarbis['departemen']; ?> </td>
                        <td style="width: 20%; font-weight:bold">Fungsi</td>
                        <td><?= $detailSarbis['fungsi']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; font-weight:bold">Atasan 1</td>
                        <td><?= $atasan1 ?></td>
                        <td style="width: 20%; font-weight:bold">Atasan 2</td>
                        <td><?= $atasan2 ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Sasaran Bisnis dan Kinerja
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <!-- MARK: JIKA SUDAH DISETUJUI MAKA HILANGKAN BUTTON -->
                    <?php if($markStatus != 'Approved'){ ?>
                        <a href="<?= base_url() ?>/sarbis/otorisasi/proses/<?= $detailSarbis['id_sarbis']; ?>" type="button" class="btn btn-success " style="display: flex;justify-content: right;margin-left:10px;"> <b><i class="fas fa-check-circle" style="margin-right: 5px;"></i>Setujui </b></a>
                    <?php } else { ?>
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td style="text-align: center;background-color:#28A745;color:white"><i><b>Sasaran Bisnis ini sudah disetujui dan tidak dapat dilakukan perubahan kembali</b></i></td>
                            </tr>
                        </table>
                    <?php } ?>
                </div>
                <table class="table table-bordered table-hover" style="width: 50%;">
                    <tr>
                        <td>Tahun Sasaran Bisnis</td>
                        <td>
                            <?= $detailSarbis['tahun_sarbis']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Penerbitan</td>
                        <td>
                            <?php
                                $created_at = strtotime($detailSarbis['created_at']);
                                $created_at = date('d F Y H:i:s', $created_at);
                                echo $created_at.' WIB';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Perubahan</td>
                        <td>
                            <?php
                                $created_at = strtotime($detailSarbis['updated_at']);
                                $created_at = date('d F Y H:i:s', $created_at);
                                echo $created_at.' WIB';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Status Persetujuan</td>
                        <td>
                        <?php
                            if(empty($detailSarbis['approval1']) AND empty($detailSarbis['approval2'])){
                                echo '<span class="badge bg-warning">Menunggu Persetujuan</span>';
                            }
                            else if(empty($detailSarbis['approval1']) OR empty($detailSarbis['approval2'])){
                                echo '<span class="badge bg-warning">Dalam Peninjauan</span>';
                            }
                            else {
                                echo '<span class="badge bg-success">Disetujui</span>';
                            }
                        ?>
                        </td>
                    </tr>
                </table>
                
                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                    <tr>
                        <th></th>
                        <th style="width: 60%;">Deskripsi</th>
                        <th style="width: 20%;">Bobot</th>
                    </tr>
                    <tr>
                        <td><b>Sasaran Bisnis 1</b></td>
                        <td><?= $detailSarbis['desc_sarbis1']; ?></td>
                        <td><?= $detailSarbis['bobot_sarbis1']; ?> </td>
                    </tr>
                    <tr>
                        <td><b>Sasaran Bisnis 2</b></td>
                        <td><?= $detailSarbis['desc_sarbis2']; ?></td>
                        <td><?= $detailSarbis['bobot_sarbis2']; ?> </td>
                    </tr>
                    <tr>
                        <td><b>Sasaran Bisnis 3</b></td>
                        <td><?= $detailSarbis['desc_sarbis3']; ?></td>
                        <td><?= $detailSarbis['bobot_sarbis3']; ?> </td>
                    </tr>
                    <tr>
                        <td><b>Sasaran Bisnis 4</b></td>
                        <td><?= $detailSarbis['desc_sarbis4']; ?></td>
                        <td><?= $detailSarbis['bobot_sarbis4']; ?> </td>
                    </tr>
                    <tr>
                        <td><b>Sasaran Bisnis 5</b></td>
                        <td><?= $detailSarbis['desc_sarbis5']; ?></td>
                        <td><?= $detailSarbis['bobot_sarbis5']; ?> </td>
                    </tr>
                    <?php if(!empty($detailSarbis['desc_sarbis6'])){ ?>
                        <tr>
                            <td><b>Sasaran Bisnis 6</b></td>
                            <td><?= $detailSarbis['desc_sarbis6']; ?></td>
                            <td><?= $detailSarbis['bobot_sarbis6']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if(!empty($detailSarbis['desc_sarbis7'])){ ?>
                        <tr>
                            <td><b>Sasaran Bisnis 7</b></td>
                            <td><?= $detailSarbis['desc_sarbis7']; ?></td>
                            <td><?= $detailSarbis['bobot_sarbis7']; ?> </td>
                        </tr>
                    <?php } ?>
                </table>
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
    })
    <?php if (session()->getFlashdata('error_log') == 'Empty Sarbis') { ?>
        .then(function() {
            <?= session()->setFlashdata('swal_icon', ''); ?>
            window.location.href = "<?= base_url('sarbis/entri'); ?>";
        })
        <?php } ?>
    <?php } ?>
</script>