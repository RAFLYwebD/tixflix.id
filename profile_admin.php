<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$loggedInUser = $user['Email_ID'];
$query = "SELECT First_Name, Last_Name, Email_ID FROM filmuploader WHERE Email_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $loggedInUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Menampilkan data profil pengguna
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-image: url(img/tixflix3.png);
                background-size: cover;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            h2{
                margin-top: -15px;
            }

            .profile-container {
                text-align: center;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                width: 300px;
                color: #333;
                
            }

            .profile-label {
                padding-bottom: -5px;
                text-align: left;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .profile-value {
                text-align: left;
                margin-bottom: 15px;
            }

            a.bck-btn, a.btn-lo{
                text-decoration: none;
            }

            a.bck-btn{
                background-color: green;
                border-radius: 5px;
                padding: 5px;
                color: #fff;
            }

            a.btn-lo{
                background-color: red;
                border-radius: 5px;
                padding: 5px;
                color: #fff;
            }

            a.btn-py{
                text-decoration: none;
                color: #fff;
                padding: 5px;
                padding-bottom: 5px;
                background-color: gold;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>

        <div class="profile-container">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <h2>Halo <?php echo $row["First_Name"]; ?>!</h2>
                <div class="profile-label">Name:</div>
                <div class="profile-value"><?php echo $row["First_Name"]; ?> <?php echo $row["Last_Name"]; ?></div>

                <div class="profile-label">Email ID:</div>
                <div class="profile-value"><?php echo $row["Email_ID"]; ?></div>

                
                <?php
            }
            ?>
            <br><br>
            <div>
                <a href="history.php" class="btn-py">Look your Payment History</a>
            </div>
            <br>
            <div>
                <a href="form_daftar_film.php" class="bck-btn">Homepage</a>
                <a href="logout.php" class="btn-lo">Logout</a>
            </div>
        </div>

        
    </body>
    </html>
    <?php

    // Membebaskan hasil query
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
