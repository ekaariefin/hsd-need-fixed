<?= $this->include("template/header"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Otorisasi Penilaian Kinerja</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kantor Pusat</a></li>
                        <li class="breadcrumb-item active">Riwayat Penilaian PA</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Daftar Penilaian Memerlukan Otorisasi
                </div>
            </div>
            <div class="card-body">
                <table id="default_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Karyawan</th>
                    <th>Angka PA</th>
                    <th>Huruf PA</th>
                    <th>Gol</th>
                    <th>Status 1</th>
                    <th>Status 2</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($info as $x) {?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date("d M Y", strtotime($x['tgl_isi'])) ?></td>
                        <td><?= $x['fnama'] ?></td>
                        <td><?= $x['angka_pa'] ?></td>
                        <td><?= $x['huruf_pa'] ?></td>
                        <td><?= $x['fgrade'] ?></td>
                            <!-- penilai satu -->
                            <?php
                            if ($x['approval_satu'] == '' OR empty($x['approval_satu'])){
                                echo '<td><span class="badge bg-warning">Menunggu Persetujuan</span></td>';
                            }
                            else if ($x['approval_satu'] == 'Disetujui'){
                                echo '<td><span class="badge bg-success">Disetujui</span></td>';
                            }
                            else {
                                echo '<td><span class="badge bg-danger">Ditolak</span></td>';
                            }
                            ?>

                            <!-- penilai dua -->
                            <?php
                            if ($x['approval_dua'] == '' OR empty($x['approval_dua'])){
                                echo '<td><span class="badge bg-warning">Menunggu Persetujuan</span></td>';
                            }
                            else if ($x['approval_dua'] == 'Ditolak'){
                                echo '<td><span class="badge bg-danger">Ditolak</span></td>';
                            }
                            else {
                                echo '<td><span class="badge bg-success">Disetujui</span></td>';
                            }
                            ?>
                        <td>
                            <?php
                                if($x['fkode_cab'] == "99") {
                                    // lokasi kantor pusat
                                    if ($x['fgrade'] == "1" OR $x['fgrade'] == "2" OR $x['fgrade'] == "3"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_123/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "4" AND $x['jabatan'] == "ASSOCIATE OFFICER"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_4f/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "4" AND $x['jabatan'] == "KEPALA BAGIAN"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_4s/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "5" AND $x['jabatan'] == "OFFICER"){
                                       echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_5f/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "5" AND $x['jabatan'] == "KEPALA BIDANG"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_5s/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "5" AND $x['jabatan'] == "KEPALA BAGIAN"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_5s/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "6"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_67/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else if ($x['fgrade'] == "7"){
                                        echo "<a type='button' href='".base_url("penilaian/otorisasi/OtorisasiDetail/gol_67/".$x['id_pn']) ."' class='btn btn-sm btn-primary'><i class='fas fa-info-circle'></i>";
                                    }
                                    else{
                                        echo "Diluar Tindakan";
                                    }
                                }
                            ?>
                        </td>
                        
                    <?php } ?>
                  </tbody>
                </table>
            </div>
        </div>



    </section>
</div>

<?= $this->include("template/footer"); ?>