<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header ">
        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6 ">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right ">
                        <li class="breadcrumb-item "><a href="<?= base_url() ?> ">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= base_url('coaching'); ?>">Tambah Coaching</a></li>
                        <li class="breadcrumb-item active "><?= $pageHeader ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid  ">
            <form id="quiz" action="<?= base_url("coaching/save") ?> " method="POST">
                <?php csrf_field(); ?>

                <div class="card card-primary">
                    <div class="card-header ">
                        <h1 class="card-title ">I. Identitas Karyawan</h1>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" name="fnama_karyawan" id="name" placeholder="Nama Karyawan" value="<?= $coachee['employee_name'] ?>" readonly> -->
                                <select class="form-control" name="employee_name" id="fname" onchange="fillForm()">

                                    <?php foreach ($karyawan as $karyawan) : ?>
                                        <option value="<?= $karyawan['fnip']; ?>" <?= ($karyawan['fnip'] == $coachee['nip']) ? "selected" : ""; ?>><?= $karyawan['fnama']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="fnip_karyawan" id="nip" placeholder="NIP" value="<?= $coachee['nip'] ?>" readonly>
                            </div>

                            <label for="gol" class="col-sm-2 col-form-label">Golongan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="golongan_karyawan" id="gol" placeholder="Golongan" value="<?= $coachee['gol'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jabatan_karyawan" id="jabatan" placeholder="Jabatan" value="<?= $coachee['jabatan'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 col-form-label">Departemen</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="departemen_karyawan" id="departemen" placeholder="Jabatan" value="<?= $coachee['departemen'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-sm-2 col-form-label">Unit Kerja/Cabang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="unit_kerja_karyawan" id="unit" placeholder="Unit Kerja/Cabang" value="<?= $coachee['unit'] ?>" readonly>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title ">II. Pelaksanaan Coaching</h1>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%;vertical-align: middle;"><b> Tanggal Coaching </b></td>
                                        <td> <input type="date" data-date-format="DD MM YYYY" class="form-control" data-target="#reservationdate" name="tanggal_coaching" pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?= date('Y-m-d'); ?>" /></td>
                                    </tr>
                                </table>


                            </div>
                            <div class="col-12 col-md-6 col-xl-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%;vertical-align: middle;"><b> Periode Coaching </b></td>
                                        <td>

                                            <select name="periode" <?= ($is_both_period_active) ? '' : ''; ?> class="form-control">
                                                <option value="1" <?= ($is_both_period_active) ? '' : (($current_period == 1) ? 'selected' : ''); ?>>Januari-Juni</option>
                                                <option value="2" <?= ($is_both_period_active) ? '' : (($current_period == 2) ? 'selected' : ''); ?>>Juli-Desember</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">III. Sasaran Bisnis/Kecakapan Kerja</h3>
                        <div class="float-right">
                            <i class="fas fa-info-circle" data-toggle='modal' data-target='#show_sarbis' data-id='KERJASAMA'></i>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="align-middle">Deskripsi</th>
                                    <th class="align-middle"> Pencapaian</th>
                                </tr>
                            </thead>
                            <tbody class="sasaran-bisnis">
                                <?php for ($i = 0; $i < $limit_sarbis; $i++) : ?>
                                    <tr class="form-sasaran-bisnis-<?= $i; ?>">
                                        <td>
                                            <div class="form-group ">
                                                <textarea row="4" class="form-control  <?= ($validation->hasError("sasaran_bisnis.sarbis.$i")) ? 'is-invalid' : ''; ?>" row="4" name="sasaran_bisnis[sarbis][]" placeholder="Masukkan sasaran bisnis atau kecakapan kerja karyawan"><?= old("sasaran_bisnis.sarbis.$i"); ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError("sasaran_bisnis.sarbis.$i"); ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">

                                            <div class="d-flex">
                                                <div class="form-group flex-fill">
                                                    <textarea class="form-control <?= ($validation->hasError("sasaran_bisnis.realisasi.$i")) ? 'is-invalid' : ''; ?>" row="4" name="sasaran_bisnis[realisasi][]" placeholder="Masukkan capaian atau progress sasaran bisnis/kecakapan kerja karyawan"><?= old("sasaran_bisnis.realisasi.$i"); ?></textarea>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError("sasaran_bisnis.realisasi.$i"); ?>
                                                    </div>
                                                </div>
                                                <?php if ($i >= 3) : ?>
                                                    <div>
                                                        <button type='button' onclick="deleteForm('.form-sasaran-bisnis-<?= $i; ?>');" class='btn btn-tool'>
                                                            <i class='fas fa-times' style="color: red;"></i>
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>


                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" onclick="addFormSasaran();"><i class="fas fa-plus" style="margin-right:5px;"></i>Tambah Baris</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">IV. Perilaku Budaya</h3>
                        <div class="float-right">
                            <i class="fas fa-info-circle" data-toggle='modal' data-target='#show_perilaku' data-id='KERJASAMA'></i>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody class="perilaku-kerja">
                                <?php for ($i = 0; $i < $limit_perilaku_kerja; $i++) : ?>
                                    <tr class="form-perilaku-kerja-<?= $i; ?>">
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-group flex-fill">
                                                    <textarea id="coaching-form" row="4" class="form-control  <?= ($validation->hasError("perilaku_kerja.$i")) ? 'is-invalid' : ''; ?>" name="perilaku_kerja[]" placeholder="Masukan perilaku kerja karyawan anda"><?= old("perilaku_kerja.$i"); ?></textarea>

                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError("perilaku_kerja.$i"); ?>
                                                    </div>
                                                </div>
                                                <?php if ($i >= 2) : ?>
                                                    <div>
                                                        <button type='button' onclick="deleteForm('.form-perilaku-kerja-<?= $i; ?>');" class='btn btn-tool'>
                                                            <i class='fas fa-times' style="color: red;"></i>
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>


                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <!-- <button type="button" class="col-3 col-md-3 col-sm-6 col-xs-12 btn btn-block btn-primary" onclick="addFormBudaya('haha');"><i class="fas fa-arrow-right" style="margin-right:5px;"></i>Tambah Baris</button> -->
                            <button type="button" class="btn btn-primary" onclick="addFormBudaya();"><i class="fas fa-plus" style="margin-right:5px;"></i>Tambah Baris</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">V. Saran dan Dukungan</h3>
                        <div class="float-right">
                            <i class="fas fa-info-circle" data-toggle='modal' data-target='#show_dukungan' data-id='KERJASAMA'></i>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody class="dukunganform">
                                <tr class="formDukungan1">
                                    <td>
                                        <div class="form-group ">
                                            <textarea class="form-control <?= ($validation->hasError('dukungan')) ? 'is-invalid' : ''; ?>" rows="4" cols="50" name="dukungan" placeholder="Masukkan saran dan dukungan anda"><?= old("dukungan"); ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('dukungan'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <!-- /.card-header -->

                    <!-- <div class="card-body">
                       
                    </div> -->
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-8">
                                <i>
                                    Sebelum disimpan secara permanen data coaching akan menunggu konfirmasi telah menerima isi coaching dari karyawan yang bersangkutan. <br>
                                    Data yang telah tersimpan bersifat permanen dan tidak dapat diubah kembali.
                                </i>
                            </div>
                            <div class="col-12 col-md-4 d-flex  justify-content-end">

                                <button type="submit" class="btn btn-block btn-success col-12 col-md-12 col-sm-12 col-xs-12 mt-3 mb-3"><i class="fas fa-save" style="margin-right:5px;"></i>Simpan</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
        </div>
    </section>
</div>

<?= $this->include("template/footer"); ?>

<div class="modal fade" id="show_dukungan" tabindex="-1" role="dialog" aria-labelledby="show_dukunganTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Formulir Saran dan Dukungan Atasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Atasan menuliskan :
                <ul>
                    <li>
                        Apa yang akan dilakukan oleh pekerja berdasarkan diskusi dengan pekerja
                    </li>
                    <li>
                        Apa yang akan dilakukan atasan untuk kemajuan pekerja (baik sasaran bisnismaupun diperilaku budaya)
                    </li>
                    <li>
                        bisa juga berisi training/pengembangan yang akan diberikan ke ybs. (lengkap dengan judul training dan waktu) yang mendukung pencapaian target dan pengembangan diri pekerja .
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="show_sarbis" tabindex="-1" role="dialog" aria-labelledby="show_sarbisTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Formulir Sasaran Bisnis/Kecakapan Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul>
                    <li>
                        Berisi pencapaian target/sasaran bisnis:
                    </li>
                    <li>
                        Coaching 1 mengulas pencapaian sd coaching 1 dan ditambahkan target yang akan dicapai di Coaching 2 , diharapkan bisa lebih efektif pencapaiannya.
                    </li>
                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="show_perilaku" tabindex="-1" role="dialog" aria-labelledby="show_perilakuTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Formulir Perilaku Budaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Ulasan terhadap perilaku budaya berisi :
                <ul>
                    <li>
                        Perilaku yang sudah bagus dan dipertahankan
                    </li>
                    <li>
                        Perilaku yg harus ditingkatkan
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>