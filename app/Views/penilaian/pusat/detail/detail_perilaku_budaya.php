<div id="accordion">
    <div class="card card-cyan">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapsePerBud" aria-expanded="false">
                    <div class="d-flex justify-content-between">
                        <div>
                            Detail Penilaian Perilaku Budaya
                        </div>
                        <div>
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                </a>
            </h4>
        </div>
        <div id="collapsePerBud" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <table class="table table-bordered table-hover" style="margin-bottom: 20px">
                        <tbody>
                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>KUALITAS PELAYANAN</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_kupel']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_kupel']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_kupel']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_kupel']; ?></td>
                        </tr>

                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>DISIPLIN</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_disiplin']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_disiplin']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_disiplin']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_disiplin']; ?></td>
                        </tr>

                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>INISIATIF</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_inisiatif']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_inisiatif']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_inisiatif']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_inisiatif']; ?></td>
                        </tr>

                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>INTEGRITAS</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_integritas']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_integritas']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_integritas']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_integritas']; ?></td>
                        </tr>

                        <?php if(!empty($x['hasil_kerjasama'])) { ?>
                            <tr>
                                <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                    <b>KERJASAMA</b>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Nilai</b></td>
                                <td><?= $x['nilai_kerjasama']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Bobot</b></td>
                                <td><?= $x['bobot_kerjasama']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Hasil</b></td>
                                <td><?= $x['hasil_kerjasama']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Alasan</b></td>
                                <td><?= $x['alasan_kerjasama']; ?></td>
                            </tr>
                        <?php } ?>

                        <?php if(!empty($x['hasil_mandiri'])) { ?>
                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>MANDIRI</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_mandiri']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_mandiri']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_mandiri']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_mandiri']; ?></td>
                        </tr>
                        <?php } ?>

                        
                        <?php if(!empty($x['hasil_kemampuan_manajerial'])) { ?>
                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>KEMAMPUAN MANAJERIAL</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_kemampuan_manajerial']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_kemampuan_manajerial']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_kemampuan_manajerial']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_kemampuan_manajerial']; ?></td>
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
            <b>HASIL PENILAIAN PERILAKU BUDAYA</b>
        </td>
    </tr>
    <tr>
        <td style="width: 33%; text-align: center; font-weight: bold">Total Hasil</td>
        <td style="width: 33%; text-align: center; font-weight: bold">Bobot</td>
        <td style="width: 33%; text-align: center; font-weight: bold">Hasil</td>
    </tr>
    <tr>
        <td style="text-align: center"><?= $x['total_perilaku_budaya']; ?></td>
        <td style="text-align: center">0.30</td>
        <td style="text-align: center"><?= $x['hasil_perilaku_budaya']; ?></td>
    </tr>
</table>