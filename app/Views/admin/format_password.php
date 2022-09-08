<?= $this->include("template/header"); ?>

<div class="content-wrapper" style="padding-bottom: 5px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><?= $pageHeader; ?></h5>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?= session()->getFlashData('info') ?>

            <div class="card card-primary animate__animated animate__bounceInRight">
                <div class="card-header">
                    <div class="card-title">
                        Format Kata Sandi
                    </div>
                </div>

                <div class="card-body">
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

                    <?php if ($akun['role'] !== "1" && $akun['role'] !== "2") : ?>
                        <table class="table table-bordered table-hover mb-3">
                            <tr>
                                <td style="width: 30%;"><b>User Id</b></td>
                                <td><?= $info['fnip']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Nama</b></td>
                                <td><?= $info['fnama']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td>
                                    <?php
                                    if (empty($info['email'])) {
                                        echo "<i>Email belum terdaftar</i>";
                                    } else {
                                        echo $info['email'];
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    <?php else : ?>
                        <table class="table table-bordered table-hover mb-3">
                            <tr>
                                <td style="width: 30%;"><b>User Id</b></td>
                                <td><?= $akun['userid']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Role</b></td>
                                <td><?= ($akun['role'] === "1") ? 'Security Administrator' : 'Administrator HSD'; ?></td>
                            </tr>
                        </table>
                    <?php endif; ?>

                    <form method="post" action="<?= base_url('/format-password-process') ?>">
                        <div class="form-group" hidden>
                            <label>User Id</label>
                            <input class="form-control" type="text" name="userid" style="margin-bottom: 15px;" readonly required value="<?= $userid; ?>">
                            <input class="form-control" type="alpha" name="is_blocked" style="margin-bottom: 15px;" readonly required value="<?= $akun['is_blocked']; ?>">

                        </div>

                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" type="password" name="password" placeholder="Masukkan Kata Sandi Baru" style="margin-bottom: 15px;" autocomplete="off" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi Baru</label>
                            <input class="form-control <?= ($validation->hasError('re_password')) ? 'is-invalid' : ''; ?>" type="password" name="re_password" placeholder="Masukkan Kembali Kata Sandi Baru" style="margin-bottom: 15px;" autocomplete="off" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('re_password'); ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-fw fa-key" style="margin-right: 5px;"></i>
                            Simpan Kata Sandi
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