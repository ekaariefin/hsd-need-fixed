<?= $this->include("template/header"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content mt-2">
        <div class="error-page">
            <h2 class="headline text-warning"> 403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Access Forbidden.</h3>

                <p>
                    Anda tidak diizinkan mengakses halaman ini.
                    Silakan <a href="<?= base_url(); ?>">kembali ke beranda</a>
                </p>

            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->include("template/footer"); ?>