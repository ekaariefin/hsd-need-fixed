<div class="card card-primary">
    <div class="card-header">
        <div class="card-title">
            Beranda
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $activeUser; ?></h3>
                        <p>User Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $nonactiveUser; ?></h3>
                        <p>User Nonaktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-power-off"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $blockUser; ?></h3>
                        <p>User Terblokir</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="container">
                <h5>Grafik User (Kantor Pusat)</h5>
                <br />
                <canvas id="myChart"></canvas>
            </div>
        </div> -->
    </div>