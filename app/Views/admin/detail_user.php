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
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url('user'); ?>">Daftar User</a></li>
                        <li class="breadcrumb-item active">Detil User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?= session()->getFlashData('info') ?>

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Informasi User
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($akun['role'] !== "1" && $akun['role'] !== "2") : ?>

                        <table class="table table-bordered table-hover mb-3">
                            <tr>
                                <td style="width: 30%;"><b>User Id</b></td>
                                <td><?= $info['fnip']; ?></td>
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
                            <tr>
                                <td style="width: 30%;"><b>Tanggal Pembuatan Akun</b></td>
                                <td><?= id_date(date('Y-m-d', strtotime($akun['created_at']))) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;"><b>Status Akun</b></td>

                                <td><span class="badge <?= ((int)$akun['is_active'] != 1) ? "badge-secondary" : (((int)$akun['is_blocked'] === 0) ? "badge-success" : "badge-danger"); ?>"><?= ((int)$akun['is_active'] != 1) ? "Tidak Aktif" : (((int)$akun['is_blocked'] === 0) ? "Aktif" : "Blokir"); ?>
                                </td>
                                <!-- <td> <span class="badge <?= ($akun['is_active'] === "1") ? "badge-success" : "badge-danger"; ?>"><?= ($akun['is_active'] === "1") ? "Aktif" : "Nonaktif"; ?></span></td> -->
                            </tr>

                            <?php if ($akun['is_active'] === "0") : ?>
                                <tr>
                                    <td style="width: 30%;"><b>Status Penonaktifan Akun</b></td>
                                    <td><?= $akun['status']; ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    <?php else : ?>
                        <table class="table table-bordered table-hover mb-3">
                            <tr>
                                <td style="width: 30%;"><b>User Id</b></td>
                                <td><?= $akun['userid']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;"><b>Role Id</b></td>
                                <td><?= ($akun['role'] === "1") ? 'Security Administrator' : 'Administrator HSD'; ?></td>
                            </tr>

                            <tr>
                                <td style="width: 30%;"><b>Tanggal Pembuatan Akun</b></td>
                                <td><?= id_date(date('Y-m-d', strtotime($akun['created_at']))) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;"><b>Status Akun</b></td>
                                <td><span class="badge <?= ((int)$akun['is_active'] != 1) ? "badge-secondary" : (((int)$akun['is_blocked'] === 0) ? "badge-success" : "badge-danger"); ?>"><?= ((int)$akun['is_active'] != 1) ? "Tidak Aktif" : (((int)$akun['is_blocked'] === 0) ? "Aktif" : "Blokir"); ?>
                                </td>
                            </tr>

                            <!-- <?php if ($akun['is_active'] === "0") : ?>
                                <tr>
                                    <td style="width: 30%;"><b>Status Penonaktifan Akun</b></td>
                                    <td><?= $akun['status']; ?></td>
                                </tr>
                            <?php endif; ?> -->
                        </table>

                    <?php endif; ?>

                    <?php if ($akun['role'] !== "1" && $akun['role'] !== "2") : ?>
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td style="width: 30%;"><b>Nama </b></td>
                                <td><?= $info['fnama']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Jabatan</b></td>
                                <td><?= $info['jabatan']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Satuan Kerja</b></td>
                                <td><?= $info['satuan_kerja']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Departemen</b></td>
                                <td><?= $info['departemen']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Bidang</b></td>
                                <td><?= $info['bidang']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Fungsi</b></td>
                                <td><?= $info['fungsi']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Golongan</b></td>
                                <td><?= $info['fgrade']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Lokasi Kerja</b></td>
                                <td>
                                    <?php
                                    if ($info['fkode_cab'] == "99") {
                                        echo "KANTOR PUSAT";
                                    } else {
                                        echo "KANTOR CABANG";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    <?php endif; ?>

                    <table class="table" style="border: none;">
                        <tr style="border: none;">
                            <td class="d-flex justify-content-end" style="border: none;">
                                <!-- <button id="onoffButton" type="button" class="btn btn-primary input-group-text mt-3 mb-3"><i class="fas fa-upload" style="margin-right:5px;"></i>Unggah</button> -->
                                <a href="<?= base_url('format-password/' . $akun['userid']) ?>" type="button" id="BtnResetPassword" class="btn btn-warning mr-2" <?= ((int)$akun['is_active'] === 0) ? "hidden disabled" : ""; ?>> <b><i class="fas fa-lock" style="margin-right: 5px;"></i><?= ((int)$akun['is_blocked'] === 1) ? 'Buka Blokir' : 'Reset Password'; ?></b></a>
                                <a type="button" id="onoffButton" class="btn <?= ((int)$akun['is_active'] === 1) ? "btn-danger" : "btn-secondary"; ?> "> <b><i class="fas fa-power-off" style="margin-right: 5px;"></i><?= ($akun['is_active'] === "1") ? "Nonaktifkan Akun" : "Aktifkan Akun"; ?></b></a>
                            </td>
                        </tr>
                        <div class="d-flex justify-content-end">

                        </div>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->include("template/footer"); ?>
<!-- disabled hidden -->

<script>
    <?php if (session()->role == "1") : ?>
        $("#onoffButton").click(
            function(e) {
                e.preventDefault(); // stops the default action
                //$("#loader").show(); // shows the loading screen
                Swal.fire({
                    title: "<?= ($akun['is_active'] === "1") ? "Nonaktifkan Akun" : "Aktifkan Akun"; ?>",
                    html: `
                
                <form action="<?= base_url('/turnoff-user-process'); ?>" method="post">
                    <input type="text" name="userid" value="<?= $akun['userid']; ?>" readonly required hidden>
                    <input type="text" name="is_active" value="<?= ($akun['is_active'] === "1") ? "0" : "1"; ?>" readonly required hidden>
                    <?php if ($akun['is_active'] === "1") : ?>
                        <div class="col mb-4" <?= ($akun['role'] === "1" || $akun['role'] === "2") ? 'hidden' : ''; ?>>
                            <select class="form-control" name="status" id="status" onchange="enableButton()">
                                <option value="not set" selected hidden>not set</option>
                                <option value="resign">resign</option>
                                <option value="izin">izin</option>
                            </select>
                        </div>
                    <?php endif; ?>
                   
                    <button id="submitButton" <?= ($akun['role'] === "1" || $akun['role'] === "2") ? '' : (($akun['is_active'] === "1") ? "disabled" : ""); ?> type="submit" class="btn btn-primary"><?= ($akun['is_active'] === "1") ? "Nonaktikan" : "Aktifkan"; ?></button>
                </form>
                
                `,
                    confirmButtonText: `<button type="submit">Nonaktikan</button></form>`,
                    focusConfirm: false,
                    showConfirmButton: false,
                    allowOutsideClick: true,
                })
            });

        function enableButton() {
            $("#submitButton").removeAttr("disabled");
        };
    <?php endif; ?>

    <?php if (session()->getFlashdata('swal_icon')) { ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon') ?>',
            title: '<?= session()->getFlashdata('swal_title') ?>',
            text: '<?= session()->getFlashdata('swal_text') ?>',
            confirmButtonText: 'Lanjutkan'
        });
    <?php } ?>
</script>


<!-- 

sasaran bisnis diawal tahun berjalan
januari 2023 itu menilai 2022
pada 2022 harusnya mengisi sasaran bisnis di awal tahun di januari 2023 januari
januari-maret 2023 itu sarbis 2023



 -->