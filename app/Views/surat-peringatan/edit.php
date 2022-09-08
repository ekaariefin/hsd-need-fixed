<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Penilaian Kinerja Kantor Pusat</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Penilaian</a></li>
                        <li class="breadcrumb-item active">Kantor Pusat Gol. 1, 2 & 3</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Karyawan
                </div>
            </div>
            <div class="card-body" style="overflow-x: auto">
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 20%;"><b>Nomor Induk</b></td>
                        <td style="width: 30%;"><?= $list['fnip']; ?></td>
                        <td style="width: 20%;"><b>Nama Lengkap</b></td>
                        <td style="width: 30%;"><a style="text-transform: uppercase;"><?= $list['fnama']; ?></a></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><b>Satuan Kerja</b></td>
                        <td style="width: 30%;"><?= $list['satuan_kerja']; ?></td>
                        <td style="width: 20%;"><b>Departemen</b></td>
                        <td style="width: 30%;"><?= $list['departemen']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><b>Bidang</b></td>
                        <td style="width: 30%;"><?= $list['bidang']; ?></td>
                        <td style="width: 20%;"><b>Fungsi</b></td>
                        <td style="width: 30%;"><?= $list['fungsi']; ?></td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Sanksi/Pelanggaran
                </div>
            </div>
            <div class="card-body" style="overflow-x: auto">
                <form action="<?= base_url("sp/process_edit") ?>" method="POST">
                    <?php csrf_field(); ?>
                    <table class="table table-bordered" style="width: 100%;">
                        <tr>
                            <td style="width: 40%;"><b>Jenis Sanksi</b></td>
                            <td style="width: 60%;">
                                <select name="jenis_sp" class="form-control" required>
                                    <option selected hidden value="<?= $list['jenis_sp']; ?>">SP <?= $list['jenis_sp']; ?></option>
                                    <option value="Peringatan Lisan">Peringatan Lisan</option>
                                    <option value="Surat Teguran I">Surat Teguran I</option>
                                    <option value="Surat Teguran II">Surat Teguran II</option>
                                    <option value="Surat Teguran III">Surat Teguran III</option>
                                    <option value="1">SP 1</option>
                                    <option value="2">SP 2</option>
                                    <option value="3">SP 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Nomor Sanksi</b></td>
                            <td style="width: 60%;">
                                <input type="text" class="form-control" name="nomor_sp" value="<?= $list['nomor_sp']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Tanggal Sanksi Mulai</b></td>
                            <td style="width: 60%;">
                                <?php
                                $system_date = $list['tanggal_sp_mulai'];
                                $timestamp = strtotime($system_date);
                                $new_date = date("Y-m-d", $timestamp);
                                ?>
                                <input type="date" class="form-control" name="tanggal_sp_mulai" value="<?= date($new_date); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Tanggal Sanksi Berakhir<br><small>Sesuai ketentuan PKB, SP berlaku 6 bulan<i></i></small></b></td>
                            <td style="width: 60%;">
                                <?php
                                $system_date = $list['tanggal_sp_akhir'];
                                $timestamp = strtotime($system_date);
                                $new_date = date("Y-m-d", $timestamp);
                                ?>
                                <input type="date" class="form-control" name="tanggal_sp_akhir" value="<?= date($new_date); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;"><b>Pasal PKB yang dilanggar</b></td>
                            <td style="width: 60%;">
                                <input type="text" class="form-control" name="pasal_sp" value="<?= $list['pasal_sp']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;"><b>Perihal Sanksi</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="summernote" class="form-control" name="perihal_sp" required><?= $list['perihal_sp']; ?></textarea>
                                <input type="hidden" name="user_sp" value="<?= $list['user_sp']; ?>">
                                <input type="hidden" name="id_sp" value="<?= $list['id_sp']; ?>">
                            </td>
                        </tr>
                    </table>
                    <table class="table">
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-double" style="margin-right: 5px;"></i>
                                    Simpan Perubahan
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>
</div>

<?= $this->include("template/footer"); ?>