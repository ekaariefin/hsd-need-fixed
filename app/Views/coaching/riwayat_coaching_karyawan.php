<?= $this->include("template/header"); ?>

<div class="content-wrapper" style="padding-bottom: 5px;">

    <section class="content-header ">
        <div class="container-fluid ">
            <div class="row mb-2 ">
                <div class="col-sm-6 ">
                    <h5><?= $pageHeader; ?></h5>
                </div>
                <div class="col-sm-6 ">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Coaching</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>



    <section class="content">

        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Riwayat Coaching Anda
                    </div>
                </div>
                <div class="card-body">

                    <!-- <section style="overflow-x: scroll;"> -->
                    <!-- <div class="table-responsive"> -->

                    <table id="employee_coaching_table" class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th style="max-width: 7px;">#</th>
                                <th>Tanggal</th>
                                <th>Periode Coaching</th>
                                <!-- atasan -->
                                <th>Nama Atasan</th>
                                <th>Jabatan Atasan</th>
                                <th>Departemen Atasan</th>
                                <th>Satuan Kerja Atasan</th>
                                <!-- coaching -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data as $data) : ?>
                                <tr class=" custom-clickable-row" data-href="<?= base_url("coaching/detail/" . $data['id']) ?>">
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['tanggal_coaching']; ?></td>
                                    <td><?= $data['periode']; ?></td>
                                    <td><?= $data['fnama']; ?></td>
                                    <td><?= $data['jabatan']; ?></td>
                                    <td><?= $data['departemen']; ?></td>
                                    <td><?= $data['satuan_kerja']; ?></td>
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