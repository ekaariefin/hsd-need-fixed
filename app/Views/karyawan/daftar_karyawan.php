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
        <div class="card">
            <div class="card-body">
                <h6>Cari Berdasarkan</h6>
                <select class="form-control">
                    <option selected>-- Pilih Satuan Kerja --</option>
                    <option>Satuan Kerja Audit Internal</option>
                    <option>Satuan Kerja TI dan Logistik</option>
                    <option>Satuan Kerja Hukum dan SDM</option>
                    <option>Satuan Kerja Management Risiko</option>
                </select>
                <button type="button" class="btn btn-primary" style="margin-top:15px;"><i class="fas fa-search" style="margin-right: 5px;"></i>Cari</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Menampilkan Data Karyawan</h5>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Satuan Kerja</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getPekerja as $x) { ?>
                            <tr>
                                <td><?= $x['fnip'] ?></td>
                                <td><?= $x['fnama'] ?></td>
                                <td><?= $x['jabatan'] ?></td>
                                <td><?= $x['satuan_kerja'] ?></td>
                                <td></td>
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
            confirmButtonText: 'Lanjutkan'
        });
    <?php } ?>
</script>