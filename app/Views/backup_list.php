<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>

<?php
  foreach($info as $x):
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
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Penilaian
                </div>
            </div>
            <div class="card-body">
            <!-- <button type="button" class="btn btn-primary" style="margin-bottom: 20px;"><i class="fas fa-file-pdf"></i> Unduh PDF</button> -->
                <table class="table table-bordered" style="margin-bottom: 20px">
                
                    <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold">
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
                <table class="table table-bordered" style="margin-bottom: 20px">
                    <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold">
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
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5">
                            <center><b>PENGURANGAN PA</b></center>
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
                            if(empty($sp['poin_sp'])){
                                echo "
                                <td colspan='5'><center><i>Tidak ditemukan data surat peringatan tahun berjalan</i></center></td>
                                ";
                            }
                            else{
                                echo "  <td><center>".$sp['poin_sp']."</center></td>
                                        <td><center>".$sp['jenis_sp']."</center></td>
                                        <td><center>".$sp['nomor_sp']."</center></td>
                                        <td><center>".$sp['tahun_sp']."</center></td>";
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
                        <td colspan="5">
                            <b>PENILAIAN AKHIR</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Angka PA</b></td>
                        <td><?= $x['angka_pa']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Huruf PA</b></td>
                        <td><?= $x['huruf_pa']; ?></td>
                    </tr>
                </table>
                <br/>
                <i>
                    hasil penilaian ini sudah final dan tidak dapat dilakukan perubahan kembali<br/>
                    dokumen ini diterbitkan secara digital dan tidak membutuhkan tanda tangan
                </i>
            </div>
        </div>

    </section>
</div>
<?php endforeach; ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>