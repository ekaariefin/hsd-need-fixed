<?php $validation = \Config\Services::validation(); ?>
<?php
//MARK: COUNT LEFT DAYS
date_default_timezone_set("Asia/Jakarta");
$date_start     = strtotime($date['date_start']);
$date_end       = strtotime($date['date_end']);
$current_date   = strtotime(date("Y-m-d"));
$current_year  = date('Y');
$previous_year = $current_year - 1;

if (session()->getFlashdata('error_log') == 'Missing Previous Year') {
    // session()->setFlashdata('swal_icon', '');
    $current_year = '2021';
}

$diff = floor($date_end - $current_date) / 60 / 60 / 24;

if ((int)$diff < 0) {
    session()->setFlashdata('swal_icon', 'error');
    session()->setFlashdata('swal_title', 'Maaf!');
    session()->setFlashdata('swal_text', 'Waktu Isi Sasaran Bisnis Telah Berakhir!');
}

//MARK: GET DATA FROM SESSION
$fkode_cab      = session()->get('fkode_cab');
$jabatan        = session()->get('jabatan');
$satuan_kerja   = session()->get('satuan_kerja');

?>
<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formulir Sasaran Bisnis dan Kinerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sasaran Bisnis dan Kinerja</li>
                    </ol>
                </div>
            </div>
        </div>
        <form action="<?= base_url("/sarbis/process_add") ?> " method="POST">
            <?php csrf_field(); ?>
            <section class="content">
                <div class="card card-primary animate__animated animate__bounceInRight">
                    <div class="card-header">
                        <div class="card-title">
                            Identitas Karyawan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input readonly name="employee_name" type="text" value="<?= session()->get('fnama') ?>" class="form-control" id="name" placeholder="Nama Karyawan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-3">
                                <input readonly name="user_sp" type="text" class="form-control" value="<?= session()->get('fnip') ?>">
                            </div>

                            <label for="gol" class="col-sm-3 col-form-label text-right">Gol.</label>
                            <div class="col-sm-3">
                                <input readonly name="gol" type="text" class="form-control" id="gol" value="<?= session()->get('fgrade') ?>" placeholder="Golongan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input readonly name="jabatan" type="text" class="form-control" id="jabatan" value="<?= session()->get('jabatan') ?>" placeholder="Jabatan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-sm-3 col-form-label">Satuan Kerja</label>
                            <div class="col-sm-9">
                                <input readonly name="unit" type="text" class="form-control" id="unit" value="<?= session()->get('satuan_kerja') ?>" placeholder="Unit Kerja/Cabang">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Formulir Sasaran Bisnis dan Kinerja
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Tahun Sasaran Bisnis / Kinerja</label>
                            <div class="col-sm-9">
                                <input readonly name="tahun_sarbis" type="text" value="<?= $current_year; ?>" class="form-control" id="tahun_sarbis">
                            </div>
                        </div>
                        <br />

                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Informasi!</h5>
                            - Pastikan Jumlah Keseluruhan Bobot Berjumlah 100%. <br />
                            - Pengisian Bobot hanya memasukkan Nilai Persen tanpa diikuti Karakter %.<br />
                            - Sasaran Bisnis dan Kinerja ke-1 hingga ke-5 Wajib, ke-6 dan ke-7 Opsional.
                        </div>

                        <table class="table table-hover table-bordered">
                            <tr>
                                <td colspan="2" style="text-align: center; vertical-align: middle;"><b>DETAIL SASARAN BISNIS DAN KINERJA</b></td>

                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis1')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis1') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis1" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 1"></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis1')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis1') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control sarbis1" id="sarbis1" name="bobot_sarbis1" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis2')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis2') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis2" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 2"></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis2')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis2') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control sarbis2" id="sarbis2" name="bobot_sarbis2" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis3')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis3') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis3" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 3"></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis3')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis3') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control sarbis3" id="sarbis3" name="bobot_sarbis3" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis4')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis4') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis4" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 4"></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis4')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis4') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control sarbis4" id="sarbis4" name="bobot_sarbis4" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">
                                    <?php
                                    if ($error = $validation->getError('desc_sarbis5')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('desc_sarbis5') . "</div>";
                                    }
                                    ?>
                                    <textarea type="text" class="form-control" name="desc_sarbis5" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 5"></textarea>
                                </td>
                                <td style="width: 30%;">
                                    <?php
                                    if ($error = $validation->getError('bobot_sarbis5')) {
                                        echo "<div class='alert alert-danger alert-dismissible'>" . $error = $validation->getError('bobot_sarbis5') . "</div>";
                                    }
                                    ?>
                                    <input type="text" class="form-control sarbis5" id="sarbis5" name="bobot_sarbis5" placeholder="Bobot dalam %">
                                </td>
                            </tr>
                            <?php

                            $total_sarbis = 5;
                            $jabatan_sarbis6 = array(
                                "OFFICER",
                                "SENIOR OFFICER",
                                "ACCOUNT OFFICER",
                                "ASSOCIATE ACCOUNT OFFICER",
                                "ASSISTANT ACCOUNT OFFICER",
                                "KEPALA BAGIAN",
                                "KEPALA DEPARTEMEN",
                                "KEPALA SATUAN KERJA",
                                "KEPALA CABANG",
                                "KEPALA CABANG PEMBANTU",
                                "KEPALA BIDANG"
                            );
                            ?>
                            <?php if (in_array($jabatan, $jabatan_sarbis6)) { ?>
                                <tr>
                                    <td style="width: 70%;">
                                        <textarea type="text" class="form-control" name="desc_sarbis6" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 6"></textarea>
                                    </td>
                                    <td style="width: 30%;">
                                        <input type="text" class="form-control sarbis6" id="sarbis6" name="bobot_sarbis6" placeholder="Bobot dalam %">
                                    </td>
                                </tr>
                            <?php $total_sarbis = 6;
                            } ?>
                            <?php
                            $jabatan_sarbis7 = array(
                                "OFFICER",
                                "SENIOR OFFICER",
                                "KEPALA BAGIAN",
                                "KEPALA DEPARTEMEN",
                                "KEPALA SATUAN KERJA",
                                "KEPALA CABANG",
                                "KEPALA CABANG PEMBANTU",
                                "KEPALA BIDANG"
                            );
                            ?>
                            <?php if (in_array($jabatan, $jabatan_sarbis7)) { ?>
                                <tr>
                                    <td style="width: 70%;">
                                        <textarea type="text" class="form-control" name="desc_sarbis7" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 7"></textarea>
                                    </td>
                                    <td style="width: 30%;">
                                        <input type="text" class="form-control sarbis7" id="sarbis7" name="bobot_sarbis7" placeholder="Bobot dalam %">
                                    </td>
                                </tr>
                            <?php $total_sarbis = 7;
                            } ?>
                            <?php
                            $jabatan_sarbis8 = array(
                                "KEPALA CABANG",
                                "KEPALA CABANG PEMBANTU",
                            );
                            ?>
                            <?php if (in_array($jabatan, $jabatan_sarbis8)) { ?>
                                <tr>
                                    <td style="width: 70%;">
                                        <textarea type="text" class="form-control" name="desc_sarbis8" placeholder="Deskripsi Sasaran Bisnis dan Kinerja 8"></textarea>
                                    </td>
                                    <td style="width: 30%;">
                                        <input type="text" class="form-control sarbis8" id="sarbis8" name="bobot_sarbis8" placeholder="Bobot dalam %">
                                    </td>
                                </tr>
                            <?php $total_sarbis = 8;
                            } ?>
                        </table>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Pernyataan
                        </div>
                    </div>
                    <div class="card-body">
                        <i>Dengan ini saya menyatakan sudah mengisi formulir ini dengan penuh kesadaran dan dengan data yang sebenar-benarnya.</i>
                        <br /><button type="submit" name="submit_form_sp" class="btn btn-primary" style="margin-top: 20px;"><i class="fas fa-envelope-open-text"></i> Kirim Formulir</button>
                    </div>
                </div>
        </form>
    </section>
