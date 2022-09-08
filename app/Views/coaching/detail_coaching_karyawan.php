<?= $this->include("template/header"); ?>


<div class="content-wrapper" style="padding-bottom: 5px;">

    <section class="content-header ">
        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6 ">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right ">
                        <li class="breadcrumb-item "><a href="<?= base_url() ?> ">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= base_url('/coaching/history'); ?>">Riwayat Coaching</a></li>
                        <li class="breadcrumb-item active"><?= $pageHeader ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>



    <section class="content ">

        <?= session()->getFlashdata('message'); ?>



        <?php if (!$status) : ?>

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                        Anda belum melakukan konfirmasi pada data coaching ini, jika coaching telah sesuai silahkan konfirmasi melalui tombol paling bawah halaman ini.
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-sm-12">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-12 col-sm align-middle">
                                <h6 class="align-middle">Tanggal Coaching:</h6>
                            </div>
                            <div class="col-12 col-sm">
                                <h5><?= id_date($tanggal); ?></h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-sm">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-12 col-sm">
                                <h6>Periode Coaching: </h6>
                            </div>
                            <div class="col-12 col-sm">
                                <h5><?= $periode['value']; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="container-fluid  ">
            <div class="card card-primary">
                <div class="card-header ">
                    <h1 class="card-title ">Identitas Atasan</h1>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="fnama_karyawan" id="name" placeholder="Nama Karyawan" value="<?= $atasan['nama'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="fnip_karyawan" id="nip" placeholder="NIP" value="<?= $atasan['nip'] ?>" readonly>
                        </div>

                        <label for="gol" class="col-sm-2 col-form-label">Golongan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="golongan_karyawan" id="gol" placeholder="Golongan" value="<?= $atasan['golongan'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jabatan_karyawan" id="jabatan" placeholder="Jabatan" value="<?= $atasan['jabatan'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-2 col-form-label">Departemen</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="departemen_karyawan" id="departemen" placeholder="Departemen" value="<?= $karyawan['departemen'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-2 col-form-label">Unit Kerja/Cabang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="unit_kerja_karyawan" id="unit" placeholder="Unit Kerja/Cabang" value="<?= $atasan['satuan_kerja'] ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Data Pelaksanaan Coaching
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td style="width: 40%;"> <b>Periode Coaching </b></td>
                            <td><?= $periode['value']; ?> (<?= date("Y", strtotime($tanggal)); ?>)</td>
                        </tr>
                        <tr>
                            <td><b> Tanggal Coaching (aktual) </b></td>
                            <td> <?= id_date($tanggal, false); ?></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Input Data</b></td>
                            <td><?= id_date(date("Y-m-d", strtotime($tanggal_input_data)), false); ?></td>
                        </tr>
                        <tr>
                            <td><b> Tanggal Konfirmasi Karyawan</b></td>
                            <td><?= ($tanggal_konfirmasi_coaching !== null) ?   id_date(date("Y-m-d", strtotime($tanggal_konfirmasi_coaching)), false) : "menunggu konfirmasi"; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sasaran Bisnis/Kecakapan Kerja</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (sizeof($sarbis) == 0) : ?>
                        <h5 class="d-flex justify-content-center">Data kosong</h5>
                    <?php else : ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="align-middle">Deskripsi</th>
                                    <th class="align-middle"> Pencapaian</th>
                                </tr>
                            </thead>
                            <tbody class="sasaranbisnisform">
                                <?php $i = 1; ?>
                                <?php foreach ($sarbis as $sarbis) : ?>
                                    <tr>
                                        <td style="width: 2%;"><?= $i++; ?></td>
                                        <td>
                                            <?= $sarbis['sarbis']; ?>
                                        </td>
                                        <td class="align-middle">
                                            <!-- Date -->
                                            <?= $sarbis['realisasi']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php $i = 1; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Perilaku Kerja</h3>
                </div>
                <!-- /.card-header -->
                <!-- <div class="card-body p-0">  p-0 untuk margin-->
                <div class="card-body">

                    <?php if (sizeof($perilaku) == 0) : ?>

                        <h5 class="d-flex justify-content-center">Data kosong</h5>

                    <?php endif; ?>
                    <table class="table table-bordered table-hover">
                        <?php foreach ($perilaku as $perilaku) : ?>

                            <tr>
                                <td style="width: 2%;"><?= $i++; ?> </td>
                                <td><?= $perilaku; ?></td>
                            </tr>

                        <?php endforeach; ?>
                        <?php $i = 1; ?>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Saran dan Dukungan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (sizeof($dukungan) == 0) : ?>

                        <h5 class="d-flex justify-content-center">Data kosong</h5>

                    <?php endif; ?>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>
                                <ul style="list-style-type:none">
                                    <?php foreach ($dukungan as $dukungan) : ?>



                                        <li> <?= $dukungan; ?></li>


                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>



        <?php if (!$status) : ?>

            <div class="container-fluid">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-footer">
                        <div class="row">
                            <!-- <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-info"></i> Ketentuan Kata Sandi:</h5>
                                <p>
                                    Hasil coaching yang telah dikonfirmasi tidak dapat diubah kembali, pastikan coaching telah sesuai.
                                </p>
                            </div>
                            <div class="d-flex justify-content-end col-sm">
                                <button type="button" class="btn btn-block btn-success col-12 col-md-3 col-sm-6 col-xs-12 mt-3 mb-3" data-toggle="modal" data-target="#modal-default-coaching"><i class="fas fa-fw fa-check" style="margin-right:5px;"></i>Setujui Hasil Coaching</button>
                            </div> -->
                            <div class="d-flex justify-content-end col-sm">
                                <button type="button" class="btn btn-block btn-success col-12 col-md-3 col-sm-6 col-xs-12 mt-3 mb-3" data-toggle="modal" data-target="#modal-default-coaching"><i class="fas fa-fw fa-check" style="margin-right:5px;"></i>Konfirmasi Hasil Coaching</button>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


        <?php endif; ?>


        <form id="quiz" action="<?= base_url("coaching/commit") ?> " method="POST">
            <div class="modal fade" id="modal-default-coaching">
                <div class="modal-dialog">
                    <?php csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-body ui-front">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p class="text-center">Silahkan ketikkan</p>
                            <h6 id="text_commit" class="text-center font-weight-bold text-lowercase"> "Saya telah membaca seluruh hasil coaching ini"</h6>
                            <p class="text-center"> jika hasil coaching ini telah sesuai</p>

                            <div class="form-group">
                                <input hidden readonly name="id" type="text" class="form-control" id="id" placeholder="id coaching" value="<?= $id; ?>">
                            </div>
                            <div class="form-group">
                                <input autocomplete="off" name="commit" type="text" class="form-control" id="commit" placeholder="tulis kembali text diatas">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" disabled>Selanjutnya</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->

                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </form>
    </section>
</div>


<?= $this->include("template/footer"); ?>