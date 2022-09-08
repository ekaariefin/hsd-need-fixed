<? date_default_timezone_set("Asia/Jakarta"); ?>
<!DOCTYPE html>
<html lang="en" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <link rel="icon" type="image/ico" href="<?= base_url('/public') ?>/dist/img/favicon-32x32.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Summernote -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/summernote/summernote-bs4.min.css">

    <!-- jquery-ui -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/jquery-ui/jquery-ui.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="/dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/dist/css/adminlte.min.css">
    <!-- my custom css -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/dist/css/style.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('/public/') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



</head>

<!-- <body class="hold-transition sidebar-mini  sidebar-collapse layout-fixed layout-navbar-fixed"> -->

<body class="sidebar-mini layout-fixed layout-navbar-fixed" cz-shortcut-listen="true" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto ">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user" style="width: 10px; margin-left: 50px"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('/change-password') ?>" class="dropdown-item">
                            <i class="nav-icon fas fa-key" style="margin-right: 5px;"></i> Ganti Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('/logout') ?>" class="dropdown-item" data-toggle="modal" data-target="#modal-default">
                            <i class="nav-icon fas fa-sign-out-alt" style="margin-right: 5px;"></i> Logout
                        </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <?php if (session()->get('role') == "1") : ?>
            <?= $this->include("template/sidebar_admin_sa"); ?>
        <?php elseif (session()->get('role') == "2") : ?>
            <?= $this->include("template/sidebar_admin_hsd"); ?>
        <?php else : ?>
            <?= $this->include("template/sidebar"); ?>
        <?php endif; ?>