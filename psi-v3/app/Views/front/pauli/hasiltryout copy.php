<?php
$request = \Config\Services::request();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Pauli Kreplin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/dist/css/adminlte.min.css">
  <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">

  <style>
    .chart-wrapper {
    max-width: 900px;   /* atur sesuai kebutuhan */
    height: 400px;
    margin: 40px auto;  /* INI YANG MEMUSATKAN */
}

.chart-wrapper canvas {
    width: 100% !important;
    height: 100% !important;
    display: block;
}


  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?= $this->include('admin/navbar') ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6">
        
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card" id="dv_print">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center"><h2>HASIL PENILAIAN</h2></div>
                            <hr> 
                            <div class="card">
                                <div class="card-body">
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <table border="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left text-bold" width="100">Nama</td>
                                                        <td class="text-center" width="30">:</td>
                                                        <td class="text-left"><?= $user[0]->person_nm ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left text-bold" width="100">Satuan</td>
                                                        <td class="text-center" width="30">:</td>
                                                        <td class="text-left"><?= $user[0]->satuan_nm ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left text-bold" width="100">TTL</td>
                                                        <td class="text-center" width="30">:</td>
                                                        <td class="text-left"><?= $user[0]->birth_place ?>, <?= date("d-m-Y",strtotime($user[0]->birth_dttm)) ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <hr>
                            <div class="card">
                                <div class="card-body">

                                    <div class="row"><!-- ROW WAJIB -->

                                        <!-- LEMBAR 1 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 1</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[1] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- LEMBAR 2 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 2</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[2] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div><!-- END ROW -->

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <div class="row"><!-- ROW WAJIB -->

                                        <!-- LEMBAR 1 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 3</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[3] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- LEMBAR 2 -->
                                        <div class="col-md-6">
                                            <div class="text-center mb-3">
                                                <h3>Lembar 4</h3>
                                            </div>

                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kolom</th>
                                                        <th class="text-center">Terjawab</th>
                                                        <th class="text-center">Tidak Terjawab</th>
                                                        <th class="text-center">Salah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; foreach ($hasil[4] as $row) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= $row->kolom_nm ?></td>
                                                        <td class="text-center"><?= $row->terjawab ?></td>
                                                        <td class="text-center"><?= $row->tidak_terjawab ?></td>
                                                        <td class="text-center"><?= $row->salah ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div><!-- END ROW -->

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 1</h3></div>
                                            <canvas id="chart_sk_1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 2</h3></div>
                                            <canvas id="chart_sk_2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 3</h3></div>
                                            <canvas id="chart_sk_3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="chart-wrapper">
                                            <div class="text-center"><h3>Lembar 4</h3></div>
                                            <canvas id="chart_sk_4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>s
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/dist/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const hasil = <?= json_encode($hasil) ?>;

    function buildCharts() {
        for (let sk_group_id = 1; sk_group_id <= 4; sk_group_id++) {

            const dataSk = hasil[sk_group_id];
            if (!dataSk) continue;

            // 👇 GROUP PER 3 KOLOM
            const grouped = groupTerjawabPer3Kolom(dataSk);

            const ctx = document
                .getElementById('chart_sk_' + sk_group_id)
                .getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: grouped.labels,
                    datasets: [{
                        label: 'Terjawab',
                        data: grouped.values,
                        tension: 0.3,
                        borderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 0,
                            max: 60,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        }
    }

    buildCharts();

    function groupTerjawabPer3Kolom(dataSk) {
        const labels = [];
        const values = [];

        for (let i = 0; i < dataSk.length; i += 3) {
            const chunk = dataSk.slice(i, i + 3);

            // Label: Kolom 1 - Kolom 3
            const label = chunk.length > 1
                ? chunk[0].kolom_nm + ' - ' + chunk[chunk.length - 1].kolom_nm
                : chunk[0].kolom_nm;

            // Jumlah terjawab
            const totalTerjawab = chunk.reduce(
                (sum, item) => sum + parseInt(item.terjawab),
                0
            );

            labels.push(label);
            values.push(totalTerjawab);
        }

        return { labels, values };
    }

    </script>
</body>
</html>