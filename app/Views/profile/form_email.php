<?php $validation = \Config\Services::validation(); ?>
<?= $this->include("template/header"); ?>
<?= $this->include("template/sidebar"); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perbarui Email Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                Perbarui Email
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('profile/process-email') ?>" method="POST">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td style="width: 30%;"><b>NIP</b></td>
                                        <td>
                                            <?= $info['fnip']; ?>
                                            <input type="hidden" name="fnip" value="<?= $info['fnip']; ?>"
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Alamat Email</b></td>
                                        <td>
                                        <?php
                                            if($error = $validation->getError('email')){
                                                echo "<div class='alert alert-danger alert-dismissible'>".$error = $validation->getError('email')."</div>";
                                            } 
                                        ?>
                                            <input type="email" class="form-control" name="email" value="<?= $info['email']; ?>" 
                                                <?php 
                                                    if(empty($info['email'])) { 
                                                        echo 'placeholder="Email belum terdaftar"'; 
                                                    }
                                                ?> >
                                        </td>
                                    </tr>
                                </table>
                                
                                <table class="table" style="border: none;">
                                    <tr style="border: none;">
                                        <td class="d-flex justify-content-end" style="border: none;">
                                            <button type="button" onClick="window.location.reload();" class="btn btn-warning "> <b><i class="fas fa-redo" style="margin-right: 5px;"></i>Batalkan</b></a>
                                            <button type="submit" class="btn btn-success" style="margin-left: 10px;"> <b><i class="fas fa-edit" style="margin-right: 5px;"></i>Perbarui Email</b></a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>
<?= $this->include("template/footer"); ?>
