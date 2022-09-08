<?= $this->include("template/header"); ?>

<div class="content-wrapper" style="padding-bottom: 5px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $pageHeader; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <!-- <div class="card">
                <div class="card-body">
                    <h6>Cari Berdasarkan</h6>
                    <select class="form-control">
                        <option selected>-- Pilih Satuan Kerja --</option>
                        <option>Satuan Kerja Audit Internal</option>
                        <option>Satuan Kerja TI dan Logistik</option>
                        <option>Satuan Kerja Hukum dan SDM</option>
                        <option>Satuan Kerja Management Risiko</option>
                    </select>
                    <button type="button" class="btn btn-primary" style="margin-top:15px;"><i class="fas fa-search" style="margin-right: 5px;"></i>Cari</button>
                </div>
            </div> -->


            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Menampilkan Riwayat Coaching
                    </div>

                </div>
                <div class="card-body">
                    <!-- <section style="overflow-x: scroll;"> -->
                    <!-- <div class="table-responsive"> -->


                    <div class="row d-flex justify-content-between">
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <div class="btn btn-success mb-2 col-12" onclick="downloadCoaching()"><i class="fas fa-file-excel"></i> Unduh</div>
                        </div>


                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <form action="<?= base_url('coaching/histori-all'); ?>" method="get">
                                <div class="input-group input-group">
                                    <input type="search" class="form-control" placeholder="masukan kata kunci" name="keyword">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- <span>Cari: </span><input type="text" name="cari" id="cari" placeholder="masukan kata kunci"> -->

                    </div>

                    <?php if ($keyword !== null) : ?>
                        <h6>Menampilkan pencarian untuk <b>"<?= $keyword; ?>"</b></h6>
                    <?php endif; ?>

                    <table id="table_riwayat_coaching_non_datatable" class="table table-bordered nowrap table-hover">
                        <thead>
                            <tr>

                                <th style="max-width: 7em;">#</th>
                                <th>Tanggal</th>
                                <th>Periode</th>

                                <th>NIP Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan Karyawan</th>
                                <!-- atasan -->
                                <th>Satuan Kerja</th>
                                <th>Departemen</th>

                                <!-- karyawan -->


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + ($data_per_page * ($page_number - 1));
                            foreach ($data as $data) : ?>

                                <tr class="custom-clickable-row" data-href="<?= base_url("/coaching/detail-full/" . $data['id']) ?>">
                                    <td><?= $i; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= $data['range_periode']; ?></td>
                                    <td><?= $data['fnip_karyawan']; ?></td>
                                    <td><?= $data['fnama_karyawan']; ?></td>

                                    <td><?= $data['jabatan_karyawan']; ?></td>
                                    <td><?= $data['satuan_kerja_karyawan']; ?></td>
                                    <td><?= $data['departemen_karyawan']; ?></td>


                                </tr>
                            <?php
                                $i++;
                            endforeach; ?>

                        </tbody>

                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $pager->links('coaching', 'bootstrap_pagination') ?>
                    </div>

                    <!-- </div> -->
                    <!-- </section> -->
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->include("template/footer"); ?>