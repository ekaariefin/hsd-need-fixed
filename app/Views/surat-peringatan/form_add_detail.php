<?php $validation = \Config\Services::validation(); ?>
<?= $this->include("template/header"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formulir Sanksi dan Pelanggaran</h1>
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
                    Identitas Karyawan
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url("/sp/process") ?> " method="POST">
                    <?php csrf_field(); ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input readonly name="employee_name" type="text" value="<?= $employee['employee_name'] ?>" class="form-control" id="name" placeholder="Nama Karyawan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-3">
                            <input readonly name="user_sp" type="text" class="form-control" value="<?= $employee['nip'] ?>">
                        </div>

                        <label for="gol" class="col-sm-3 col-form-label text-right">Gol.</label>
                        <div class="col-sm-3">
                            <input readonly name="gol" type="text" class="form-control" id="gol" value="<?= $employee['gol'] ?>" placeholder="Golongan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input readonly name="jabatan" type="text" class="form-control" id="jabatan" value="<?= $employee['jabatan'] ?>" placeholder="Jabatan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                        <div class="col-sm-9">
                            <input readonly name="unit" type="text" class="form-control" id="unit" value="<?= $employee['unit'] ?>" placeholder="Unit Kerja/Cabang">
                        </div>
                    </div>

                    <input type="hidden" name="employee_email" id="employee_email" value="<?= $employee['employee_email'] ?>">
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Detail Sanksi
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Jenis Sanksi</label>
                    <?php
                    if ($error = $validation->getError('jenis_sp')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('jenis_sp') . "</div>";
                    }
                    ?>
                    <select name="jenis_sp" class="form-control" required>
                        <option selected disabled hidden value="">-- Pilih Jenis Sanksi --</option>
                        <!-- Peringatan Lisan, Surat Teguran I, Surat Teguran II, Surat Teguran III -->
                        <option value="Peringatan Lisan">Peringatan Lisan</option>
                        <option value="Surat Teguran I">Surat Teguran I</option>
                        <option value="Surat Teguran II">Surat Teguran II</option>
                        <option value="Surat Teguran III">Surat Teguran III</option>
                        <option value="1">SP 1</option>
                        <option value="2">SP 2</option>
                        <option value="3">SP 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nomor Surat Sanksi</label>
                    <?php
                    if ($error = $validation->getError('nomor_sp')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('nomor_sp') . "</div>";
                    }
                    ?>
                    <input type="text" name="nomor_sp" class="form-control" placeholder="Masukkan Nomor Dokumen SP" required>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Tanggal Mulai Sanksi
                            <br/><small>Dimasukkan sesuai tanggal diberikan sanksi</small></label>
                            <?php
                            if ($error = $validation->getError('tanggal_sp_mulai')) {
                                echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('tanggal_sp_mulai') . "</div>";
                            }
                            ?>
                            <input type="date" name="tanggal_sp_mulai" class="form-control" required>
                        </div>
                        <div class="col">
                        <label>Tanggal Akhir Sanksi<br /><small>Sesuai ketentuan PKB, SP berlaku 6 bulan<i></i></small></label>
                    <?php
                    if ($error = $validation->getError('tanggal_sp_akhir')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('tanggal_sp_akhir') . "</div>";
                    }
                    ?>
                    <input type="date" name="tanggal_sp_akhir" class="form-control" required>
                
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pasal yang dilanggar<br/><small>Merujuk pada ketentuan PKB</small></label>
                    <?php
                    if ($error = $validation->getError('pasal_sp')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('pasal_sp') . "</div>";
                    }
                    ?>
                    <input type="text" name="pasal_sp" class="form-control" placeholder="Masukkan detail pasal yang dilanggar" required>
                </div>
                <div class="form-group">
                    <label>Perihal Sanksi/Pelanggaran</label>
                    <?php
                    if ($error = $validation->getError('perihal_sp')) {
                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('perihal_sp') . "</div>";
                    }
                    ?>
                    <textarea class="form-control" name="perihal_sp" style="padding-bottom: 10px;" placeholder="Masukkan deskripsi atau perihal pelanggaran"></textarea>
                </div>

            </div>
        </div>

        <div class="card card-lightblue">
            <div class="card-header">
                <div class="card-title">
                    Pernyataan
                </div>
            </div>
            <div class="card-body">
                <i>Dengan ini saya menyatakan sudah mengisi formulir ini dengan penuh kesadaran dan dengan data yang sebenar-benarnya.</i>
                <button type="submit" name="submit_form_sp" class="btn btn-primary" style="margin-top: 20px;"><i class="fas fa-envelope-open-text"></i> Kirim Formulir</button>
            </div>
        </div>
        </form>

    </section>
</div>

<?= $this->include("template/footer"); ?>