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
                                            $biaya = $rs->total_jumlah;
                                            echo number_format($biaya);
                                        }
                                        // update data di tabel rekap_kwh
                                        $dt['jumlah'] = $biaya;
                                        $date = time();
                                        $mo = date("M", $date);
                                        $dbs = \Config\Database::connect();
                                        $st = $dbs->table('rekap_jumlah_biaya')->where('bulan', $mo)->update($dt);
                                        ?>
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
                                        }
                                        // update data di tabel rekap_kwh
                                        $data['kwh'] = $total;
                                        $date = time();
                                        $m = date("M", $date);
                                        $db = \Config\Database::connect();
                                        $sa = $db->table('rekap_kwh')->where('bulan', $m)->update($data);
                                        ?>
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
                                            $jml_tok = number_format($jml_token = $rs->jumlah);
                                            // hitung nilai kwh sekarang
                                            $nilai_kwh_skrg = $nilai_kwh - $total;
                                            if ($nilai_kwh_skrg > 0) {
                                                echo $nilai_kwh_akhir = round($nilai_kwh_skrg, 3);
                                            } else if ($nilai_kwh_skrg <= 0) {
                                                echo $nilai_kwh_akhir = '0';
                                            }
                                            // mencari batas nilai terkecil dari kwh, 10% dari nilai awal kwh
                                            $nilai_batas_kwh = (10 / 100) * $nilai_kwh;
                                            if ($nilai_kwh_skrg <= $nilai_batas_kwh) {
                                                // notifikasi dikirim ke bot telegram
                                                if ($nilai_kwh_skrg > 0) {
                                                    $date = date('d F Y') . '%0A';
                                                    $token = '1552089196:AAEx8Pr_c4AnfoAvGS4qlJkEdkjxIBRqoFo';
                                                    $message = $date . 'Halo sisa kWh Listrik Rumah kamu dari pengisian Rp.' . $jml_tok . ' sisa ' . $nilai_kwh_akhir .
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

                                                    // auto refresh web setiap 5 menit
                                                    $url = $_SERVER['REQUEST_URI'];
                                                    header("Refresh: 300; URL=$url");
                                                    redirect()->to('/');
                                                } else if ($nilai_kwh_skrg <= 0) {
                                                    // notifikasi dikirim ke bot telegram
                                                    $date = date('d F Y') . '%0A';
                                                    $token = '1552089196:AAEx8Pr_c4AnfoAvGS4qlJkEdkjxIBRqoFo';
                                                    $message = $date . 'Halo kWh Listrik Rumah kamu dari pengisian ' . $jml_tok . ' sekarang sudah habis.' .
                                                        '%0AListrik rumah dalam keadaan mati.' .
                                                        '%0AJangan lupa melakukan isi token listrik ya';
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

                                                    // auto refresh web setiap 5 menit
                                                    $url = $_SERVER['REQUEST_URI'];
                                                    header("Refresh: 300; URL=$url");
                                                    redirect()->to('/');
                                                }
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
        <!-- Grafik Grais kWh -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">kWh Listrik </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grafik Bar Biaya Listrik -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Jumlah Biaya Pengisian Token Listrik </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <canvas id="myGrafik"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> <!-- /.card -->

<!-- Grafik Garis kWh -->
<?php
foreach ($rekap_kwh as $rs) {
    $b[] = $rs['bulan'];
    $data_kwh[] = $rs['kwh'];
}
$thn = date('Y');
?>
<?php
foreach ($rekap_jumlah_biaya as $rs) {
    $bln_jml[] = $rs['bulan'];
    $jml_biaya[] = $rs['jumlah'];
}
$thn = date('Y');
?>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($b) ?>,
            datasets: [{
                label: 'Grafik kWh Listrik Selama <?php echo $thn ?>',
                data: <?php echo json_encode($data_kwh) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(60, 206, 34, 0.2)',
                    'rgba(241, 206, 54, 0.2)',
                    'rgba(19, 11, 88, 0.2)',
                    'rgba(88, 40, 30, 0.2)',
                    'rgba(20, 111, 186, 0.2)',
                    'rgba(51, 196, 86, 0.2)',
                    'rgba(78, 128, 86, 0.2)',
                    'rgba(100, 206, 86, 0.2)',
                    'rgba(135, 16, 77, 0.2)',
                    'rgba(25, 255, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(60, 206, 34, 1)',
                    'rgba(241, 206, 54, 1)',
                    'rgba(19, 11, 88, 1)',
                    'rgba(88, 40, 30, 1)',
                    'rgba(20, 111, 186, 1)',
                    'rgba(51, 196, 86, 1)',
                    'rgba(78, 128, 86, 1)',
                    'rgba(100, 206, 86, 1)',
                    'rgba(135, 16, 77, 1',
                    'rgba(25, 255, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


    var ctx = document.getElementById("myGrafik").getContext('2d');
    var myGrafik = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($bln_jml) ?>,
            datasets: [{
                label: 'Grafik Pengisian Token Listrik Selama <?php echo $thn ?>',
                data: <?php echo json_encode($jml_biaya) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(60, 206, 34, 0.2)',
                    'rgba(241, 206, 54, 0.2)',
                    'rgba(19, 11, 88, 0.2)',
                    'rgba(88, 40, 30, 0.2)',
                    'rgba(20, 111, 186, 0.2)',
                    'rgba(51, 196, 86, 0.2)',
                    'rgba(78, 128, 86, 0.2)',
                    'rgba(100, 206, 86, 0.2)',
                    'rgba(135, 16, 77, 0.2)',
                    'rgba(25, 255, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(60, 206, 34, 1)',
                    'rgba(241, 206, 54, 1)',
                    'rgba(19, 11, 88, 1)',
                    'rgba(88, 40, 30, 1)',
                    'rgba(20, 111, 186, 1)',
                    'rgba(51, 196, 86, 1)',
                    'rgba(78, 128, 86, 1)',
                    'rgba(100, 206, 86, 1)',
                    'rgba(135, 16, 77, 1',
                    'rgba(25, 255, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<!-- /.content -->
<div class="clearfix"></div>
<?= $this->endSection(); ?>