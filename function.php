<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'laundry_app';

// Koneksi ke Database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Fungsi untuk menampilkan semua query dari database
if (!function_exists('query')) {
    function query($query){
        global $koneksi;
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}



?>
