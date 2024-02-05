<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_identifier = $_POST['login_identifier'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $query = "SELECT * FROM web_user2 WHERE Email_ID = ? OR Phone_Number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $login_identifier, $login_identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user; // Simpan seluruh data pengguna di sesi
            header('Location: form_daftar_film.php');
            exit;
        } else {
            $error_message = "Login failed. Password salah.";
        }
    } else {
        $error_message = "Login failed. Pengguna tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content (meta, title, stylesheets) -->
</head>
<body>
    <div class="message-container">
        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        ?>
    </div>
</body>
</html>
