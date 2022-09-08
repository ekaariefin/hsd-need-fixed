<?= $this->include("template/header"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Riwayat Penilaian Kinerja</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kantor Pusat</a></li>
                        <li class="breadcrumb-item active">Riwayat Penilaian PA</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Daftar Riwayat Penilaian Karyawan
                </div>
                <div class="float-right">
                    <a href="<?= base_url('penilaian/all/pdf') ?> " class="btn btn-block btn-sm btn-success">
                        <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>Download PDF
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="table_all_appraisal" class="table table-bordered table-striped display nowrap">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">NIP</th>
                            <th style="text-align: center;">Tahun PA</th>
                            <th style="text-align: center;">Nama Karyawan</th>
                            <th style="text-align: center;">Satuan Kerja</th>
                            <th style="text-align: center;">Departemen</th>
                            <th style="text-align: center;">Huruf PA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($getList as $x) { ?>
                            <?php
                            if ($x['fkode_cab'] == "99") {
                                //KANTOR PUSAT
                                if ($x['fgrade'] == "1" or $x['fgrade'] == "2" or $x['fgrade'] == "3") {
                                    session()->setFlashdata('current_grade', '123');
                                } else if ($x['fgrade'] == "4" and $x['jabatan'] == "ASSOCIATE OFFICER") {
                                    session()->setFlashdata('current_grade', '4F');
                                } else if ($x['fgrade'] == "4" and $x['jabatan'] == "KEPALA BAGIAN") {
                                    session()->setFlashdata('current_grade', '4S');
                                } else if ($x['fgrade'] == "5" and $x['jabatan'] == "OFFICER") {
                                    session()->setFlashdata('current_grade', '5F');
                                } else if ($x['fgrade'] == "5" and ($x['jabatan'] == "KEPALA BIDANG" or $x['jabatan'] == "KEPALA BAGIAN")) {
                                    session()->setFlashdata('current_grade', '5S');
                                } else if ($x['fgrade'] == "6" or $x['fgrade'] == "7") {
                                    session()->setFlashdata('current_grade', '67');
                                } else {
                                    //MARK: TAMPILKAN SWAL ERROR
                                }
                            } else if ($x['fkode_cab'] != '99') {
                                $jabatan = $x['jabatan'];

                                $jabatan_kecakapan_kerja = array(
                                    "BACK OFFICE SENIOR OPERASIONAL",
                                    "BACK OFFICE SENIOR ADMINISTRASI KANTOR",
                                    "CUSTOMER SERVICE SENIOR",
                                    "BACK OFFICE ADMINISTRASI KANTOR (FUNGSI POOLING)",
                                    "BACK OFFICE SENIOR ADMINISTRASI KANTOR ",
                                    "TELLER",
                                    "BACK OFFICE SENIOR ADMINISTRASI KANTOR (FUNGSI POOLING)",
                                    "STAF OPERASIONAL",
                                    "CUSTOMER SERVICE",
                                    "BACK OFFICE OPERASIONAL",
                                    "BACK OFFICE ADMINISTRASI KANTOR",
                                    "BACK OFFICE ADMINISTRASI KANTOR (FUNGSI SALES ADMIN)",
                                    "BACK OFFICE OPERASIONAL ",
                                    "BACK OFFICE OPERASIONAL",
                                    "BACK OFFICE OPERASIONAL (FUNGSI POOLING)",
                                    "STAF OPERASIONAL SENIOR"
                                );
                                if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
                                    session()->setFlashdata('current_grade', 'cab_123');
                                }
                                $jabatan_struktural = array(
                                    "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                                    "KEPALA BAGIAN OPERASIONAL",
                                    "KEPALA BAGIAN CUSTOMER SERVICE"
                                );
                                if (in_array($jabatan, $jabatan_struktural)) {
                                    session()->setFlashdata('current_grade', 'cab_4s');
                                }
                                $jabatan_ao = array(
                                    "ACCOUNT OFFICER",
                                    "ASSOCIATE ACCOUNT OFFICER",
                                    "ASSISTANT ACCOUNT OFFICER"
                                );
                                if (in_array($jabatan, $jabatan_ao)) {
                                    session()->setFlashdata('current_grade', 'cab_ao');
                                }

                                if ($jabatan == "KEPALA ULS") {
                                    session()->setFlashdata('current_grade', 'cab_uls');
                                } else if ($jabatan == "KEPALA CABANG PEMBANTU") {
                                    session()->setFlashdata('current_grade', 'cab_kcp');
                                } else if ($jabatan == "KEPALA OPERASI CABANG") {
                                    session()->setFlashdata('current_grade', 'cab_koc');
                                } else if ($jabatan == "KEPALA CABANG") {
                                    session()->setFlashdata('current_grade', 'cab_kcu');
                                }
                            }
                            ?>
                            <!-- <tr class=" custom-clickable-row" data-href="<?= base_url('penilaian/otorisasi/detail') . '/' . session()->getFlashdata('current_grade') . '/' . $x['id_pn'] ?>"> -->
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: center;"><?= $x['id_user'] ?></td>
                                <td style="text-align: center;"><?= $x['tahun_pa'] ?></td>
                                <td><?= $x['fnama'] ?></td>
                                <td><?= $x['satuan_kerja'] ?></td>
                                <td><?= $x['departemen'] ?></td>
                                <td style="text-align: center;"><?= $x['huruf_pa'] ?></td>
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
            allowOutsideClick: false,
            confirmButtonText: 'Saya Mengerti'
        }).then(function() {
            <?php
            session()->setFlashdata('swal_icon', '');
            ?>
            window.location.href = "<?= base_url('penilaian/otorisasi'); ?>";
        })
    <?php } ?>
</script>