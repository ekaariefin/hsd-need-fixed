<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Menampilkan Data Karyawan Yang Dibawahi
                </div>
            </div>
            <div class="card-body">
                <a href="<?= base_url('karyawan/unduh/pdf/dibawahi'); ?>" class="btn btn-success" style="margin-bottom: 20px;">
                    <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>Download Daftar Karyawan
                </a>
                <table id="default_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Satuan Kerja</th>
                            <th>Departemen</th>
                            <th>Bidang</th>
                            <th>Fungsi</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php foreach ($getPekerja as $x) { ?>
                            <tr>
                                <td><?= $x['fnip'] ?><?= (!(int)$x['is_blocked']) ? '' : '<i class="fas fa-exclamation-circle" style="color: red;" data-toggle="tooltip" data-target="#show_sarbis" data-placement="top" title="user diblokir"></i>'; ?></td>
                                <td><?= $x['fnama'] ?> </td>
                                <td><?= $x['jabatan'] ?></td>
                                <td><?= $x['satuan_kerja'] ?></td>
                                <td><?= $x['departemen'] ?></td>
                                <td><?= $x['bidang'] ?></td>
                                <td><?= $x['fungsi'] ?></td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($getPekerja)) { ?>
                            <tr>
                                <td colspan="7">Tidak ada data</td>
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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>