<?= $this->include("template/header"); ?>

<div class="content-wrapper" style="padding-bottom: 5px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Ganti Kata Sandi</h5>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary animate__animated animate__bounceInRight">
                <div class="card-header">
                    <div class="card-title">
                        Form Ubah Kata Sandi
                    </div>
                </div>

                <div class="card-body">

                    <?php if (session()->getFlashData('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php
                    if (session()->getFlashData('danger')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('danger') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>


                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Ketentuan Kata Sandi:</h5>
                        <ul>
                            <li>Terdapat minimal 8 Karakter</li>
                            <li>Terdapat minimal 1 Huruf Kapital</li>
                            <li>Terdapat minimal 1 Huruf Kecil</li>
                            <li>Terdapat minimal 1 Angka</li>
                            <li>Terdapat minimal 1 Karakter Spesial</li>
                        </ul>
                    </div>

                    <form method="post" action="<?= base_url('/change-password/process') ?>">

                        <div class="form-group">
                            <label>Kata Sandi Lama</label><br />
                            <input class="form-control <?= ($validation->hasError('old_password')) ? 'is-invalid' : ''; ?>" type="password" name="old_password" placeholder="MasukkanKata Sandi Lama" style="margin-bottom: 15px;" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('old_password'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input class="form-control <?= ($validation->hasError('new_password')) ? 'is-invalid' : ''; ?>" type="password" name="new_password" placeholder="Masukkan Kata Sandi Baru" style="margin-bottom: 15px;" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('new_password'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi Baru</label>
                            <input class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : ''; ?>" type="password" name="confirm_password" placeholder="Masukkan Kembali Kata Sandi Baru" style="margin-bottom: 15px;" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('confirm_password'); ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-fw fa-key" style="margin-right: 5px;"></i>
                            Ubah Kata Sandi
                        </button>

                    </form>
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
        })
    <?php } ?>
</script>