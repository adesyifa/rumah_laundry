<?php
include '_functions.php';

function getData($table) {
    $conn = getDatabaseConnection();
    $data = [];

    // Ubah sesuai dengan nama kolom tgl_klr
    $dateColumnName = 'tgl_klr';

    // Pastikan nama kolom tgl_klr disanitasi untuk menghindari SQL injection
    $dateColumnNameSafe = $conn->real_escape_string($dateColumnName);

    $sql = "SELECT $dateColumnNameSafe AS date, value FROM $table ORDER BY $dateColumnNameSafe";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Konversi tanggal dari varchar ke format yang bisa diproses oleh Chart.js
            // Contoh sederhana: jika tanggal dalam format 'YYYY-MM-DD', bisa langsung digunakan
            // Jika format lebih kompleks, seperti '1 Juni 2023', perlu diubah sesuai formatnya.
            $data[] = [
                'date' => $row['date'], // Tanggal dalam format varchar
                'value' => $row['value']
            ];
        }
    }

    $conn->close();
    return $data;
}

$data_ck = getData('tb_riwayat_ck');
$data_cs = getData('tb_riwayat_cs');
$data_cd = getData('tb_riwayat_cd');

echo json_encode(['tgl_klr' => $data_ck, 'tgl_klr' => $data_cs, 'tgl_klr' => $data_cd]);
?>