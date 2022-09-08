<?=
$this->include('template/header');
$date_start     = strtotime($date['date_start']);
$date_end       = strtotime($date['date_end']);
$current_date   = strtotime(date("Y-m-d"));
$diff = floor($date_end - $current_date) / 60 / 60 / 24;

if ((int)$diff < 0) {
    session()->setFlashdata('statusFormulir', 'tutup');
}
?>
<?php
if ($getData['fkode_cab'] == "99") {
    // lokasi kantor pusat
    if ($getData['fgrade'] == "1" or $getData['fgrade'] == "2" or $getData['fgrade'] == "3") {
        session()->setFlashdata('current_grade', '123');
    } else if ($getData['fgrade'] == "4" and $getData['jabatan'] == "ASSOCIATE OFFICER") {
        session()->setFlashdata('current_grade', '4F');
    } else if ($getData['fgrade'] == "4" and $getData['jabatan'] == "KEPALA BAGIAN") {
        session()->setFlashdata('current_grade', '4S');
    } else if ($getData['fgrade'] == "5" and $getData['jabatan'] == "OFFICER") {
        session()->setFlashdata('current_grade', '5F');
    } else if ($getData['fgrade'] == "5" and ($getData['jabatan'] == "KEPALA BIDANG" or $getData['jabatan'] == "KEPALA BAGIAN")) {
        session()->setFlashdata('current_grade', '5S');
    } else if ($getData['fgrade'] == "6" or $getData['fgrade'] == "7") {
        session()->setFlashdata('current_grade', '67');
    } else {
        //MARK: TAMPILKAN SWAL ERROR
    }
} else if ($getData['fkode_cab'] != '99') {
    $jabatan = $getData['jabatan'];

    $jabatan_kecakapan_kerja = array(
        "BACK OFFICE SENIOR OPERASIONAL",
        "BACK OFFICE SENIOR ADMINISTRASI KANTOR",
        "CUSTOMER SERVICE SENIOR",
        "BACK OFFICE ADMINISTRASI KANTOR (FUNGSI POOLING)",
        "BACK OFFICE SENIOR ADMINISTRASI KANTOR ",
        "TELLER",
        "BACK OFFICE SENIOR ADMINISTRASI KANTOR (FUNGSI POOLING)",
        "STAF OPERASIONAL",
        "CUSTOMER SERVICE",
        "BACK OFFICE OPERASIONAL",
        "BACK OFFICE ADMINISTRASI KANTOR",
        "BACK OFFICE ADMINISTRASI KANTOR (FUNGSI SALES ADMIN)",
        "BACK OFFICE OPERASIONAL ",
        "BACK OFFICE OPERASIONAL",
        "BACK OFFICE OPERASIONAL (FUNGSI POOLING)",
        "STAF OPERASIONAL SENIOR"
    );
    if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
        session()->setFlashdata('current_grade', 'cab_123');
    }
    $jabatan_struktural = array(
        "KEPALA BAGIAN TELLER DAN BACKOFFICE",
        "KEPALA BAGIAN OPERASIONAL",
        "KEPALA BAGIAN CUSTOMER SERVICE"
    );
    if (in_array($jabatan, $jabatan_struktural)) {
        session()->setFlashdata('current_grade', 'cab_4s');
    }
    $jabatan_ao = array(
        "ACCOUNT OFFICER",
        "ASSOCIATE ACCOUNT OFFICER",
        "ASSISTANT ACCOUNT OFFICER"
    );
    if (in_array($jabatan, $jabatan_ao)) {
        session()->setFlashdata('current_grade', 'cab_ao');
    }

    if ($jabatan == "KEPALA ULS") {
        session()->setFlashdata('current_grade', 'cab_uls');
    } else if ($jabatan == "KEPALA CABANG PEMBANTU") {
        session()->setFlashdata('current_grade', 'cab_kcp');
    } else if ($jabatan == "KEPALA OPERASI CABANG") {
        session()->setFlashdata('current_grade', 'cab_koc');
    } else if ($jabatan == "KEPALA CABANG") {
        session()->setFlashdata('current_grade', 'cab_kcu');
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Detail Riwayat Penilaian</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kantor Pusat</a></li>
                        <li class="breadcrumb-item active">Riwayat Penilaian </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary" style="overflow-x: auto">
            <div class="card-header">
                <div class="card-title">
                    Informasi Karyawan
                </div>
            </div>
            <div class="card-body">
                <?php require 'header.php'; ?>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Penilaian Karyawan
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('statusFormulir') != 'tutup') { ?>
                    <?php if (session()->get('role') != '2' and session()->get('role') != '1') { ?>
                        <div class="d-flex justify-content-end">

                            <!-- MARK: JIKA SUDAH DISETUJUI MAKA HILANGKAN BUTTON -->
                            <?php if ($markStatus != 'Approved') { ?>
                                <?php if ($getData['approval_satu'] == 'Revision' or $getData['approval_dua'] == 'Revision') { ?>
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <td style="text-align: center;background-color:#C82333;color:white"><i><b>Penilaian ini telah ditandai memerlukan perbaikan. Harap menunggu karyawan anda memperbarui penilaian</b></i></td>
                                        </tr>
                                    </table>
                                <?php } else { ?>
                                    <a href="<?= base_url() ?>/penilaian/otorisasi/proses/<?= session()->getFlashdata('current_grade'); ?>/<?= $getData['id_pn']; ?>" type="button" class="btn btn-success " style="display: flex;justify-content: right;margin-left:10px;margin-bottom:20px"> <b><i class="fas fa-check-circle" style="margin-right: 5px;"></i>Setujui Penilaian </b></a>

                                    <a href="<?= base_url('penilaian/formulir-revisi/') ?>/<?= $getData['tahun_pa']; ?>/<?= $getData['id_pn']; ?>/<?= $getData['id_user'] ?>" type="button" class="btn btn-danger " style="display: flex;justify-content: right;margin-left:10px;margin-bottom:20px">
                                        <b>
                                            <i class="fas fa-times-circle" style="margin-right: 5px;"></i>
                                            Koreksi Penilaian
                                        </b>
                                    </a>
                                <?php } ?>
                            <?php } else { ?>
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td style="text-align: center;background-color:#28A745;color:white"><i><b>Penilaian ini sudah disetujui dan tidak dapat dilakukan perubahan kembali</b></i></td>
                                    </tr>
                                </table>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <table class="table table-bordered table-hover" style="margin-bottom: 20px">
                        <tr>
                            <td style="text-align: center;background-color:navy;color:white"><i><b>Saat ini periode otorisasi telah ditutup. Apabila anda telah menyetujui penilaian, anda tidak perlu melakukan apapun terhadap penilaian ini</b></i></td>
                        </tr>
                    </table>
                <?php } ?>


                <?php if (!empty($getData['hasil_sarbis'])) {
                    require 'detail_sasaran_bisnis.php';
                } else {
                    require 'detail_kecakapan_kerja.php';
                }
                ?>

                <?php require 'detail_perilaku_budaya.php'; ?>

                <table class="table table-bordered" style="margin-bottom: 20px;">
                    <tr>
                        <td colspan="5" style="text-align:center;background-color:#00A6B4;color:white">
                            <b>PENGURANGAN PA (SANKSI)</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 10%; text-align: center; font-weight: bold">Poin SP</td>
                        <td style="width: 15%; text-align: center; font-weight: bold">Jenis SP</td>
                        <td style="width: 20%; text-align: center; font-weight: bold">Nomor SP</td>
                        <td style="width: 20%; text-align: center; font-weight: bold">Tahun SP</td>
                    </tr>
                    <tr>
                        <?php
                        if (empty($sp['poin_sp'])) {
                            echo "
                                <td colspan='5'><center><i>Tidak ditemukan data surat peringatan tahun berjalan</i></center></td>
                                ";
                        } else {
                            echo "  <td><center>" . $sp['poin_sp'] . "</center></td>
                                        <td><center>SP " . $sp['jenis_sp'] . "</center></td>
                                        <td><center>" . $sp['nomor_sp'] . "</center></td>
                                        <td><center>" . $sp['tahun_sp'] . "</center></td>";
                        }
                        ?>
                    </tr>
                </table>

                <?php if ($getData['fkode_cab'] != '99' and $getData['fgrade'] != '1' and $getData['fgrade'] != '2' and $getData['fgrade'] != '3' and  $getData['fgrade'] != '4') { ?>
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="5" style="text-align:center;background-color:#00A6B4;color:white">
                                <b>PENGURANGAN PA (LAIN-LAIN)</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%;text-align: center; font-weight: bold">NPF</td>
                            <td style="width: 25%;text-align: center; font-weight: bold">AUDIT</td>
                            <td style="width: 25%;text-align: center; font-weight: bold">SMART</td>
                            <td style="width: 25%;text-align: center; font-weight: bold">DOK HILANG</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <?php if (empty($getData['bobot_npf'])) {
                                    $getData['bobot_npf'] = 0;
                                } ?>
                                <?= $getData['bobot_npf']; ?>
                            </td>
                            <td style="text-align:center;">
                                <?php if (empty($getData['bobot_audit'])) {
                                    $getData['bobot_audit'] = 0;
                                } ?>
                                <?= $getData['bobot_audit']; ?>
                            </td>
                            <td style="text-align:center;">
                                <?php if (empty($getData['bobot_smart'])) {
                                    $getData['bobot_smart'] = 0;
                                } ?>
                                <?= $getData['bobot_smart']; ?>
                            </td>
                            <td style="text-align:center;">
                                <?php if (empty($getData['bobot_dok'])) {
                                    $getData['bobot_dok'] = 0;
                                } ?>
                                <?= $getData['bobot_dok']; ?>
                            </td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Hasil Penilaian
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5" style="text-align: center;background-color:#00A6B4;color:white">
                            <b>PENILAIAN AKHIR</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Angka PA</b></td>
                        <td><?= bcdiv($getData['angka_pa'], 1, 2); ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Huruf PA</b></td>
                        <td><?= $getData['huruf_pa']; ?></td>
                    </tr>
                </table>
                <br />
                <i>
                    hasil penilaian ini sudah final dan tidak dapat dilakukan perubahan kembali<br />
                    dokumen ini diterbitkan secara digital dan tidak membutuhkan tanda tangan
                </i>
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
            confirmButtonText: 'Saya Mengerti'
        }).then(function() {
            <?php
            session()->setFlashdata('swal_icon', '');
            ?>
            window.location.href = "<?= base_url('penilaian/otorisasi'); ?>";
        })
    <?php } ?>
</script>