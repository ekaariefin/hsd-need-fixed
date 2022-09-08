<?= $this->include("template/header"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sanksi dan Pelanggaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sanksi dan Pelanggaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Informasi Karyawan
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url("sp/to_form") ?> " method="POST">
                    <?php csrf_field(); ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input name="employee_name" type="text" class="form-control" id="name" placeholder="Nama Karyawan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-3">
                            <input readonly name="nip" type="text" class="form-control" id="nip" placeholder="NIP">
                        </div>

                        <label for="gol" class="col-sm-3 col-form-label text-right">Gol.</label>
                        <div class="col-sm-3">
                            <input readonly name="gol" type="text" class="form-control" id="gol" placeholder="Golongan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input readonly name="jabatan" type="text" class="form-control" id="jabatan" placeholder="Jabatan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                        <div class="col-sm-9">
                            <input readonly name="unit" type="text" class="form-control" id="unit" placeholder="Unit Kerja/Cabang">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input readonly name="employee_email" type="text" class="form-control" id="employee_email" placeholder="Email">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Submit Data Karyawan</button>
                </form>
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
        })
    <?php } ?>
</script>