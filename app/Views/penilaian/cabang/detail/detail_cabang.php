<?php
$gol = session()->get('db_gol');

foreach ($info as $x) {
?>
    <?= $this->include('template/header'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Detail Riwayat Penilaian</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Kantor Cabang</a></li>
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
                        Detail Penilaian
                    </div>
                    <div class="float-right">

                        <a href="<?= base_url('penilaian/unduh/' . $gol . '/' . $x['id_pn'] . '') ?>" target="_blank" class="btn btn-block btn-sm btn-success">
                            <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>Download PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (($x['approval_satu'] == 'Revisi') or ($x['approval_dua'] == 'Revisi')) { ?>
                        <div class="alert alert-danger">
                            <b>PERHATIAN !</b>
                            <p>Atasan anda telah melakukan perubahan pada penilaian kinerja ini, penilaian anda saat ini masih dalam proses kelengkapan validasi dari para atasan anda, harap lakukan pemeriksaan kembali</p>
                        </div>
                    <?php } ?>

                    <?php if (!empty($x['hasil_sarbis'])) {
                        require 'detail_sasaran_bisnis.php';
                    } else {
                        require 'detail_kecakapan_kerja.php';
                    }
                    ?>

                    <?php require 'detail_perilaku_budaya.php'; ?>

                    <?php
                    $jabatan_nilai_audit = array(
                        "ACCOUNT OFFICER",
                        "ASSOCIATE ACCOUNT OFFICER",
                        "ASSISTANT ACCOUNT OFFICER",
                        "KEPALA CABANG",
                        "KEPALA CABANG PEMBANTU",
                        "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                        "KEPALA ULS",
                        "KEPALA BAGIAN OPERASIONAL",
                        "KEPALA OPERASI CABANG",
                        "KEPALA BAGIAN CUSTOMER SERVICE"
                    )
                    ?>
                    <?php if (in_array($x['jabatan'], $jabatan_nilai_audit)) { ?>
                        <table class="table table-stripped table-bordered">
                            <tr>
                                <td colspan="2" style="text-align:center;background-color:#00A6B4;color:white">
                                    <b>PENGURANGAN PA (NPF/DOKUMEN/AUDIT) </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Nilai NPF</td>
                                <td>
                                    <?php if (!isset($x['nilai_npf'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['nilai_npf'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Bobot NPF</td>
                                <td>
                                    <?php if (!isset($x['bobot_npf'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['bobot_npf'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Nilai SMART</td>
                                <td>
                                    <?php if (!isset($x['nilai_smart'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['nilai_smart'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Bobot SMART</td>
                                <td>
                                    <?php if (!isset($x['bobot_smart'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['bobot_smart'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Nilai Audit</td>
                                <td>
                                    <?php if (!isset($x['nilai_audit'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['nilai_audit'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Bobot Audit</td>
                                <td>
                                    <?php if (!isset($x['bobot_audit'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['bobot_audit'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Nilai Dokumen Hilang</td>
                                <td>
                                    <?php if (!isset($x['nilai_dok'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['nilai_dok'];
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Bobot Dokumen Hilang</td>
                                <td>
                                    <?php if (!isset($x['bobot_dok'])) {
                                        echo 'Tidak Dinilai';
                                    } else {
                                        echo $x['bobot_dok'];
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

                    <table class="table table-bordered" style="margin-top: 20px;">
                        <tr>
                            <td colspan="5" style="text-align:center;background-color:#00A6B4;color:white">
                                <b>PENGURANGAN PA (SANKSI)</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 10%; text-align: center; font-weight: bold">SP</td>
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
                                        <td><center>" . $sp['jenis_sp'] . "</center></td>
                                        <td><center>" . $sp['nomor_sp'] . "</center></td>
                                        <td><center>" . $sp['tahun_sp'] . "</center></td>";
                            }
                            ?>
                        </tr>
                    </table>
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
                            <td><?= bcdiv($x['angka_pa'], 1, 2); ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Huruf PA</b></td>
                            <td><?= $x['huruf_pa']; ?></td>
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
<?php } ?>
<?= $this->include("template/footer"); ?>