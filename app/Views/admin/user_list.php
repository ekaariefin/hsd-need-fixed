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
                        <li class="breadcrumb-item active">Daftar User</li>
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
                        Security Administrator
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id User</th>
                                <th>Tanggal Pembuatan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admin_sa as $x) : ?>
                                <tr>
                                    <td><?= $x['userid'] ?></td>
                                    <td><?= id_date(date('Y-m-d', strtotime($x['created_at']))) ?></td>
                                    <td style="white-space: nowrap; text-align: center;"><span class="badge <?= ($x['status'] != 1) ? "badge-secondary" : (((int)$x['blokir'] === 0) ? "badge-success" : "badge-danger"); ?>"><?= ($x['status'] != 1) ? "Tidak Aktif" : (((int)$x['blokir'] === 0) ? "Aktif" : "Blokir"); ?>
                                    </td>
                                    <td style="white-space: nowrap; width:13px; text-align: center;">
                                        <a class="btn btn-sm btn-primary" href="<?= base_url("user/" . $x["userid"]); ?>" role="button"><i class="fas fa-eye"></i></a>
                                        <!-- <a class="btn btn-warning" href="<?= base_url("/format-password/" . $x["userid"]); ?>" role="button"><i class="fas fa-lock"></i></a> -->
                                        <!-- <button type="button" class="btn <?= ($x['status'] != 1) ? "btn-secondary" : "btn-danger"; ?>"><i class="fas fa-power-off"></i></button> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Administrator SKHSD
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id User</th>
                                <th>Tanggal Pembuatan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admin_hsd as $x) : ?>
                                <tr>
                                    <td><?= $x['userid'] ?></td>
                                    <td><?= id_date(date('Y-m-d', strtotime($x['created_at']))) ?></td>
                                    <td style="white-space: nowrap; text-align: center;"><span class="badge <?= ($x['status'] != 1) ? "badge-secondary" : (((int)$x['blokir'] === 0) ? "badge-success" : "badge-danger"); ?>"><?= ($x['status'] != 1) ? "Tidak Aktif" : (((int)$x['blokir'] === 0) ? "Aktif" : "Blokir"); ?></td>
                                    <td style="white-space: nowrap; width:13px; text-align: center;">
                                        <a class="btn btn-sm btn-primary" href="<?= base_url("user/" . $x["userid"]); ?>" role="button"><i class="fas fa-eye"></i></a>
                                        <!-- <a class="btn btn-warning" href="<?= base_url("/format-password/" . $x["userid"]); ?>" role="button"><i class="fas fa-lock"></i></a> -->
                                        <!-- <button type="button" class="btn <?= ($x['status'] != 1) ? "btn-secondary" : "btn-danger"; ?>"><i class="fas fa-power-off"></i></button> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Daftar User (Karyawan)
                    </div>
                </div>
                <div class="card-body">
                    <table id="default_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="max-width: 5px;">#</th>
                                <th>User ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getUser as $x) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $x['userid'] ?></td>
                                    <td><?= $x['nama'] ?></td>
                                    <td><?= $x['email'] ?></td>
                                    <td style="white-space: nowrap; text-align: center;">
                                        <span class="badge <?= ($x['status'] != 1) ? "badge-secondary" : (((int)$x['blokir'] === 0) ? "badge-success" : "badge-danger"); ?>"><?= ($x['status'] != 1) ? "Tidak Aktif" : (((int)$x['blokir'] === 0) ? "Aktif" : "Blokir"); ?>
                                    </td>
                                    <td style="white-space: nowrap; width:13px; text-align: center;">
                                        <a class="btn btn-sm btn-primary" href="<?= base_url("user/" . $x["userid"]); ?>" role="button"><i class="fas fa-eye"></i></a>
                                        <!-- <a class="btn btn-warning" href="<?= base_url("/format-password/" . $x["userid"]); ?>" role="button"><i class="fas fa-lock"></i></a> -->
                                        <!-- <button type="button" class="btn <?= ($x['status'] != 1) ? "btn-secondary" : "btn-danger"; ?>"><i class="fas fa-power-off"></i></button> -->
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </section>
</div>

<?= $this->include("template/footer"); ?>