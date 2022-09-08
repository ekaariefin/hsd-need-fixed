<div id="accordion">
    <div class="card card-cyan">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseKecKer" aria-expanded="false">
                    <div class="d-flex justify-content-between">
                        <div>
                            Detail Penilaian Sasaran Bisnis dan Kinerja
                        </div>
                        <div>
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                </a>
            </h4>
        </div>
        <div id="collapseKecKer" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <table class="table table-bordered table-hover" style="margin-bottom: 20px">
                        <tbody>
                        <tr>
                            <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>SASARAN BISNIS/KINERJA KE-1</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Uraian</b></td>
                            <td><?= $getData['uraian_sb1']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Realisasi</b></td>
                            <td><?= $getData['realisasi_sb1']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $getData['bobot_sb1']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $getData['nilai_sb1']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $getData['hasil_sb1']; ?></td>
                        </tr>



                        <tr>
                            <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>SASARAN BISNIS/KINERJA KE-2</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Uraian</b></td>
                            <td><?= $getData['uraian_sb2']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Realisasi</b></td>
                            <td><?= $getData['realisasi_sb2']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $getData['bobot_sb2']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $getData['nilai_sb2']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $getData['hasil_sb2']; ?></td>
                        </tr>


                        <tr>
                            <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>SASARAN BISNIS/KINERJA KE-3</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Uraian</b></td>
                            <td><?= $getData['uraian_sb3']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Realisasi</b></td>
                            <td><?= $getData['realisasi_sb3']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $getData['bobot_sb3']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $getData['nilai_sb3']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $getData['hasil_sb3']; ?></td>
                        </tr>


                        <tr>
                            <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>SASARAN BISNIS/KINERJA KE-4</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Uraian</b></td>
                            <td><?= $getData['uraian_sb4']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Realisasi</b></td>
                            <td><?= $getData['realisasi_sb4']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $getData['bobot_sb4']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $getData['nilai_sb4']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $getData['hasil_sb4']; ?></td>
                        </tr>


                        <tr>
                            <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>SASARAN BISNIS/KINERJA KE-5</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Uraian</b></td>
                            <td><?= $getData['uraian_sb5']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Realisasi</b></td>
                            <td><?= $getData['realisasi_sb5']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $getData['bobot_sb5']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $getData['nilai_sb5']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $getData['hasil_sb5']; ?></td>
                        </tr>

                        <?php if(!empty($getData['uraian_sb6'])) { ?>
                            <tr>
                                <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                    <b>SASARAN BISNIS/KINERJA KE-6</b>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Uraian</b></td>
                                <td><?= $getData['uraian_sb6']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Realisasi</b></td>
                                <td><?= $getData['realisasi_sb6']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Bobot</b></td>
                                <td><?= $getData['bobot_sb6']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Nilai</b></td>
                                <td><?= $getData['nilai_sb6']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Hasil</b></td>
                                <td><?= $getData['hasil_sb6']; ?></td>
                            </tr>
                        <?php } ?>


                        <?php if(!empty($getData['uraian_sb7'])) { ?>
                            <tr>
                                <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                    <b>SASARAN BISNIS/KINERJA KE-7</b>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Uraian</b></td>
                                <td><?= $getData['uraian_sb7']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Realisasi</b></td>
                                <td><?= $getData['realisasi_sb7']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Bobot</b></td>
                                <td><?= $getData['bobot_sb7']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Nilai</b></td>
                                <td><?= $getData['nilai_sb7']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Hasil</b></td>
                                <td><?= $getData['hasil_sb7']; ?></td>
                            </tr>
                        <?php } ?>



                        <?php if(!empty($getData['uraian_sb8'])) { ?>
                            <tr>
                                <td rowspan="6" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                    <b>SASARAN BISNIS/KINERJA KE-8</b>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Uraian</b></td>
                                <td><?= $getData['uraian_sb8']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Realisasi</b></td>
                                <td><?= $getData['realisasi_sb8']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Bobot</b></td>
                                <td><?= $getData['bobot_sb8']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Nilai</b></td>
                                <td><?= $getData['nilai_sb8']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Hasil</b></td>
                                <td><?= $getData['hasil_sb8']; ?></td>
                            </tr>
                        <?php } ?>

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered" style="margin-bottom: 20px">
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold;background-color:#00A6B4;color:white">
            <b>HASIL PENILAIAN SASARAN BISNIS/KINERJA</b>
        </td>
    </tr>
    <tr>
        <td style="width: 33%; text-align: center; font-weight: bold">Total Hasil</td>
        <td style="width: 33%; text-align: center; font-weight: bold">Bobot</td>
        <td style="width: 33%; text-align: center; font-weight: bold">Hasil</td>
    </tr>
        <td style="text-align: center"><?= $getData['total_sarbis']; ?></td>
        <td style="text-align: center">0.70</td>
        <td style="text-align: center"><?= $getData['hasil_sarbis']; ?></td>
    </tr>
</table>