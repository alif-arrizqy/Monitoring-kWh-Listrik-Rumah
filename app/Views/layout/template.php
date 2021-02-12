<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Monitoring Listrik PLN</title>
    <meta name="description" content="Skripsi Monitoring Listrik PLN">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('/public/assets/images/eco-house.png') ?>" type="image/png">

    <!-- CSS -->
    <?= $this->include('layout/css') ?>

</head>

<body>
    <?= $this->include('layout/menu') ?>
    <div id="right-panel" class="right-panel">
        <!-- Right Panel -->
        <?= $this->include('layout/nav') ?>
        <!-- /#Right Panel -->
        <!-- Content -->
        <?= $this->renderSection('content'); ?>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                    Skripsi Monitoring Listrik PLN
                    </div>
                    <div class="col-sm-6 text-right">
                        Copyright &copy; 2021 Wahyu Dwitia
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->    
    </div>
    <!-- JS -->
    <?= $this->include('layout/js') ?>
</body>