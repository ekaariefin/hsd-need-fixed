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

        <div class="card">
            <div class="card-body">
                <form id="quiz" action="<?= base_url("coaching/add") ?> " method="POST">
                    <div class="card-content">
                        <div class="card-header">
                            <h4 class="card-title">Data Coachee</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" name="employee_name" type="text" class="form-control" id="name" placeholder="Nama Karyawan">
                                    <div class="result"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                <div class="col-sm-3">
                                    <input readonly name="nip" type="text" class="form-control" id="nip" placeholder="NIP">
                                </div>

                                <label for="gol" class="col-sm-3 col-form-label text-right">Gol.</label>
                                <div class="col-sm-3">
                                    <input readonly name="gol" type="text" class="form-control" id="gol" placeholder="Golongan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input readonly name="jabatan" type="text" class="form-control" id="jabatan" placeholder="Jabatan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-sm-3 col-form-label">Unit Kerja/Cabang</label>
                                <div class="col-sm-9">
                                    <input readonly name="unit" type="text" class="form-control" id="unit" placeholder="Unit Kerja/Cabang">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <div class="mr-3">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
        </div>


    </section>
</div>




<?= $this->include("template/footer"); ?>