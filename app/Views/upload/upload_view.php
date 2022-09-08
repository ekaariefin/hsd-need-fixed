<?= $this->include("template/header"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $pageHeader; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $pageHeader ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <!-- /.card-header -->
        <!-- form start -->

        <div class="card">
            <div class="card-header">
                <form action="<?= base_url('/karyawan/upload'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="karyawan_file" style="cursor:pointer;" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn input-group-text">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <form method="POST" action="<?= base_url('/karyawan/tambah'); ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama barang</label>
                        <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama barang">
                    </div>
                    <div class="form-group">
                        <label for="Harga">Harga</label>
                        <input name="harga" type="number" class="form-control" id="Harga" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input name="stok" type="number" class="form-control" id="stok" placeholder="Stok">
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>







        </div>

        <!-- /.card -->
    </section>
</div>



<?= $this->include("template/footer"); ?>