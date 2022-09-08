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
                    Detail Pemberian Sanksi
                </div>
            </div>
            <div class="card-body" style="overflow-x: auto">
                <table class="table table-bordered" style="width: 100%;">
                    <tr>
                        <td style="width: 40%;"><b>Jenis Sanksi</b></td>
                        <td style="width: 60%;"><?= $list['jenis_sp']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;"><b>Nomor Sanksi</b></td>
                        <td style="width: 60%;"><?= $list['nomor_sp']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;"><b>Tanggal Sanksi Mulai</b></td>
                        <td style="width: 60%;">
                            <?php 
                                $system_date = $list['tanggal_sp_mulai']; 
                                $timestamp = strtotime($system_date);
                                $new_date = date("d M Y", $timestamp);
                                echo $new_date;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 40%;"><b>Tanggal Sanksi Berakhir<br><small>Sesuai ketentuan PKB, Sanksi SP berlaku 6 bulan<i></i></small></b></td>
                        <td style="width: 60%;">
                            <?php 
                                $system_date = $list['tanggal_sp_akhir']; 
                                $timestamp = strtotime($system_date);
                                $new_date = date("d M Y", $timestamp);
                                echo $new_date;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 40%;"><b>Pasal Sanksi</b></td>
                        <td style="width: 60%;"><?= $list['pasal_sp']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;"><b>Estimasi Pengurangan PA</b></td>
                        <td style="width: 60%;"><?= $list['poin_sp']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><b>Perihal Sanksi</b></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?= $list['perihal_sp']; ?></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td>
                            <a type="button" href="<?= base_url() ?>/sp/edit/<?= $list['id_sp']; ?>" class="btn btn-warning"><i class="fas fa-edit" style="margin-right: 5px;"></i>Ubah SP</a>
                            <a type="button" id="BtnDelete" class="btn btn-danger" style="margin-left:10px;color:white"><i class="fas fa-trash-alt" style="margin-right: 5px;"></i>Hapus SP</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</div>
        
<?= $this->include("template/footer"); ?>
<script>
  $(document).ready(function(){
    $('#BtnDelete').click(function(){
            Swal.fire({
            icon: 'warning',
            title: 'Konfirmasi',
            text: 'Apakah anda yakin ingin menghapus data SP ini?',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    text: 'Data Berhasil Dihapus',
                    title: 'Berhasil!',
                    confirmButtonText: 'Lanjutkan'
                }).then(function() {
                    window.location.href = "<?= base_url('sp/delete'); ?>/<?= $list['id_sp']; ?>";
                })
            }});
    });
  });
</script>
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