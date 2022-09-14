<?php
//koneksi database
$host = "localhost";
$user = "root";
$password = "";
$database = "vertikultur";

$konek = mysqli_connect($host, $user, $password, $database);
//mysql_select_db($database,$konek);

//baca ID tertinggi
$sql_ID = mysqli_query($konek, "SELECT MAX(ID) FROM tb_sensor");
//tangkap data
$data_ID = mysqli_fetch_array($sql_ID);
//ambil Id terakhir
$ID_akhir = $data_ID['MAX(ID)'];
$ID_awal = $ID_akhir - 59;
//21600


//baca informasi tanggal untuk all data - x di grafik
$tanggal = mysqli_query($konek, "SELECT tanggal FROM tb_sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC LIMIT 6");
//baca informasi suhu u/ semua data - y di grafik
//$suhu = mysqli_query($konek, "SELECT suhu FROM tb_sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC");
$suhu = mysqli_query($konek, "SELECT suhu FROM tb_sensor WHERE ID>='$ID_awal' and ID<='$ID_akhir' ORDER BY ID ASC LIMIT 6");

?>

<canvas id="chart-suhu" width="100%"></canvas>
<script type="text/javascript">
var ctxSuhu = document.getElementById("chart-suhu").getContext('2d');
var gradient = ctxSuhu.createLinearGradient(0, 0, 0, 240);
gradient.addColorStop(0, 'rgba(53, 71, 172, 0.7)');
gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

window.onload = function() {
    window.myLine = new Chart(ctxSuhu, configSuhu);
    window.myLine = new Chart(ctxUdara, configUdara);
    window.myLine = new Chart(ctxTanah, configTanah);
};

var configSuhu = {
    type: 'line',
    data: {
        labels: [1, 2, 3, 4, 5, 6],
        datasets: [{
            backgroundColor: gradient,
            borderColor: '#3547AC',
            fill: true,
            borderWidth: 4,
            pointRadius: 7,
            pointBorderWidth: 4,
            pointHoverRadius: 7,
            pointHoverBorderWidth: 4,
            pointBackgroundColor: '#FFFFFF',
            pointStyle: 'circle',
            data: [<?php
                        while ($data_suhu = mysqli_fetch_array($suhu)) {
                            echo $data_suhu['suhu'] . ',';
                        }
                        ?>],
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
                        return formatNumber(value) + '℃';
                    },
                    stepSize: 20000,
                },
            }, ],
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    return data['datasets'][0]['data'][tooltipItem['index']];
                },
            },
        },
    },
};
</script>