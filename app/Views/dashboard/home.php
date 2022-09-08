<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>PT Bank BCA Syariah</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php if (session()->get('role') == "1") {
                require 'home_sa.php';
            } else if (session()->get('role') == "2") {
                require 'home_hsd.php';
            } else if (session()->get('role') == "3") {
                // require 'home_spv.php';
                require 'home_employee.php';
            } else if (session()->get('role') == "4") {
                require 'home_employee.php';
            } else {
            ?>
                <?php foreach ($coaching as $coaching) : ?>
                    <div class="animate__animated animate__bounceInDown">
                        <a href="<?= base_url('coaching/detail/' . $coaching['id']); ?>">
                            <div class="card alert alert-warning alert-dismissible fade show" role="alert">
                                Hasil coaching pada tanggal <?= id_date($coaching['tanggal_coaching']) ?> belum anda setujui
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

                <div class="container-fluid animate__animated animate__bounceInDown">
                    <div class="card">

                        <div class="card-body">

                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Nama
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->fnama; ?> <br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    NIP
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->fnip; ?> <br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Jabatan
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->jabatan; ?> <br />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Satuan Kerja
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->satuan_kerja; ?> <br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Departemen
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->departemen; ?> <br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Fungsi/Bidang
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->fungsi; ?> <br />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Golongan
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->fgrade; ?> <br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Kantor
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= (session()->fkode_cab == '99') ? 'JABODETABEK' : 'NON-JABODETABEK'; ?> <br />
                                </div>
                            </div>



                            <br /><br />
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Atasan 1
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= session()->get('atasan1.nama'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-2 col-md-2">
                                    Atasan 2
                                </div>
                                <span>
                                    :
                                </span>
                                <div class="col">
                                    <?= (session()->get('atasan2.nip') <= 0) ? "Tidak Ada Data" : session()->get('atasan2.nama'); ?>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>



    </section>
</div>
<?= $this->include("template/footer"); ?>
<?= $this->include("dashboard/script_hsd.php"); ?>
<script>
    <?php if (session()->getFlashdata('swal_icon')) { ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('swal_icon') ?>',
            title: '<?= session()->getFlashdata('swal_title') ?>',
            text: '<?= session()->getFlashdata('swal_text') ?>',
            allowOutsideClick: false,
            confirmButtonText: 'Ganti Password'
        }).then(function() {
            window.location.href = "<?= base_url('/change-password'); ?>";
        })
    <?php } ?>
</script>