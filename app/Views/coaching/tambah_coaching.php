<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $pageHeader ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <?= session()->getFlashdata('message'); ?>


        <div class="container-fluid">

            <?= session()->getFlashData('info') ?>

            <?php if (isset($coachingQueue1) && sizeof($coachingQueue1) !== 0) : ?>

                <div class="card card-warning">
                    <div class="card-header">
                        <p class="card-title">Ada <?= sizeof($coachingQueue1); ?> karyawan yang belum anda coaching di semester 1 tahun <?= date('Y'); ?>:</p>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display:none">
                        <ul>
                            <?php foreach ($coachingQueue1 as $key) : ?>
                                <li>
                                    (<?= $key['fnip']; ?>) <?= $key['fnama']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            <?php endif; ?>

            <?php if (isset($coachingQueue2) && sizeof($coachingQueue2) !== 0) : ?>


                <div class="card card-warning">
                    <div class="card-header">
                        <p class="card-title">Ada <?= sizeof($coachingQueue2); ?> karyawan yang belum anda coaching di semester 2 tahun <?= date('Y'); ?>:</p>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display:none">
                        <ul>
                            <?php foreach ($coachingQueue2 as $key) : ?>
                                <li>
                                    (<?= $key['fnip']; ?>) <?= $key['fnama']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex row justify-content-start align-items-center">
                        <?php if ($current_period !== 0) : ?>
                            <button type="button" class="btn btn-block btn-primary col-12 col-md-3 col-sm-12 col-xs-12  mr-3" data-toggle="modal" data-target="#modal-default-coaching" <?= ($coaching_available->periode_1 || $coaching_available->periode_2) ? '' : 'disabled' ?>>
                                <i class="fas fa-plus" style="margin-right:5px;"></i> Tambah Coaching
                            </button>
                        <?php endif; ?>

                        <?php if (!$is_both_period_active) : ?>
                            <?php if ($current_period === 0) : ?>
                                <div class="col-12 col-sm-12 col-xs-12 col-md-12">
                                    <div class="callout callout-warning">
                                        <i>
                                            Formulir pengisian coaching akan dibuka pada:
                                            <ol>
                                                <?php foreach ($openForm as $openForm) : ?>
                                                    <li>Periode <?= $openForm['range_periode']; ?> dibuka <b><?= id_date(date('Y') . '-' . $openForm['start_coaching'], false); ?></b> s/d <b><?= id_date(date('Y') . '-' . $openForm['end_coaching'], false); ?></b></li>
                                                <?php endforeach; ?>
                                            </ol>
                                        </i>
                                    </div>
                                </div>
                            <?php elseif ($current_period === 1) : ?>

                                <div class="col-12 col-sm-12 col-xs-12 col-md-8">
                                    <i>
                                        Formulir pengisian coaching untuk <b> Januari-Juni <?= date('Y'); ?> </b> telah dibuka.
                                    </i>
                                </div>
                            <?php elseif ($current_period === 2) : ?>

                                <div class="col-12 col-sm-12 col-xs-12 col-md-8">
                                    <i>
                                        Formulir pengisian coaching untuk <b>Juli-Desember <?= date('Y'); ?></b> telah dibuka.
                                    </i>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($is_both_period_active) : ?>

                            <div class="col-12 col-sm-12 col-xs-12 col-md-8">
                                <i>
                                    Formulir pengisian coaching untuk <b> Januari-Juni <?= date('Y'); ?> </b> dan <b> Juli-Desember <?= date('Y'); ?> </b> telah dibuka.
                                </i>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Riwayat Coaching Karyawan Anda
                    </div>
                </div>
                <div class="card-body">
                    <!-- <h5>Entri Coaching</h5> -->
                    <!-- <section style="overflow-x: scroll;"> -->
                    <!-- <div class="table-responsive"> -->

                    <!-- <button type="button" class="btn btn-default-primary btn-primary mb-3" data-toggle="modal" data-target="#modal-default">
                    Tambah Coaching
                </button> -->


                    <table id="default_table" class="table table-bordered nowrap table-hover">
                        <thead>
                            <tr>

                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan Karyawan</th>
                                <th>Periode Coaching</th>
                                <th style="width: 5em">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($data as $data) : ?>
                                <tr class=" custom-clickable-row" data-href="<?= base_url("coaching/detail_karyawan/" . $data['id']) ?>">
                                    <td><?= id_date($data['tanggal_coaching']); ?></td>

                                    <td><?= $data['fnama']; ?></td>
                                    <td><?= $data['jabatan']; ?></td>

                                    <td><?= ($data['periode'] === '1') ? 'Januari-Juni' : 'Juli-Desember'; ?></td>
                                    <td> <span class="badge <?= (!$data['status']) ? "badge-warning" : "badge-success"; ?>"><?= (!$data['status']) ? "Pending" : "Terkonfirmasi"; ?> </span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                    <!-- </div> -->
                    <!-- </section> -->
                </div>
            </div>
        </div>






        <div class="modal fade" id="modal-default-coaching">
            <div class="modal-dialog">
                <form id="quiz" action="<?= base_url("coaching/add") ?> " method="POST">
                    <?php csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pilih Karyawan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ui-front">

                            <div class="form-group row">
                                <!-- <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input name="employee_name" type="text" class="form-control" id="name" placeholder="Nama Karyawan">
                                </div> -->


                                <label for="fname" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="employee_name" id="fname" onchange="fillForm()">
                                        <option selected disabled hidden>-- Pilih Karyawan --</option>
                                        <?php foreach ($karyawan as $karyawan) : ?>
                                            <option value="<?= $karyawan['fnip']; ?>"><?= $karyawan['fnama']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                <div class="col-sm-3">
                                    <input readonly name="nip" type="text" class="form-control" id="nip" placeholder="NIP">
                                </div>

                                <label for="gol" class="col-sm-3 col-form-label">Golongan</label>
                                <div class="col-sm-3">
                                    <input readonly name="gol" type="text" class="form-control" id="gol" placeholder="Golongan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input readonly name="jabatan" type="text" class="form-control" id="jabatan" placeholder="Jabatan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-3 col-form-label">Departemen</label>
                                <div class="col-sm-9">
                                    <input readonly name="departemen" type="text" class="form-control" id="departemen" placeholder="Departemen">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                                <div class="col-sm-9">
                                    <input readonly name="unit" type="text" class="form-control" id="unit" placeholder="Unit Kerja/Cabang">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" disabled>Selanjutnya</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    </section>
</div>





<?= $this->include("template/footer"); ?>

<!-- Modal -->