<?php 
// Include header
require_once('_header.php'); 

// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'laundry_app';

// Koneksi ke Database
$koneksi = new mysqli($host, $user, $pass, $db);

$id_user = $_SESSION['id_user'] ?? $_GET['id_user'] ?? 1;

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil id_user dari sesi atau parameter
$id_user = $_SESSION['id_user'] ?? $_GET['id_user'] ?? 1; // Sesuaikan dengan logika aplikasi Anda

$query = "SELECT nama, username, email FROM master WHERE id_user = ?";

$data = [];

if ($stmt = $koneksi->prepare($query)) {
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data user tidak ditemukan.";
        exit;
    }

    $stmt->close();
} else {
    echo "Kesalahan pada query: " . $koneksi->error;
    exit;
}

// Tutup koneksi
$koneksi->close();
?>

<div id="tambah_karyawan" class="main-content">
    <div class="container">
        <div class="baris">
            <div class="col mt-2">
                <div class="card">
                    <div class="card-title card-flex">
                        <div class="card-col txt-center">
                            <h2>Profile</h2>    
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="" method="post" class="form-input">
                            <div class="form-grup">
                                <label for="nama">Nama User</label>
                                <input type="text" name="nama" placeholder="Nama lengkap" autocomplete="off" id="nama" value="<?= htmlspecialchars($data['nama']) ?>" readonly>
                            </div>

                            <div class="form-grup">
                                <label for="username">Username</label>
                                <input type="text" name="username" placeholder="Username" autocomplete="off" id="username" value="<?= htmlspecialchars($data['username']) ?>" readonly>
                            </div>

                            <div class="form-grup">
                                <label for="email">Email</label>
                                <input type="text" name="email" placeholder="Email" autocomplete="off" id="email" value="<?= htmlspecialchars($data['email']) ?>" readonly>
                            </div>

                            <div class="form-grup ">
                                <a href="<?= 'updateprofile.php?id_user=' . urlencode($id_user) ?>" class="bg-primary txt-center"><button type="button">Edit Profile</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 