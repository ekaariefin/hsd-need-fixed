<?= $this->include("template/header"); ?>
<style>
    textarea {
        height: 300px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Penilaian Kinerja Kantor Pusat</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Penilaian</a></li>
                        <li class="breadcrumb-item active">Kantor Pusat Golongan 4 Fungsional</li>
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
            <div class="card-body" style="overflow-x: auto">
                <form action="<?= base_url('penilaian/process_kp/4F') ?>" method="POST">
                    <?php
                    require "kp_form_header.php";
                    ?>
            </div>

        </div>

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Informasi!</h5>
            Semua kotak isian pada formulir ini wajib diisi!
        </div>


        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Penilaian Kecakapan Kerja
                </div>
            </div>
            <div class="card-body">
                <!-- Pengetahuan Jabatan -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>PENGETAHUAN JABATAN</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='PENGETAHUAN JABATAN'></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="bobot_pengetahuan_jabatan" id="bobot_pengetahuan_jabatan" value="<?= $bobot_pengetahuan_jabatan ?>" readonly onkeyup="pengetahuan_jabatan();">
                        </td>
                        <td>
                            <select id="nilai_pengetahuan_jabatan" class="form-control" name="nilai_pengetahuan_jabatan" onkeyup="pengetahuan_jabatan();" onChange="pengetahuan_jabatan(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="hasil_pengetahuan_jabatan" id="hasil_pengetahuan_jabatan" readonly onkeyup="kecakapan_kerja();" onChange="kecakapan_kerja(this);">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_pengetahuan_jabatan" id="alasan_pengetahuan_jabatan" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Kualitas Kerja -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>KUALITAS KERJA</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='KUALITAS KERJA'></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_kualitas_kerja ?>" name="bobot_kualitas_kerja" id="bobot_kualitas_kerja" onkeyup="kualitas_kerja();" readonly>
                        </td>
                        <td>
                            <select id="nilai_kualitas_kerja" class="form-control" name="nilai_kualitas_kerja" onkeyup="kualitas_kerja();" onChange="kualitas_kerja(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_kualitas_kerja" id="hasil_kualitas_kerja" readonly onkeyup="kecakapan_kerja();" onChange="kecakapan_kerja(this);">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_kualitas_kerja" id="alasan_kualitas_kerja" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Adaptasi -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>ADAPTASI</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='ADAPTASI'></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_adaptasi ?>" name="bobot_adaptasi" id="bobot_adaptasi" onkeyup="adaptasi();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_adaptasi" id="nilai_adaptasi" onkeyup="adaptasi();" onChange="adaptasi(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_adaptasi" id="hasil_adaptasi" readonly onkeyup="kecakapan_kerja();" onChange="kecakapan_kerja(this);">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight:bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_adaptasi" id="alasan_adaptasi" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Kemampuan Komunikasi -->
                <table class="table table-bordered" style="margin-bottom: 25px;">
                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>KEMAMPUAN KOMUNIKASI</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='KEMAMPUAN KOMUNIKASI'></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_kemampuan_komunikasi ?>" name="bobot_kemampuan_komunikasi" id="bobot_kemampuan_komunikasi" onkeyup="kemampuan_komunikasi();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_kemampuan_komunikasi" id="nilai_kemampuan_komunikasi" onkeyup="kemampuan_komunikasi();" onChange="kemampuan_komunikasi(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_kemampuan_komunikasi" id="hasil_kemampuan_komunikasi" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight:bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_kemampuan_komunikasi" id="alasan_kemampuan_komunikasi" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Penilaian Perilaku Budaya
                </div>
            </div>
            <div class="card-body">

                <!-- Kualitas Pelayanan -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>KUALITAS PELAYANAN</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='KUALITAS PELAYANAN'></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_kualitas_pelayanan ?>" name="bobot_kupel" id="bobot_kupel" onkeyup="kupel();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_kupel" id="nilai_kupel" onkeyup="kupel();" onChange="kupel(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_kupel" id="hasil_kupel" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_kupel" id="alasan_kupel" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Disiplin -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>DISIPLIN</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='DISIPLIN'></i>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_disiplin ?>" name="bobot_disiplin" id="bobot_disiplin" onkeyup="disiplin();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_disiplin" id="nilai_disiplin" onkeyup="disiplin();" onChange="disiplin(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_disiplin" id="hasil_disiplin" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_disiplin" id="alasan_disiplin" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Inisiatif -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>INISIATIF</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='INISIATIF'></i>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_inisiatif ?>" name="bobot_inisiatif" id="bobot_inisiatif" onkeyup="inisiatif();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_inisiatif" id="nilai_inisiatif" onkeyup="inisiatif();" onChange="inisiatif(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_inisiatif" id="hasil_inisiatif" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_inisiatif" id="alasan_inisiatif" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Integritas -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>INTEGRITAS</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='INTEGRITAS'></i>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_integritas ?>" name="bobot_integritas" id="bobot_integritas" onkeyup="integritas();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_integritas" id="nilai_integritas" onkeyup="integritas();" onChange="integritas(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_integritas" id="hasil_integritas" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_integritas" id="alasan_integritas" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Kerjasama -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>KERJASAMA</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='KERJASAMA'></i>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_kerjasama ?>" name="bobot_kerjasama" id="bobot_kerjasama" onkeyup="kerjasama();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_kerjasama" id="nilai_kerjasama" onkeyup="kerjasama();" onChange="kerjasama(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_kerjasama" id="hasil_kerjasama" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight:bold">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_kerjasama" id="alasan_kerjasama" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

                <!-- Mandiri -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>MANDIRI</b>
                            <div class="float-right">
                                <i class="fas fa-info-circle" data-toggle='modal' data-target='#show' data-id='MANDIRI'></i>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Bobot</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Nilai</td>
                        <td style="width: 33%; font-weight:bold; text-align:center;">Hasil</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="<?= $bobot_mandiri ?>" name="bobot_mandiri" id="bobot_mandiri" onkeyup="mandiri();" readonly>
                        </td>
                        <td>
                            <select class="form-control" name="nilai_mandiri" id="nilai_mandiri" onkeyup="mandiri();" onChange="mandiri(this);" required>
                                <option value="" hidden>-- Pilih Poin Penilaian --</option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="" name="hasil_mandiri" id="hasil_mandiri" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight:bold">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="text" minlength="10" class="form-control" name="alasan_mandiri" id="alasan_mandiri" placeholder="Masukkan Alasan dan Contoh..." required>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Riwayat Surat Peringatan
                </div>
            </div>
            <div class="card-body">
                <?php
                if (empty($sp)) {
                    echo "<i>Tidak ditemukan data Surat Peringatan.</i>";
                } else {
                    if ($sp['tahun_sp'] == strval(date("Y") - 1)) {
                        echo "Anda memiliki riwayat SP dengan detail berikut:<br/>
                            <table class='table table-bordered table-hover'>
                            <tr>
                            <td><b>Jenis SP</b></td>
                            <td>" . $sp['jenis_sp'] . "</td>
                            </tr>
                            <tr>
                            <td><b>Nomor SP</b></td>
                            <td>" . $sp['nomor_sp'] . "</td>
                            </tr>
                            <tr>
                            <td><b>Tahun SP</b></td>
                            <td>" . $sp['tahun_sp'] . "</td>
                            </tr>
                            <tr>
                            <td><b>Masa Berlaku SP</b></td>
                            <td>" . $sp['tanggal_sp_mulai'] . " sampai " . $sp['tanggal_sp_akhir'] . "</td>
                            </tr>
                            <tr>
                            <td><b>Perihal SP</b></td>
                            <td>" . $sp['perihal_sp'] . "</td>
                            </tr>
                            <tr>
                            <td><b>Pengurangan Poin PA</b></td>
                            <td> - " . $sp['poin_sp'] . "</td>
                            </tr>
                            </table>
                            <input type='hidden' name='poin_sp' value=" . $sp['poin_sp'] . "";
                    } else {
                        echo "<i>Tidak ditemukan data Surat Peringatan Tahun PA berjalan.</i>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Kesimpulan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td width="30%">Hal-Hal Yang Menonjol</td>
                        <td>
                            <input type="text" name="hal_menonjol" class="form-control" minlength="10" rows="1" required>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Hal-Hal Yang Perlu Ditingkatkan</td>
                        <td>
                            <input type="text" name="hal_peningkatan" class="form-control" minlength="10" rows="1" required>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Training/Pelatihan Yang Dibutuhkan</td>
                        <td>
                            <input type="text" class="form-control" name="req_training" minlength="10" id="req_training" required>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-right" style="margin-right:5px;"></i>Lanjutkan</button>
            </div>
        </div>

    </section>
</div>

<!-- Modal start here -->
<div class="modal fade" id="show">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Petunjuk Pengisian Formulir PA</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-width: 100%;overflow-x: auto;">
                <div class="modal-data"></div>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal -->


<?= $this->include("template/footer"); ?>
<script>
    var Hasil = {};

    function pengetahuan_jabatan() {
        var bobot = document.getElementById('bobot_pengetahuan_jabatan').value;
        var nilai = document.getElementById('nilai_pengetahuan_jabatan').options[nilai_pengetahuan_jabatan.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_pengetahuan_jabatan').value = hasil.toFixed(2);
        }
    }

    function kualitas_kerja() {
        var bobot = document.getElementById('bobot_kualitas_kerja').value;
        var nilai = document.getElementById('nilai_kualitas_kerja').options[nilai_kualitas_kerja.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_kualitas_kerja').value = hasil.toFixed(2);
        }
    }

    function adaptasi() {
        var bobot = document.getElementById('bobot_adaptasi').value;
        var nilai = document.getElementById('nilai_adaptasi').options[nilai_adaptasi.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_adaptasi').value = hasil.toFixed(2);
        }
    }

    function kemampuan_komunikasi() {
        var bobot = document.getElementById('bobot_kemampuan_komunikasi').value;
        var nilai = document.getElementById('nilai_kemampuan_komunikasi').options[nilai_kemampuan_komunikasi.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_kemampuan_komunikasi').value = hasil.toFixed(2);
        }
    }

    function kupel() {
        var bobot = document.getElementById('bobot_kupel').value;
        var nilai = document.getElementById('nilai_kupel').options[nilai_kupel.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_kupel').value = hasil.toFixed(2);
        }
    }

    function disiplin() {
        var bobot = document.getElementById('bobot_disiplin').value;
        var nilai = document.getElementById('nilai_disiplin').options[nilai_disiplin.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_disiplin').value = hasil.toFixed(2);
        }
    }

    function inisiatif() {
        var bobot = document.getElementById('bobot_inisiatif').value;
        var nilai = document.getElementById('nilai_inisiatif').options[nilai_inisiatif.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_inisiatif').value = hasil.toFixed(2);
        }
    }

    function integritas() {
        var bobot = document.getElementById('bobot_integritas').value;
        var nilai = document.getElementById('nilai_integritas').options[nilai_integritas.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_integritas').value = hasil.toFixed(2);
        }
    }

    function kerjasama() {
        var bobot = document.getElementById('bobot_kerjasama').value;
        var nilai = document.getElementById('nilai_kerjasama').options[nilai_kerjasama.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_kerjasama').value = hasil.toFixed(2);
        }
    }

    function mandiri() {
        var bobot = document.getElementById('bobot_mandiri').value;
        var nilai = document.getElementById('nilai_mandiri').options[nilai_mandiri.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_mandiri').value = hasil.toFixed(2);
        }
    }
</script>
<script>
    <?php if (session()->getFlashdata('swal_icon')) { ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon') ?>',
            title: '<?= session()->getFlashdata('swal_title') ?>',
            text: '<?= session()->getFlashdata('swal_text') ?>',
            allowOutsideClick: false,
            confirmButtonText: 'Saya Mengerti'
        }).then(function() {
            <?= session()->setFlashdata('swal_icon', ''); ?>
            window.location.href = "<?= base_url('/penilaian/riwayat'); ?>";
        })
    <?php } ?>
</script>
<!-- Ini merupakan script yang terpenting -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#show').on('show.bs.modal', function(e) {
            var getDetail = $(e.relatedTarget).data('id');
            console.log(getDetail);
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type: 'post',
                url: '<?= base_url('penilaian/petunjuk/') ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data: 'getDetail=' + getDetail,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success: function(data) {
                    $('.modal-data').html(data);
                    /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
        });
    });
</script>