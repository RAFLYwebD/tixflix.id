<?php
session_start();
include 'db.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Ambil data pengguna berdasarkan user_id
$query = "SELECT First_Name, Last_Name, Email_ID FROM web_user2 WHERE user_id = ?";
$stmt = $conn->prepare($query);

// Periksa apakah query berhasil disiapkan
if (!$stmt) {
    die("Error preparing query: " . $conn->error);
}

$stmt->bind_param("i", $userID);
$stmt->execute();

// Periksa apakah eksekusi query berhasil
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Data pengguna ditemukan
    while ($row = $result->fetch_assoc()) {
        $firstName = $row["First_Name"];
        $lastName = $row["Last_Name"];
        $emailID = $row["Email_ID"];
    }
} else {
    // Data pengguna tidak ditemukan
    echo "Error: Data user not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content (meta, title, stylesheets) -->
</head>
<body>

    <div class="profile-container">
        <h2>Halo <?php echo $firstName; ?>!</h2>
        <div class="profile-label">Name:</div>
        <div class="profile-value"><?php echo $firstName; ?> <?php echo $lastName; ?></div>

        <div class="profile-label">Email ID:</div>
        <div class="profile-value"><?php echo $emailID; ?></div>

        <br><br>
        <div>
            <a href="history.php" class="btn-py">Lihat Riwayat Pembayaran Anda</a>
        </div>
        <br>
        <div>
            <a href="form_daftar_film.php" class="bck-btn">Beranda</a>
            <a href="logout.php" class="btn-lo">Logout</a>
        </div>
    </div>

</body>
</html>
