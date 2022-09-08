<?php foreach ($info as $x ){ ?>
<?= $this->include('template/header'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Detail Penilaian</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kantor Pusat</a></li>
                        <li class="breadcrumb-item active">Penilaian PA Karyawan </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="card-body">
                <center>
                    <img src="/dist/img/bcas.png" class="d-flex justify-content-center" height="30">
                </center>
            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <h5>I. Informasi Karyawan</h5>
                <table class="table table-bordered">
                    <tr>
                        <td width="30%">NIP</td>
                        <td><?= $x['fnip']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?= $x['fnama']; ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td><?= $x['jabatan']; ?></td>
                    </tr>
                    <tr>
                        <td>Satuan Kerja</td>
                        <td><?= $x['satuan_kerja']; ?></td>
                    </tr>
                    <tr>
                        <td>Departemen/Cabang</td>
                        <td><?= $x['departemen']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>II. Hasil Penilaian</h5>

                <!-- tabel kecakapan kerja -->
                <table class="table table-bordered">
                    <tr>
                        <td colspan="4">
                            <center><b>KECAKAPAN KERJA</b></center>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%"><center><b>Pengetahuan Jabatan</b></center></td>
                        <td width="25%"><center><b>Kualitas Kerja</b></center></td>
                        <td width="25%"><center><b>Adaptasi</b></center></td>
                        <td width="25%"><center><b>Kemampuan Komunikasi</b></center></td>
                    </tr>
                    <tr>
                        <td>Nilai : <?= $x['nilai_pengetahuan_jabatan']; ?><br/> 
                            Bobot : <?= $x['bobot_pengetahuan_jabatan']; ?><br/>
                            Hasil : <?= round($x['hasil_pengetahuan_jabatan'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_kualitas_kerja']; ?><br/> 
                            Bobot : <?= $x['bobot_kualitas_kerja']; ?><br/>
                            Hasil : <?= round($x['hasil_kualitas_kerja'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_adaptasi']; ?><br/> 
                            Bobot : <?= $x['bobot_adaptasi']; ?><br/>
                            Hasil : <?= round($x['hasil_adaptasi'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_kemampuan_komunikasi']; ?><br/> 
                            Bobot : <?= $x['bobot_kemampuan_komunikasi']; ?><br/>
                            Hasil : <?= round($x['hasil_kemampuan_komunikasi'],3); ?>
                        </td>

                    </tr>

                </table>
                <br />

                <!-- tabel perilaku budaya -->
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5">
                            <center><b>PERILAKU BUDAYA</b></center>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%"><center><b>Kualitas Pelayanan</b></center></td>
                        <td width="20%"><center><b>Disiplin</b></center></td>
                        <td width="20%"><center><b>Inisiatif</b></center></td>
                        <td width="20%"><center><b>Integritas</b></center></td>
                        <td width="20%"><center><b>Kerjasama</b></center></td>
                    </tr>
                    <tr>
                        <td>Nilai : <?= $x['nilai_kualitas_pelayanan']; ?><br/> 
                            Bobot : <?= $x['bobot_kualitas_pelayanan']; ?><br/>
                            Hasil : <?= round($x['hasil_kualitas_pelayanan'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_disiplin']; ?><br/> 
                            Bobot : <?= $x['bobot_disiplin']; ?><br/>
                            Hasil : <?= round($x['hasil_disiplin'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_inisiatif']; ?><br/> 
                            Bobot : <?= $x['bobot_inisiatif']; ?><br/>
                            Hasil : <?= round($x['hasil_inisiatif'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_integritas']; ?><br/> 
                            Bobot : <?= $x['bobot_integritas']; ?><br/>
                            Hasil : <?= round($x['hasil_integritas'],3); ?>
                        </td>
                        <td>Nilai : <?= $x['nilai_kerjasama']; ?><br/> 
                            Bobot : <?= $x['bobot_kerjasama']; ?><br/>
                            Hasil : <?= round($x['hasil_kerjasama'],3); ?>
                        </td>

                    </tr>

                </table>
                <br/>

                <!-- tabel pengurangan PA -->
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5">
                            <center><b>PENGURANGAN PA</b></center>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">SP</td>
                        <td width="30%">Jenis SP</td>
                        <td width="30%">No. SP</td>
                        <td width="30%">Tgl. SP</td>
                        <td width="30%">Peringatan</td>
                    </tr>
                    <tr>
                        <?php
                            if(empty($x['poin_sp']) OR $x['poin_sp'] == ''){
                                echo "
                                <td colspan='5'><center><i>Tidak ditemukan data surat peringatan!</i></center></td>
                                ";
                            }
                            else{
                                echo "  <td>".$x['poin_sp']."</td>
                                        <td>".$x['jenis_sp']."</td>
                                        <td>".$x['no_sp']."</td>
                                        <td>".$x['tgl_sp']."</td>
                                        <td>".$x['perihal_sp']."</td>";
                            }
                        ?>
                        
                    </tr>
                </table>
                <br />

                <!-- perhitungan skor akhir -->
                <table class="table table-bordered">
                    <tr>
                        <td colspan="5">
                            <center><b>PENILAIAN AKHIR</b></center>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Angka</b></td>
                        <td><?= $x['angka_pa']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Huruf</b></td>
                        <td><?= $x['huruf_pa']; ?></td>
                    </tr>
                </table>
                <br/>

                <!-- Persetujuan -->
                <table class="table table-bordered">
                    <tr>
                        <td> Aksi Terhadap Penilaian <?= $x['fnama']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                if($x['penilai_satu'] == session()->get('fnip') AND $x['penilai_dua'] != session()->get('fnip')){
                                    $updated_to = 'first';
                                }
                                else if($x['penilai_dua'] == session()->get('fnip') AND $x['penilai_satu'] != session()->get('fnip')){
                                    $updated_to = 'second';
                                }
                                else{
                                    $updated_to = 'both';
                                }
                            ?>

                            <?php 
                            if($x['penilai_satu'] == session()->get('fnip') AND $x['approval_satu'] == ''){
                                echo "<a type='button' href='".base_url('penilaian/otorisasi/OtorisasiPenilaian/oto_gol_4f/'.$x['id_pn'].'/'.$updated_to.'')."' class='btn btn-success'><i class='fa fa-check-double' style='margin-right:5px;'></i> Otorisasi</a>
                                <a type='button' href='' class='btn btn-warning' style='margin-right:5px;'><i class='fa fa-pencil'></i> Ubah Penilaian</a>";
                            }
                            else if($x['penilai_dua'] == session()->get('fnip') AND $x['approval_dua'] == ''){
                               echo "<a type='button' href='".base_url('penilaian/otorisasi/OtorisasiPenilaian/oto_gol_4f/'.$x['id_pn'].'/'.$updated_to.'')."' class='btn btn-success'><i class='fa fa-check-double' style='margin-right:5px;'></i> Otorisasi</a>
                                <a type='button' href='' class='btn btn-warning' style='margin-right:5px;'><i class='fa fa-pencil'></i> Ubah Penilaian</a>";
                            }
                            else if($x['penilai_satu'] == session()->get('fnip') AND $x['penilai_dua'] == session()->get('fnip') AND $x['approval_satu'] == '' AND $x['approval_dua'] == ''){
                                echo "<a type='button' href='".base_url('penilaian/otorisasi/OtorisasiPenilaian/oto_gol_4f/'.$x['id_pn'].'/'.$updated_to.'')."' class='btn btn-success'><i class='fa fa-check-double' style='margin-right:5px;'></i> Otorisasi</a>
                                <a type='button' href='' class='btn btn-warning' style='margin-right:5px;'><i class='fa fa-pencil'></i> Ubah Penilaian</a>";
                            }
                            else{
                                echo "Anda sudah melakukan otorisasi terhadap penilaian ini!";
                            }
                            ?>
                                
                            
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </section>
</div>
<?php } ?>
<?= $this->include("template/footer"); ?>