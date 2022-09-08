<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Bank BCA Syariah | Login Aplikasi Coaching & Penilaian Kinerja</title>
    <link rel="icon" type="image/ico" href="/dist/img/favicon-32x32.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="hold-transition login-page">
    <div class="login-box animate__animated animate__bounceInUp">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="<?= base_url('/public/') ?>/bcas.png" style="height: 40px;">
            </div>
            <div class="card-body" style="text-align: center;">
                <b>LOGIN</b>
                <p class="login-box-msg">Aplikasi Coaching & Penilaian Kinerja</p>

                <?= session()->getFlashdata('message'); ?>


            </div>
            <div class="card-footer">
                <p class="d-flex justify-content-center" style="text-align: center">
                    &copy; <?= date('Y'); ?> PT Bank BCA Syariah<br />
                </p>
            </div>
        </div>
    </div>
    <script src=" <?= base_url('/public/') ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('/public/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/public/') ?>/dist/js/adminlte.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        var timestamp = '<?= time(); ?>';

        function updateTime() {
            $('#time').html(Date(timestamp));
            timestamp++;
        }
        $(function() {
            setInterval(updateTime, 1000);
        });
    </script>
    <!-- sweetalert2 cdn -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: '<?= session()->getFlashdata('swal_title') ?>',
                text: '<?= session()->getFlashdata('swal_text') ?>',
                confirmButtonText: 'Saya Mengerti',
                footer: 'Apa yang harus saya lakukan?'
            })
        <?php } ?>
    </script>
</body>

</html>