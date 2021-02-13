<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$date = time();
$bln = date("F", $date);
?>
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">Rp.
                                        <?php foreach ($jumlah->getResult() as $rs) {
                                            echo number_format($rs->total_jumlah);
                                        } ?>
                                    </div>
                                    <div class="stat-heading">Total Biaya Listrik Bulan <?php echo $bln ?> (Rupiah)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-gleam"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">
                                        <?php foreach ($kwh->getResult() as $rs) {
                                            $nilai_kwh = $rs->total_kwh_bulan;
                                            // menghitung kwh listrik
                                            $total = $nilai_kwh / 1000;
                                            echo round($total, 3);
                                        } ?>
                                        kWh
                                    </div>
                                    <div class="stat-heading">Total Pemakaian Listrik Bulan <?php echo $bln ?> (kWh)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-graph3"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">
                                        <?php foreach ($token->getResult() as $rs) {
                                            $id = $rs->id;
                                            $nilai_kwh = $rs->kwh;
                                            // hitung nilai kwh sekarang
                                            $nilai_kwh_skrg = $nilai_kwh - $total;
                                            echo $nilai_kwh_akhir = round($nilai_kwh_skrg, 3);

                                            // mencari batas nilai terkecil dari kwh, 10% dari nilai awal kwh
                                            $nilai_batas_kwh = (10 / 100) * $nilai_kwh;
                                            if ($nilai_kwh_akhir < $nilai_batas_kwh) {
                                                // notifikasi dikirim ke bot telegram
                                                $date = date('d F Y') . '%0A';
                                                $token = '1552089196:AAEx8Pr_c4AnfoAvGS4qlJkEdkjxIBRqoFo';
                                                $message = $date . 'Halo sisa kWh Listrik Rumah kamu tinggal ' . $nilai_kwh_akhir .
                                                    ' kWh. %0AJangan lupa melakukan isi token listrik ya';
                                                $api = 'https://api.telegram.org/bot' . $token . '/sendMessage?chat_id=908456455&text=' . $message . '';
                                                $ch = curl_init($api);
                                                curl_setopt($ch, CURLOPT_HEADER, false);
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                // curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                $result = curl_exec($ch);
                                                curl_close($ch);
                                                // var_dump($api);

                                                // auto refresh web setiap 1 menit
                                                $url = $_SERVER['REQUEST_URI'];
                                                header("Refresh: 60; URL=$url");
                                                redirect()->to('/');
                                            }
                                        }
                                        ?>
                                        kWh</div>
                                    <div class="stat-heading">Pemakaian Listrik Saat Ini (kWh)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-home"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">1300</span> VA</div>
                                    <div class="stat-heading">Daya Listrik Rumah</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Traffic </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card-body">
                                <canvas id="TrafficChart"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-body">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Daya </h4>
                                    <div class="por-txt">96,930 Users (40%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Bounce Rate</h4>
                                    <div class="por-txt">3,220 Users (24%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Unique Visitors</h4>
                                    <div class="por-txt">29,658 Users (60%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Targeted Visitors</h4>
                                    <div class="por-txt">99,658 Users (90%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div> <!-- /.card-body -->
                        </div>
                    </div> <!-- /.row -->
                </div>
            </div>
        </div>
        <!--  Arus  -->
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Realtime Arus </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <div id="arus" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--  /Arus -->
        <!--  Tegangan  -->
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Realtime Tegangan </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <div id="tegangan" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--  /Tegangan -->

    </div>
</div> <!-- /.card -->

<!-- /.content -->
<div class="clearfix"></div>
<?= $this->endSection(); ?>