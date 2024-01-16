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
        // User ditemukan, verifikasi password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password valid, login berhasil
            $_SESSION['user'] = $user;
            header('Location: form_daftar_film.php');
            exit;
        } else {
            // Password tidak valid
            $error_message = "Login failed. Incorrect password.";
        }
    } else {
        // User tidak ditemukan
        $error_message = "Login failed. User not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .message-container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            width: 300px;
            color: #333;
        }

        .error-message {
            color: red;
        }
    </style>
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