</div>

<?= $this->include("template/footer"); ?>
<script>
    <?php if (session()->getFlashdata('error_log') == 'Missing Previous Year') { ?>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: 'Maaf!',
                text: 'Anda wajib mengisi Formulir Sasaran Bisnis terlebih dahulu sebelum dapat mengisi Formulir PA pada Tahun PA',
                allowOutsideClick: false,
                confirmButtonText: 'Isi Formulir Sekarang'
            }).then(function() {
                <?= session()->setFlashdata('swal_icon', ''); ?>
            })
        <?php } ?>
    <?php } else { ?>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: '<?= session()->getFlashdata('swal_title') ?>',
                text: '<?= session()->getFlashdata('swal_text') ?>',
                allowOutsideClick: false,
                confirmButtonText: 'Saya Mengerti'
            }).then(function() {
                <?= session()->setFlashdata('swal_icon', ''); ?>
                window.location.href = "<?= base_url(''); ?>";
            })
        <?php } ?>
    <?php } ?>
</script>


<script>
    var total_sarbis = <?= $total_sarbis ?>;


    $(document).ready(function() {
        for (let index = 1; index <= total_sarbis; index++) {
            console.log(index);
            idForm = "#sarbis" + String(index);
            $(idForm).on("keyup change", function() {
                var total = 0;
                for (let index = 1; index <= total_sarbis; index++) {
                    total += Number($("#sarbis" + String(index)).val());
                }
                if (total > 100) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Maaf!',
                        text: 'Total Nilai Bobot Tidak Boleh Melebihi 100%',
                        allowOutsideClick: false,
                        confirmButtonText: 'Saya Mengerti'
                    });
                }


            });

        }


    });
</script>