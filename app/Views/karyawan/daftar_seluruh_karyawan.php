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
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $pageHeader; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?= session()->getFlashdata('message'); ?>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Perbarui Data Karyawan
                    </h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/karyawan/upload'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h6><b>Unggah File Karyawan</b></h6>
                            <a href="<?= base_url('public/template/bulk_karyawan_bcas.xlsx') ?>">
                                <div class="btn btn-primary btn-sm" style="margin-bottom: 10px;"><i class="fas fa-file-excel" style="margin-right: 5px;"></i>Download Format Upload</div>
                            </a>
                            <div class="custom-file">
                                <div class="input-group">
                                    <input type="file" id="karyawan_file" name="karyawan_file" style="cursor:pointer;" class="custom-file-input  <?= (isset(session()->validation)) ? 'is-invalid' : ''; ?>" placeholder="Upload data karyawan" autocomplete="off" value="<?= old('karyawan_file'); ?>" id="exampleInputFile" required>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Dokumen Upload...</label>
                                    <div class="invalid-feedback">
                                        <?= session()->validation; ?>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button id="unggahButton" type="button" class="btn btn-primary input-group-text mt-3 mb-3"><i class="fas fa-upload" style="margin-right:5px;"></i>Unggah</button>
                                    <!-- <button disabled="disabled"></button> -->
                                    <button id="submitButton" type="submit" class="btn btn-primary input-group-text mt-3 mb-3" hidden><i class="fas fa-upload" style="margin-right:5px;"></i>Unggah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Menampilkan Data Karyawan
                    </div>
                    <div class="float-right">
                        <a href="<?= base_url('karyawan/unduh/pdf/all') ?>" target="_blank" class="btn btn-block btn-sm btn-success">
                            <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>Download PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12 col-md-12 mb-3">

                        <i>
                            <span class="badge badge-success">
                                <div class='text-success'>A</div>
                            </span> : Karyawan Aktif
                            <span class="badge badge-danger ml-3">
                                <div class='text-danger'>N</div>
                            </span> : Karyawan Nonaktif
                        </i>
                    </div>

                    <table id="default_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Satuan Kerja</th>
                                <th>Departemen</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($karyawan as $x) { ?>
                                <tr class=" custom-clickable-row" data-href="<?= base_url('') ?>/karyawan/detail/<?= $x['fnip']; ?>">
                                    <td><?= $i ?></td>
                                    <td><?= $x['fnip'] ?></td>
                                    <td><?= $x['fnama'] ?></td>
                                    <td><?= $x['jabatan'] ?></td>
                                    <td><?= $x['satuan_kerja'] ?></td>
                                    <td><?= $x['departemen'] ?></td>
                                    <td>
                                        <span class="badge <?= (!(bool)$x['is_active']) ? "badge-danger" : "badge-success"; ?>">
                                            <?= (!(bool)$x['is_active']) ? "<div class='text-danger'>N</div>" : "<div class='text-success'>A</div>"; ?>
                                        </span>
                                    </td>
                                    <!-- <td><?= (!(bool)$x['is_active']) ? '<i class="fad fa-circle text-danger"></i>' : '<i class="fas fa-circle text-success"></i>' ?></td> -->
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
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

    $("#unggahButton").click(
        function(e) {
            e.preventDefault(); // stops the default action
            //$("#loader").show(); // shows the loading screen
            if ($("#karyawan_file").val() != '') {
                Swal.fire({
                    title: "Memperbarui data...",
                    text: "Silahkan tunggu",
                    // imageUrl: "images/ajaxloader.gif",
                    ProgressBar: true,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                $("#submitButton").click()
            }
        });
</script>