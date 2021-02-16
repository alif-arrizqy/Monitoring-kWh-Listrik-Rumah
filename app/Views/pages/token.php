<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Content -->
<?php if (session()->get('sukses')) { ?>
    <div class="flash-data-success" data-sukses="<?= session()->getFlashdata('sukses'); ?>"></div>
<?php } elseif (session()->get('gagal')) { ?>
    <div class="flash-data-failed" data-gagal="<?= session()->getFlashdata('gagal'); ?>"></div>
<?php } ?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Token</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Token</a></li>
                            <li class="active"><a href="<?= base_url('/pages/token') ?>">Input Token</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Input Token<small> (Masukkan nilai token untuk mengaktifkan <b>Notifikasi</b>)</small></div>
                    <div class="card-body card-block">
                        <form action="<?= base_url('/pages/save_token/') ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                    <input type="number" id="inputJumlah" name="inputJumlah" placeholder="Masukan harga token (contoh: 500000)" class="form-control">
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <input type="submit" class="btn btn-success btn-sm" value="Submit"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Riwayat Pengisian Token</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Jumlah</center></th>
                                    <th><center>kWh</center></th>
                                    <th><center>Tanggal</center></th>
                                    <th><center>Bulan</center></th>
                                    <th><center>Waktu Pengisian</center></th>
                                    <th><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($token as $rs) { ?>
                                    <tr>
                                        <td><center><?= $no++ ?></center></td>
                                        <td><center><?= $rs['jumlah'] ?></center></td>
                                        <td><center><?= $rs['kwh'] ?></center></td>
                                        <td><center><?= $rs['tanggal'] ?></center></td>
                                        <td><center><?= $rs['bulan'] ?></center></td>
                                        <td><center><?= $rs['waktu'] ?></center></td>
                                        <td>
                                            <center>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $rs['id'] ?>">
                                                    <i class="fa fa-pencil"></i></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $rs['id'] ?>">
                                                    <i class="fa fa-trash"></i></button>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Edit -->
                <?php foreach ($token as $rs) {
                    $id = $rs['id'];
                    $jml = $rs['jumlah'];
                ?>
                    <?php if (session()->get('sukses')) { ?>
                        <div class="flash-data-success" data-sukses="<?= session()->getFlashdata('sukses'); ?>"></div>
                    <?php } elseif (session()->get('gagal')) { ?>
                        <div class="flash-data-failed" data-gagal="<?= session()->getFlashdata('gagal'); ?>"></div>
                    <?php } ?>
                    <div class="modal fade" id="editModal<?= $rs['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel">Edit Token</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php echo form_open('/pages/edit_token/' . $rs['id']) ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                            <input type="number" id="inputJumlah" name="inputJumlah" value="<?= $jml ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
                <!-- Modal Hapus -->
                <?php foreach ($token as $rs) {
                    $id = $rs['id'];
                    $jml = $rs['jumlah'];
                ?>
                    <?php if (session()->get('hapus')) { ?>
                        <div class="flash-data-success" data-sukses="<?= session()->getFlashdata('hapus'); ?>"></div>
                    <?php } elseif (session()->get('gagal')) { ?>
                        <div class="flash-data-failed" data-gagal="<?= session()->getFlashdata('gagal'); ?>"></div>
                    <?php } ?>
                    <div class="modal fade" id="deleteModal<?= $rs['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="smallmodalLabel">Hapus Token</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php echo form_open('/pages/delete_token/' . $rs['id']) ?>
                                <div class="modal-body">
                                    <p>Anda Yakin Akan Hapus Data Ini ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?= $this->endSection(); ?>