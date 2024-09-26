<?php require_once('_header.php') ?>
<?php 
include('function.php');

// Query untuk memilih `j_paket` yang unik dari tabel yang digabungkan
$data = mysqli_query($koneksi, "
    SELECT DISTINCT j_paket 
    FROM (
        SELECT j_paket FROM tb_riwayat_ck
        UNION
        SELECT j_paket FROM tb_riwayat_cs
        UNION
        SELECT j_paket FROM tb_riwayat_dc
    ) AS combined_table
");

// Query untuk menjumlahkan `total` dan mengelompokkan berdasarkan `j_paket` dari tabel yang digabungkan
$penjualan = mysqli_query($koneksi, "
    SELECT j_paket, SUM(total) AS sold 
    FROM (
        SELECT j_paket, total FROM tb_riwayat_ck
        UNION ALL
        SELECT j_paket, total FROM tb_riwayat_cs
        UNION ALL
        SELECT j_paket, total FROM tb_riwayat_dc
    ) AS combined_table
    GROUP BY j_paket
");

$labels = [];
$data_points = [];

while($row = mysqli_fetch_assoc($penjualan)) {
    $labels[] = $row['j_paket'];
    $data_points[] = $row['sold'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Penjualan</title>
    <link rel="stylesheet" href="_assets/css/statitic.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="main-container">
        <h1>Grafik dan Tabel Penjualan</h1>
        <div class="content-container">
            <div class="chart-container">
                <h2>Grafik Penjualan</h2>
                <canvas id="penjualan"></canvas>
            </div>
            <div class="table-container">
                <h2>Tabel Penjualan</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Jenis Paket</th>
                            <th>Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($labels as $index => $label): ?>
                        <tr>
                            <td><?php echo $label; ?></td>
                            <td>Rp. <?php echo $data_points[$index]; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
      var ctxPenjualan = document.getElementById('penjualan').getContext('2d');
      var myChartPenjualan = new Chart(ctxPenjualan, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: '# of Sales',
                data: <?php echo json_encode($data_points); ?>,
                backgroundColor: ['#7FFFD4', '#17BEBB', '#FFC914', '#FF6F61', '#6B5B95', '#88B04B', '#FFA07A', '#CD5C5C'],
                borderColor: '#333',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333'
                    },
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)'
                    }
                },
                x: {
                    ticks: {
                        color: '#333'
                    },
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#333'
                    }
                }
            }
        }
      });
    </script>
</body>
</html>

<?php require_once('_footer.php') ?>
