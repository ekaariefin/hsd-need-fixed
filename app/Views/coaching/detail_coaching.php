<?= $this->include("template/header"); ?>


<div class="content-wrapper" style="padding-bottom: 5px;">
    <section class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6 ">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right ">
                        <li class="breadcrumb-item "><a href="<?= base_url() ?> ">Home</a></li>
                        <li class="breadcrumb-item "><a href="<?= base_url('/coaching'); ?>">Tambah Coaching</a></li>
                        <li class="breadcrumb-item active"><?= $pageHeader ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>



    <section class="content ">
        <?= session()->getFlashdata('message'); ?>

        <!-- alert belum konfirmasi  -->
        <?php if (!$status) : ?>
            <div class="container-fluid">

                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                    Karyawan anda belum meninjau dan mengkonfirmasi kesesuaian data coaching ini.
                </div>
            </div>


        <?php endif; ?>

        <!-- indentitas -->
        <div class="container-fluid">
            <?php if ($atasan['nip'] === session()->fnip) : ?>
                <div class="card card-primary">
                    <div class="card-header ">
                        <h1 class="card-title ">Identitas Karyawan</h1>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="fnama_karyawan" id="name" placeholder="Nama Karyawan" value="<?= $karyawan['nama'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="fnip_karyawan" id="nip" placeholder="NIP" value="<?= $karyawan['nip'] ?>" readonly>
                            </div>

                            <label for="gol" class="col-sm-3 col-form-label">Golongan</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="golongan_karyawan" id="gol" placeholder="Golongan" value="<?= $karyawan['golongan'] ?>" readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jabatan_karyawan" id="jabatan" placeholder="Jabatan" value="<?= $karyawan['jabatan'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Departemen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="departemen_karyawan" id="departemen" placeholder="Departemen" value="<?= $karyawan['departemen'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="unit_kerja_karyawan" id="unit" placeholder="Unit Kerja/Cabang" value="<?= $karyawan['satuan_kerja'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-12 col-md-6 col-sm-12">
                        <!-- indentitas -->

                        <div class="card card-primary">
                            <div class="card-header ">
                                <h1 class="card-title ">Identitas Karyawan</h1>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="fnama_karyawan" id="name" placeholder="Nama Karyawan" value="<?= $karyawan['nama'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="fnip_karyawan" id="nip" placeholder="NIP" value="<?= $karyawan['nip'] ?>" readonly>
                                    </div>

                                    <label for="gol" class="col-sm-3 col-form-label">Golongan</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="golongan_karyawan" id="gol" placeholder="Golongan" value="<?= $karyawan['golongan'] ?>" readonly>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jabatan_karyawan" id="jabatan" placeholder="Jabatan" value="<?= $karyawan['jabatan'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-3 col-form-label">Departemen</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="departemen_karyawan" id="departemen" placeholder="Departemen" value="<?= $karyawan['departemen'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="unit_kerja_karyawan" id="unit" placeholder="Unit Kerja/Cabang" value="<?= $karyawan['satuan_kerja'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-6 col-sm">

                        <div class="card card-primary">
                            <div class="card-header ">
                                <h1 class="card-title ">Identitas Atasan</h1>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="fnama_karyawan" id="name" placeholder="Nama Karyawan" value="<?= $atasan['nama'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="fnip_karyawan" id="nip" placeholder="NIP" value="<?= $atasan['nip'] ?>" readonly>
                                    </div>

                                    <label for="gol" class="col-sm-3 col-form-label">Golongan</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="golongan_karyawan" id="gol" placeholder="Golongan" value="<?= $atasan['golongan'] ?>" readonly>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jabatan_karyawan" id="jabatan" placeholder="Jabatan" value="<?= $atasan['jabatan'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-3 col-form-label">Departemen</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="departemen_karyawan" id="departemen" placeholder="Departemen" value="<?= $atasan['departemen'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="unit_kerja_karyawan" id="unit" placeholder="Unit Kerja/Cabang" value="<?= $atasan['satuan_kerja'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
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
                            <td><?= ($tanggal_konfirmasi_coaching !== null) ?   id_date(date("Y-m-d", strtotime($tanggal_konfirmasi_coaching)), false) : "menunggu konfirmasi karyawan"; ?></td>
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
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


            <!-- /.card -->
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
                        <?php $i = 1; ?>
                        <?php foreach ($perilaku as $perilaku) : ?>

                            <tr>
                                <td style="width: 2%;"><?= $i++; ?> </td>
                                <td><?= $perilaku; ?></td>
                            </tr>

                        <?php endforeach; ?>

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
            <!-- <form action="<?= base_url("coaching/edit/$id"); ?>" method="GET"> -->
            <div class="container-fluid  ">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-end">
                            <button onclick="deleteCoaching()" type="button" class="btn btn-danger mr-2"><i class="fas fa-fw fa-eraser"></i>Hapus</button>

                            <button onclick='window.location.href="<?= base_url("coaching/edit/$id"); ?>"' type="submit" class="btn btn-warning"><i class="fas fa-fw fa-edit" style="margin-right:5px;"></i>Ubah</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- </form> -->

        <?php endif; ?>

    </section>
</div>


<?= $this->include("template/footer"); ?>

<script>
    function deleteCoaching() {
        Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin akan menghapus data coaching ini?',
            html: `
                <form action="<?= base_url('coaching/delete') ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="id" id="id" value="<?= $id; ?>" readonly hidden required> 
                    </div>

                    <button id="submitButton" type="submit" class="btn btn-danger">Hapus Data</button>
                </form>
           
                `,
            // confirmButtonText: `<button type="submit">Nonaktikan</button></form>`,
            focusConfirm: false,
            showConfirmButton: false,

            // icon: 'success',
            confirmButtonText: 'Kembali',
            target: '#content'
        })
    }
</script>