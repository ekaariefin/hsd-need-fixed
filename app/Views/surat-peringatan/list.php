<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sanksi/Pelanggaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Sanksi dan Pelanggaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content" style="overflow-x: auto;">
        <div class="card card-primary" style="overflow-x: auto;">
            <div class="card-header">
                <div class="card-title">
                    Menampilkan Data Sanksi
                </div>
                <div class="float-right">
                    <a href="<?= base_url('sp/unduh/pdf/all') ?> " class="btn btn-block btn-sm btn-success">
                        <i class="fas fa-file-pdf" style="margin-right: 5px;"></i>Download PDF
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="default_table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Satuan Kerja</th>
                            <th>Jenis Sanksi</th>
                            <th>Tahun Sanksi</th>
                            <th>Pasal Sanksi</th>
                            <th>Tanggal Mulai Sanksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $x) { ?>
                            <tr class=" custom-clickable-row" data-href="<?= base_url() ?>/sp/detail/<?= $x['id_sp'] ?>">
                                <td><?= $x['fnip'] ?></td>
                                <td><?= $x['fnama'] ?></td>
                                <td><?= $x['satuan_kerja'] ?></td>
                                <td>
                                <?php
                                    $jenis_sp = array (
                                        '1',
                                        '2',
                                        '3'
                                    );
                                    if (in_array($x['jenis_sp'], $jenis_sp)){
                                        echo "SP ".$x['jenis_sp'];
                                    }
                                    else {
                                        echo $x['jenis_sp'];
                                    }
                                ?>
                                </td>
                                <td><?= $x['tahun_sp'] ?></td>
                                <td><?= $x['pasal_sp'] ?></td>
                                <td><?= date('d M Y', strtotime($x['tanggal_sp_mulai'])) ?></td>
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
            confirmButtonText: 'Lanjutkan'
        })
    <?php } ?>
</script>