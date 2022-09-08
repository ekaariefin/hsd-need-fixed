<div id="accordion">
    <div class="card card-cyan">
        <div class="card-header">
            <h4 class="card-title w-100">
                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseKecKer" aria-expanded="false">
                    <div class="d-flex justify-content-between">
                        <div>
                            Detail Penilaian Kecakapan Kerja
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
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:35%">
                                <b>PENGETAHUAN JABATAN</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_pengetahuan_jabatan']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_pengetahuan_jabatan']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_pengetahuan_jabatan']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_pengetahuan_jabatan']; ?></td>
                        </tr>

                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>KUALITAS KERJA</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_kualitas_kerja']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_kualitas_kerja']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_kualitas_kerja']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_kualitas_kerja']; ?></td>
                        </tr>

                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>KEMAMPUAN KOMUNIKASI</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_kemampuan_komunikasi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_kemampuan_komunikasi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_kemampuan_komunikasi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_kemampuan_komunikasi']; ?></td>
                        </tr>

                        <tr>
                            <td rowspan="5" style="padding:80px;vertical-align: center; text-align:center;width:30%">
                                <b>ADAPTASI</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nilai</b></td>
                            <td><?= $x['nilai_adaptasi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bobot</b></td>
                            <td><?= $x['bobot_adaptasi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Hasil</b></td>
                            <td><?= $x['hasil_adaptasi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Alasan</b></td>
                            <td><?= $x['alasan_adaptasi']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered" style="margin-bottom: 20px">
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold;background-color:#00A6B4;color:white">
            <b>HASIL PENILAIAN KECAKAPAN KERJA</b>
        </td>
    </tr>
    <tr>
        <td style="width: 33%; text-align: center; font-weight: bold">Total Hasil</td>
        <td style="width: 33%; text-align: center; font-weight: bold">Bobot</td>
        <td style="width: 33%; text-align: center; font-weight: bold">Hasil</td>
    </tr>
        <td style="text-align: center"><?= $x['total_kecakapan_kerja']; ?></td>
        <td style="text-align: center">0.70</td>
        <td style="text-align: center"><?= $x['hasil_kecakapan_kerja']; ?></td>
    </tr>
</table>