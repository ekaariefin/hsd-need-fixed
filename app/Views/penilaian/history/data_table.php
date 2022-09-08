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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Riwayat Penilaian PA</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-primary animate__animated animate__bounceInRight">
            <div class="card-header">
                <div class="card-title">
                    Daftar Riwayat Penilaian Kinerja
                </div>
            </div>
            <div class="card-body">
                <table id="default_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center;">No.</th>
                            <th style="text-align:center;">Tahun PA</th>
                            <th style="text-align:center;">NIP</th>
                            <th style="text-align:center;">Nama Karyawan</th>
                            <th style="text-align:center;">Nilai PA</th>
                            <th style="text-align:center;">Huruf PA</th>
                            <th style="text-align:center;">Status Persetujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($history as $x) {
                        ?>
                            <?php if ($x['fkode_cab'] == '99') { ?>

                                <?php
                                if ($x['fkode_cab'] == "99") {
                                    //KANTOR PUSAT
                                    if ($x['fgrade'] == "1" or $x['fgrade'] == "2" or $x['fgrade'] == "3") {
                                        $gol = '123';
                                    } else if ($x['fgrade'] == "4" and $x['jabatan'] == "ASSOCIATE OFFICER") {
                                        $gol = '4f';
                                    } else if ($x['fgrade'] == "4" and $x['jabatan'] == "KEPALA BAGIAN") {
                                        $gol = '4s';
                                    } else if ($x['fgrade'] == "5" and $x['jabatan'] == "OFFICER") {
                                        $gol = '5f';
                                    } else if ($x['fgrade'] == "5" and ($x['jabatan'] == "KEPALA BIDANG" or $x['jabatan'] == "KEPALA BAGIAN")) {
                                        $gol = '5s';
                                    } else if ($x['fgrade'] == "6" or $x['fgrade'] == "7") {
                                        $gol = '67';
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
                                        session()->setFlashdata('current_grade', '123');
                                        $x['fgrade'] = '123';
                                    }
                                    $jabatan_struktural = array(
                                        "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                                        "KEPALA BAGIAN OPERASIONAL",
                                        "KEPALA BAGIAN CUSTOMER SERVICE"
                                    );
                                    if (in_array($jabatan, $jabatan_struktural)) {
                                        session()->setFlashdata('current_grade', '4s');
                                        $x['fgrade'] = '4s';
                                    }
                                    $jabatan_ao = array(
                                        "ACCOUNT OFFICER",
                                        "ASSOCIATE ACCOUNT OFFICER",
                                        "ASSISTANT ACCOUNT OFFICER"
                                    );
                                    if (in_array($jabatan, $jabatan_ao)) {
                                        session()->setFlashdata('current_grade', 'ao_reg');
                                        $x['fgrade'] = 'ao_reg';
                                    }

                                    if ($jabatan == "KEPALA ULS") {
                                        session()->setFlashdata('current_grade', 'uls');
                                        $x['fgrade'] = 'uls';
                                    } else if ($jabatan == "KEPALA CABANG PEMBANTU") {
                                        session()->setFlashdata('current_grade', 'kcp');
                                        $x['fgrade'] = 'kcp';
                                    } else if ($jabatan == "KEPALA OPERASI CABANG") {
                                        session()->setFlashdata('current_grade', 'koc');
                                        $x['fgrade'] = 'koc';
                                    } else if ($jabatan == "KEPALA CABANG") {
                                        session()->setFlashdata('current_grade', 'kcu');
                                        $x['fgrade'] = 'kcu';
                                    }
                                }

                                $gol = $x['fgrade'];

                                ?>

                                <tr class=" custom-clickable-row" data-href="<?= base_url() ?>/penilaian/DetailPenilaian/gol_<?= $gol; ?>/<?= $x['id_pn']; ?>">
                                <?php } else if (session()->get('role') == '2') { ?>
                                <tr>
                                <?php } else {
                                if ($x['fgrade'] == 'ka_uls') {
                                    $x['fgrade'] = 'uls';
                                } else if ($x['fgrade'] == 'ka_kc') {
                                    $x['fgrade'] = 'kc';
                                } else if ($x['fgrade'] == 'ka_kcp') {
                                    $x['fgrade'] = 'kcp';
                                } else if ($x['fgrade'] == 'ao_reg') {
                                    $x['fgrade'] = 'ao';
                                } else if ($x['fgrade'] == 'ka_koc') {
                                    $x['fgrade'] = 'koc';
                                }

                                ?>
                                <tr class=" custom-clickable-row" data-href="<?= base_url() ?>/penilaian/DetailPenilaian/cab_gol_<?= $x['fgrade']; ?>/<?= $x['id_pn']; ?>">
                                <?php } ?>


                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: center;"><?= $x['tahun_pa'] ?></td>
                                <td style="text-align: center;"><?= $x['id_user'] ?></td>
                                <td><?= $x['fnama'] ?></td>
                                <td style="text-align: center;"><?= bcdiv($x['angka_pa'], 1, 2); ?></td>
                                <td style="text-align: center;"><?= $x['huruf_pa'] ?></td>

                                <?php
                                if (empty($x['approval_satu']) and empty($x['approval_dua'])) {
                                    echo '<td style="text-align: center;"><span class="badge bg-warning">Menunggu Persetujuan</span></td>';
                                } else if (($x['approval_satu'] === 'Revision') or ($x['approval_dua'] === 'Revision')) {
                                    echo '<td style="text-align: center;"><span class="badge bg-danger">Revisi Penilaian</span></td>';
                                } else if (empty($x['approval_satu']) or empty($x['approval_dua'])) {
                                    echo '<td style="text-align: center;"><span class="badge bg-warning">Dalam Peninjauan</span></td>';
                                } else {
                                    echo '<td style="text-align: center;"><span class="badge bg-success">Disetujui</span></td>';
                                }
                                ?>
                                </tr>
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
            confirmButtonText: 'Lanjutkan',
            allowOutsideClick: false,
        })
    <?php } ?>
</script>