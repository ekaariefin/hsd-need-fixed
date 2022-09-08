<?= $this->include("template/header"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Otorisasi Sasaran Bisnis dan Kinerja</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kantor Pusat</a></li>
                        <li class="breadcrumb-item active">Otorisai Sasaran Bisnis</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-primary animate__animated animate__bounceInRight">
            <div class="card-header">
                <div class="card-title">
                    Otorisasi Sasaran Bisnis dan Kinerja
                </div>
            </div>
            <div class="card-body">
                <table id="default_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tahun Sarbis</th>
                    <th>Nama Karyawan</th>
                    <th>Departemen</th>
                    <th>Bidang</th>
                    <th>Status Persetujuan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($getData as $x) { ?>
                    <tr class=" custom-clickable-row" data-href="<?= base_url('sarbis/otorisasi/detail/').'/'.$x['id_sarbis'] ?>">
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td style="text-align: center;"><?= $x['tahun_sarbis'] ?></td>
                        <td><?= $x['fnama'] ?></td>
                        <td><?= $x['departemen'] ?></td>
                        <td><?= $x['bidang'] ?></td>
                        <?php
                            if(empty($x['approval1']) AND empty($x['approval2'])){
                                echo '<td style="text-align:center;"><span class="badge bg-warning">Menunggu Persetujuan</span></td>';
                            }
                            else if(empty($x['approval1']) OR empty($x['approval2'])){
                                echo '<td style="text-align:center;"><span class="badge bg-warning">Dalam Peninjauan</span></td>';
                            }
                            else {
                                echo '<td style="text-align:center;"><span class="badge bg-success">Disetujui</span></td>';
                            }
                            
                        ?>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
        confirmButtonText: 'Lanjutkan',
        allowOutsideClick: false,
    })
<?php } ?>
</script>