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
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Log Aktivitas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    Menampilkan Log Aktivitas
                </div>
            </div>
            <div class="card-body">

                <div class="row d-flex justify-content-end">

                    <div class="form-group col-12 col-sm-6 col-md-4">
                        <form action="<?= base_url('log'); ?>" method="get">
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
                <!-- table_riwayat_coaching_non_datatable -->
                <table style="max-width: 100%;" id="table_riwayat_coaching_non_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="max-width: 7em;">#</th>
                            <th>Waktu</th>
                            <th>Kode Aktivitas</th>
                            <th>User Agent</th>
                            <th>IP Address</th>
                            <th>User Id</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + ($data_per_page * ($page_number - 1));
                        foreach ($log as $x) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $x['created_at'] ?></td>
                                <td><?= $x['activity_code'] ?></td>
                                <td><?= $x['user_agent'] ?></td>
                                <td><?= $x['ip_address'] ?></td>
                                <td><?= $x['user_id'] ?></td>
                                <td><?= $x['user_name'] ?></td>

                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                    <?= $pager->links('log', 'bootstrap_pagination') ?>
                </div>

            </div>
        </div>

    </section>
</div>

<?= $this->include("template/footer"); ?>