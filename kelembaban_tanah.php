<?php
include 'database.php';
//baca ID tertinggi
$sql_ID = mysqli_query($konek, "SELECT MAX(ID) FROM tb_sensor");
//tangkap data
$data_ID = mysqli_fetch_array($sql_ID);
//ambil Id terakhir
$ID_akhir = $data_ID['MAX(ID)'];
$ID_awal = $ID_akhir - 59;
//21600


//baca informasi tanggal untuk all data - x di grafik
$tanggal = mysqli_query($konek, "SELECT tanggal FROM tb_sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC LIMIT 60");
//baca informasi suhu u/ semua data - y di grafik
//$suhu = mysqli_query($konek, "SELECT suhu FROM tb_sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");
$sqlSuhu = "SELECT `kelembaban_tanah` FROM `tb_sensor` ORDER BY ID ASC LIMIT 60;";

$result = mysqli_query($konek, $sqlSuhu);
$suhu = $result->fetch_all(MYSQLI_ASSOC);

//Suhu Length
$lengthData = count($suhu);
// Suhu Latest Data
$getSuhuAwal = $suhu[$lengthData - 1]['kelembaban_tanah'];

$listSuhu = array();

foreach ($suhu as $dataSuhu) {
    array_push($listSuhu,  $dataSuhu['kelembaban_tanah']);
}

//Mean Suhu
$averageTemp = array_sum($listSuhu) / count($listSuhu);


?>

<h5>Data Terakhir Kelembaban Tanah</h5>
<div class="row justify-content-between">
    <div class="col-4">
        <h4><?php echo $getSuhuAwal; ?> adc</h4>
        <h6>Nilai terakhir</h6>
    </div>
    <div class="col-4">
        <h4><?php echo number_format($averageTemp, 2); ?> adc</h4>
        <h6>Nilai rata-rata</h6>
    </div>
    <div class="col-4 text-center">
        <span style="font-size: 43px; color: #003500">
            <i class="fa-solid fa-fill-drip"></i>
        </span>
    </div>
</div>
<div>
    <canvas id="chart-kelembaban-tanah" width="100%"></canvas>
    <script type="text/javascript">
        var ctxTanah = document.getElementById("chart-kelembaban-tanah").getContext('2d');
        var gradient = ctxTanah.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, 'rgba(53, 71, 172, 0.7)');
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

        window.onload = function() {
            window.myLine = new Chart(ctxTanah, configTanah);
            window.myLine = new Chart(ctxSuhu, configSuhu);
            window.myLine = new Chart(ctxUdara, configUdara);
        };

        var configTanah = {
            type: 'line',
            data: {
                labels: [
                    <?php
                    for ($i = 0; $i < 60; $i++) {
                        echo $i . ',';
                    }
                    ?>
                ],
                datasets: [{
                    backgroundColor: gradient,
                    borderColor: '#003500',
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBorderWidth: 4,
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 4,
                    pointBackgroundColor: '#FFFFFF',
                    pointStyle: 'circle',
                    data: [
                        <?php
                        foreach ($suhu as $dataSuhu) {
                            echo $dataSuhu['kelembaban_tanah'] . ',';
                        }
                        ?>

                    ],
                }, ],
            },
            options: {
                legend: {
                    display: false,
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        },
                    }, ],
                    yAxes: [{
                        ticks: {
                            callback: function(value) {
                                var ranges = [{
                                        divider: 1e6,
                                        suffix: 'M'
                                    },
                                    {
                                        divider: 1e3,
                                        suffix: 'k'
                                    },
                                ];

                                function formatNumber(n) {
                                    for (var i = 0; i < ranges.length; i++) {
                                        if (n >= ranges[i].divider) {
                                            return (
                                                (n / ranges[i].divider).toString() + ranges[i].suffix
                                            );
                                        }
                                    }
                                    return n;
                                }
                                return formatNumber(value);
                            },
                            stepSize: 100,
                        },
                    }, ],
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data['datasets'][0]['data'][tooltipItem['index']] + ' adc';
                        },
                    },
                },
            },
        };
    </script>