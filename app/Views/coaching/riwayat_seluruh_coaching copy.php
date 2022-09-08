<?= $this->include("template/header"); ?>

<div class="content-wrapper" style="padding-bottom: 5px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Daftar Coaching</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Coaching</li>
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


            <div class="card">
                <div class="card-body">
                    <h5>Menampilkan Data Coaching</h5>
                    <!-- <section style="overflow-x: scroll;"> -->
                    <!-- <div class="table-responsive"> -->

                    <table id="coaching_table" class="table table-bordered nowrap table-hover">
                        <thead>
                            <tr>

                                <th>Tanggal Coaching</th>

                                <!-- atasan -->
                                <th>NIP Atasan</th>
                                <th>Nama Atasan</th>
                                <th>Jabatan Atasan</th>
                                <th>Unit Kerja/Cabang Atasan</th>
                                <th>Departemen</th>

                                <!-- karyawan -->
                                <th>NIP Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan Karyawan</th>
                                <th>Unit Kerja/Cabang Karyawan</th>
                                <th>Departemen</th>

                                <!-- coaching -->
                                <th>Periode Coaching</th>
                                <th>Sasaran Bisnis/Kecakapan Kerja</th>
                                <th>Perilaku Budaya</th>
                                <th>Saran dan Dukungan Atasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $data) : ?>

                                <tr class=" custom-clickable-row" data-href="<?= base_url("/coaching/detail-full/" . $data['id']) ?>">
                                    <td><?= id_date($data['tanggal_coaching'], false); ?></td>
                                    <td><?= $data['fnip_atasan']; ?></td>
                                    <td><?= $data['fnama_atasan']; ?></td>
                                    <td><?= $data['jabatan_atasan']; ?></td>
                                    <td><?= $data['satuan_kerja_atasan']; ?></td>
                                    <td><?= $data['departemen_atasan']; ?></td>

                                    <td><?= $data['fnip_karyawan']; ?></td>
                                    <td><?= $data['fnama_karyawan']; ?></td>
                                    <td><?= $data['jabatan_karyawan']; ?></td>
                                    <td><?= $data['satuan_kerja_karyawan']; ?></td>
                                    <td><?= $data['departemen_karyawan']; ?></td>

                                    <td><?= $data['periode_coaching']; ?></td>
                                    <td><?= $data['sarbis1']; ?></td>
                                    <td><?= $data['budaya_kerja1']; ?></td>
                                    <td><?= $data['saran_dukungan']; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>

                    <!-- </div> -->
                    <!-- </section> -->
                </div>
            </div>
        </div>

    </section>
</div>

<?= $this->include("template/footer"); ?>