<?= $this->include("template/header"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Revisi Penilaian Kinerja Kantor Pusat</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penilaian Gol. 5 Fungsional</li>
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
                <form action="<?= base_url('penilaian/process_revisi_kp/5F') ?>" method="POST">
                    <?php
                    require "kp_form_header.php";
                    ?>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Revisi Penilaian Sasaran Bisnis dan Kinerja
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="margin-top: 20px;">
                    <input type="hidden" name="id_pn" value="<?= $getData['id_pn']; ?> ">
                    <tr>
                        <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>SASARAN BISNIS/KINERJA 1</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Uraian</td>
                        <td>
                            <?= $getData['uraian_sb1']; ?>
                            <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb1']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Realisasi</td>
                        <td>
                            <input type="text" class="form-control" name="realisasi_sb1" id="realisasi_sb1" onkeyup="sb1();" value="<?= $getData['realisasi_sb1']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Bobot dalam %</td>
                        <td>
                            <input type="text" class="form-control" name="bobot_sb1" id="bobot_sb1" value="<?= $getData['bobot_sb1']; ?>" onkeyup="sb5();" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Nilai</td>
                        <td>
                            <select id="nilai_sb1" class="form-control" name="nilai_sb1" onkeyup="sb1();" onChange="sb1(this);">
                                <option value="<?= $getData['nilai_sb1']; ?>" selected hidden><?= $getData['nilai_sb1']; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Hasil</td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_sb1']; ?>" name="hasil_sb1" id="hasil_sb1" readonly onkeyup="hasil_sb1();" onChange="sb1(this);">
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" style="margin-top: 20px;">
                    <tr>
                        <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>SASARAN BISNIS/KINERJA 2</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Uraian</td>
                        <td>
                            <?= $getData['uraian_sb2']; ?>
                            <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb2']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Realisasi</td>
                        <td>
                            <input type="text" class="form-control" name="realisasi_sb2" id="realisasi_sb2" onkeyup="sb2();" value="<?= $getData['realisasi_sb2']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Bobot dalam %</td>
                        <td>
                            <input type="text" class="form-control" name="bobot_sb2" id="bobot_sb2" value="<?= $getData['bobot_sb2']; ?>" readonly onkeyup="sb5();">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Nilai</td>
                        <td>
                            <select id="nilai_sb2" class="form-control" name="nilai_sb2" onkeyup="sb2();" onChange="sb2(this);">
                                <option value="<?= $getData['nilai_sb2']; ?>" selected hidden><?= $getData['nilai_sb2']; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Hasil</td>
                        <td>
                            <input type="text" class="form-control" name="hasil_sb2" value="<?= $getData['hasil_sb2']; ?>" id="hasil_sb2" readonly onkeyup="hasil_sb2();" onChange="sb2(this);">
                        </td>
                    </tr>
                </table>

                <table class="table table-bordered" style="margin-top: 20px;">
                    <tr>
                        <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>SASARAN BISNIS/KINERJA 3</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Uraian</td>
                        <td>
                            <?= $getData['uraian_sb3']; ?>
                            <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb3']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Realisasi</td>
                        <td>
                            <input type="text" class="form-control" name="realisasi_sb3" id="realisasi_sb3" onkeyup="sb3();" value="<?= $getData['realisasi_sb3']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Bobot dalam %</td>
                        <td>
                            <input type="text" class="form-control" name="bobot_sb3" id="bobot_sb3" value="<?= $getData['bobot_sb3']; ?>" onkeyup="sb5();" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Nilai</td>
                        <td>
                            <select id="nilai_sb3" class="form-control" name="nilai_sb3" onkeyup="sb3();" onChange="sb3(this);">
                                <option value="<?= $getData['nilai_sb3']; ?>" selected hidden><?= $getData['nilai_sb3']; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Hasil</td>
                        <td>
                            <input type="text" class="form-control" name="hasil_sb3" value="<?= $getData['hasil_sb3']; ?>" id="hasil_sb3" readonly onkeyup="hasil_sb3();" onChange="sb3(this);">
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" style="margin-top: 20px;">
                    <tr>
                        <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>SASARAN BISNIS/KINERJA 4</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Uraian</td>
                        <td>
                            <?= $getData['uraian_sb4']; ?>
                            <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb4']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Realisasi</td>
                        <td>
                            <input type="text" class="form-control" name="realisasi_sb4" id="realisasi_sb4" onkeyup="sb4();" value="<?= $getData['realisasi_sb4']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Bobot dalam %</td>
                        <td>
                            <input type="text" class="form-control" name="bobot_sb4" id="bobot_sb4" value="<?= $getData['bobot_sb4']; ?>" onkeyup="sb4();" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Nilai</td>
                        <td>
                            <select id="nilai_sb4" class="form-control" name="nilai_sb4" onkeyup="sb4();" onChange="sb4(this);">
                                <option value="<?= $getData['nilai_sb4']; ?>" hidden><?= $getData['nilai_sb4']; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Hasil</td>
                        <td>
                            <input type="text" class="form-control" name="hasil_sb4" value="<?= $getData['hasil_sb4']; ?>" id="hasil_sb4" onkeyup="hasil_sb4();" onChange="sb4(this);" readonly>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered" style="margin-top: 20px;">
                    <tr>
                        <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                            <b>SASARAN BISNIS/KINERJA 5</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Uraian</td>
                        <td>
                            <?= $getData['uraian_sb5']; ?>
                            <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb5']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Realisasi</td>
                        <td>
                            <input type="text" class="form-control" name="realisasi_sb5" id="realisasi_sb5" onkeyup="sb5();" value="<?= $getData['realisasi_sb5']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Bobot dalam %</td>
                        <td>
                            <input type="text" class="form-control" name="bobot_sb5" id="bobot_sb5" value="<?= $getData['bobot_sb5']; ?>" onkeyup="sb5();" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Nilai</td>
                        <td>
                            <select id="nilai_sb5" class="form-control" name="nilai_sb5" onkeyup="sb5();" onChange="sb5(this);">
                                <option value="<?= $getData['nilai_sb5']; ?>" selected hidden><?= $getData['nilai_sb5']; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Hasil</td>
                        <td>
                            <input type="text" class="form-control" name="hasil_sb5" id="hasil_sb5" readonly onkeyup="hasil_sb5();" value="<?= $getData['hasil_sb5']; ?>" onChange="sb5(this);">
                        </td>
                    </tr>
                </table>
                <?php if (!empty($getSarbis['desc_sarbis6'])) { ?>
                    <table class="table table-bordered" style="margin-top: 20px;">
                        <tr>
                            <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                                <b>SASARAN BISNIS/KINERJA 6</b>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Uraian</td>
                            <td>
                                <?= $getData['uraian_sb6']; ?>
                                <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb6']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Realisasi</td>
                            <td>
                                <input type="text" class="form-control" name="realisasi_sb6" id="realisasi_sb6" onkeyup="sb6();" value="<?= $getData['realisasi_sb6']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Bobot dalam %</td>
                            <td>
                                <input type="text" class="form-control" name="bobot_sb6" id="bobot_sb6" value="<?= $getData['bobot_sb6']; ?>" onkeyup="sb6();" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Nilai</td>
                            <td>
                                <select id="nilai_sb6" class="form-control" name="nilai_sb6" onkeyup="sb6();" onChange="sb6(this);">
                                    <option value="<?= $getData['nilai_sb6']; ?>" selected hidden><?= $getData['nilai_sb6']; ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Hasil</td>
                            <td>
                                <input type="text" class="form-control" name="hasil_sb6" id="hasil_sb6" readonly onkeyup="hasil_sb6();" value="<?= $getData['hasil_sb6']; ?>" onChange="sb6(this);">
                            </td>
                        </tr>
                    </table>
                <?php } ?>
                <?php if (!empty($getSarbis['desc_sarbis7'])) { ?>
                    <table class="table table-bordered" style="margin-top: 20px;">
                        <tr>
                            <td colspan="2" style="font-weight:bold; text-align: center;background-color:#00A6B4; color: white;">
                                <b>SASARAN BISNIS/KINERJA 7</b>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Uraian</td>
                            <td>
                                <?= $getData['uraian_sb7']; ?>
                                <input type="hidden" name="uraian_sb1" value="<?= $getData['uraian_sb7']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Realisasi</td>
                            <td>
                                <input type="text" class="form-control" name="realisasi_sb7" id="realisasi_sb7" onkeyup="sb7();" value="<?= $getData['realisasi_sb7']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Bobot dalam %</td>
                            <td>
                                <input type="text" class="form-control" name="bobot_sb7" id="bobot_sb7" value="<?= $getSarbis['bobot_sarbis7']; ?>" onkeyup="sb7();" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Nilai</td>
                            <td>
                                <select id="nilai_sb7" class="form-control" name="nilai_sb7" onkeyup="sb7();" onChange="sb7(this);">
                                    <option value="<?= $getData['nilai_sb7']; ?>" selected hidden><?= $getData['nilai_sb7']; ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Hasil</td>
                            <td>
                                <input type="text" class="form-control" name="hasil_sb7" value="<?= $getData['hasil_sb7']; ?>" id="hasil_sb7" readonly onkeyup="hasil_sb7();" onChange="sb7(this);">
                            </td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Revisi Penilaian Perilaku Budaya
                </div>
            </div>
            <div class="card-body">

                <!-- Kualitas Pelayanan -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: center; background-color:#00A6B4; color: white;">
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
                                <option value="<?= $getData['nilai_kupel']; ?>" selected hidden><?= $getData['nilai_kupel']; ?></option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_kupel']; ?>" name="hasil_kupel" id="hasil_kupel" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea type="text" class="form-control" name="alasan_kupel" id="alasan_kupel" placeholder="Masukkan Alasan dan Contoh...">
                                <?= $getData['alasan_kupel']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>

                <!-- Disiplin -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: center; background-color:#00A6B4; color: white;">
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
                                <option value="<?= $getData['nilai_disiplin']; ?>" selected hidden><?= $getData['nilai_disiplin']; ?></option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_disiplin']; ?>" name="hasil_disiplin" id="hasil_disiplin" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea type="text" class="form-control" name="alasan_disiplin" id="alasan_disiplin" placeholder="Masukkan Alasan dan Contoh...">
                                <?= $getData['alasan_disiplin']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>

                <!-- Inisiatif -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: center; background-color:#00A6B4; color: white;">
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
                                <option value="<?= $getData['nilai_inisiatif']; ?>" selected hidden><?= $getData['nilai_inisiatif']; ?></option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_inisiatif']; ?>" name="hasil_inisiatif" id="hasil_inisiatif" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold;">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea type="text" class="form-control" name="alasan_inisiatif" id="alasan_inisiatif" placeholder="Masukkan Alasan dan Contoh...">
                                <?= $getData['alasan_inisiatif']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>

                <!-- Integritas -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: center; background-color:#00A6B4; color: white;">
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
                                <option value="<?= $getData['nilai_integritas']; ?>" selected hidden><?= $getData['nilai_integritas']; ?></option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_integritas']; ?>" name="hasil_integritas" id="hasil_integritas" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea type="text" class="form-control" name="alasan_integritas" id="alasan_integritas" placeholder="Masukkan Alasan dan Contoh...">
                                <?= $getData['alasan_integritas']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>

                <!-- Kerjasama -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: center; background-color:#00A6B4; color: white;">
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
                                <option value="<?= $getData['nilai_kerjasama']; ?>" selected hidden><?= $getData['nilai_kerjasama']; ?></option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_kerjasama']; ?>" name="hasil_kerjasama" id="hasil_kerjasama" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight:bold">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea type="text" class="form-control" name="alasan_kerjasama" id="alasan_kerjasama" placeholder="Masukkan Alasan dan Contoh...">
                                <?= $getData['alasan_kerjasama']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>

                <!-- Mandiri -->
                <table class="table table-bordered" style="margin-bottom: 25px;">

                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: center; background-color:#00A6B4; color: white;">
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
                                <option value="<?= $getData['nilai_mandiri']; ?>" selected hidden><?= $getData['nilai_mandiri']; ?></option>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                                <option value="4.00">4.00</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" value="<?= $getData['hasil_mandiri']; ?>" name="hasil_mandiri" id="hasil_mandiri" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight:bold">Alasan & Contoh</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea type="text" class="form-control" name="alasan_mandiri" id="alasan_mandiri" placeholder="Masukkan Alasan dan Contoh...">
                                <?= $getData['alasan_mandiri']; ?>
                            </textarea>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <!-- section 2 end -->

        <!-- section 3 begin -->
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

        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-right" style="margin-right:5px;"></i>Lanjutkan</a>
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

    function sb1() {
        var bobot = document.getElementById('bobot_sb1').value;
        var nilai = document.getElementById('nilai_sb1').options[nilai_sb1.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb1').value = hasil.toFixed(2);
        }
    }

    function sb2() {
        var bobot = document.getElementById('bobot_sb2').value;
        var nilai = document.getElementById('nilai_sb2').options[nilai_sb2.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb2').value = hasil.toFixed(2);
        }
    }

    function sb3() {
        var bobot = document.getElementById('bobot_sb3').value;
        var nilai = document.getElementById('nilai_sb3').options[nilai_sb3.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb3').value = hasil.toFixed(2);
        }
    }

    function sb4() {
        var bobot = document.getElementById('bobot_sb4').value;
        var nilai = document.getElementById('nilai_sb4').options[nilai_sb4.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb4').value = hasil.toFixed(2);
        }
    }

    function sb5() {
        var bobot = document.getElementById('bobot_sb5').value;
        var nilai = document.getElementById('nilai_sb5').options[nilai_sb5.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb5').value = hasil.toFixed(2);
        }
    }

    function sb6() {
        var bobot = document.getElementById('bobot_sb6').value;
        var nilai = document.getElementById('nilai_sb6').options[nilai_sb6.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb6').value = hasil.toFixed(2);
        }
    }

    function sb7() {
        var bobot = document.getElementById('bobot_sb7').value;
        var nilai = document.getElementById('nilai_sb7').options[nilai_sb7.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb7').value = hasil.toFixed(2);
        }
    }

    function sb8() {
        var bobot = document.getElementById('bobot_sb8').value;
        var nilai = document.getElementById('nilai_sb8').options[nilai_sb8.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_sb8').value = hasil.toFixed(2);
        }
    }

    // indikator 2

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

    function kemampuan_manajerial() {
        var bobot = document.getElementById('bobot_kemampuan_manajerial').value;
        var nilai = document.getElementById('nilai_kemampuan_manajerial').options[nilai_kemampuan_manajerial.selectedIndex].text;
        var hasil = parseFloat(bobot) * parseFloat(nilai);
        if (!isNaN(hasil)) {
            document.getElementById('hasil_kemampuan_manajerial').value = hasil.toFixed(2);
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