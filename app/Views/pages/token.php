
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
                        <form action="<?= base_url('/pages/save_token/') ?>" method="post" class="">
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
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?= $this->endSection(); ?>