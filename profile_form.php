<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Hubungkan ke basis data
include 'db.php';

// Ambil informasi pengguna dari basis data
$userID = $_SESSION['user_id'];
$query = "SELECT * FROM web_user2 WHERE User_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Proses pembaruan profil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];

    // Validasi input jika diperlukan

    // Perbarui informasi pengguna di basis data
    $updateQuery = "UPDATE users SET First_Name = ?, Last_Name = ?, Email_ID = ?, Phone_Number = ? WHERE User_ID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('ssssi', $firstName, $lastName, $email, $phoneNumber, $userID);

    if ($updateStmt->execute()) {
        // Pembaruan berhasil
        header('Location: profile_form.php');
        exit();
    } else {
        // Pembaruan gagal
        $updateError = "Terjadi kesalahan saat memperbarui profil.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Profile</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $user['First_Name']; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $user['Last_Name']; ?>" required>

        <label for="email">Email ID:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['Email_ID']; ?>" required>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" value="<?php echo $user['Phone_Number']; ?>" required>

        <button type="submit">Update Profile</button>
    </form>

    <?php
    if (isset($updateError)) {
        echo '<p class="error-message">' . $updateError . '</p>';
    }
    ?>

    <p><a href="profile.php">Back to Profile</a></p>
</div>

</body>
</html>
