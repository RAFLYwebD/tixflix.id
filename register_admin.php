<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_id = $_POST['email_id'];
    $phone_number = $_POST['phone_number'];

    // Tambahkan ini untuk memproses password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check_query = "SELECT * FROM filmuploader WHERE Email_ID = '$email_id'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $error_message = "Email already registered. Please use a different email address.";
    } else {
        // Insert data if email is unique
        $insert_query = "INSERT INTO filmuploader (First_Name, Last_Name, Email_ID, Phone_Number, password) VALUES ('$first_name', '$last_name', '$email_id', '$phone_number', '$password')";

        if ($conn->query($insert_query) === TRUE) {
            // Registrasi sukses, arahkan kembali ke index.php
            header("Location: index.php");
            exit(); // Pastikan untuk keluar setelah menggunakan header()
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
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

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        } elseif (isset($success_message)) {
            echo "<div class='success-message'>$success_message</div>";
        }
        ?>
    </div>
</body>
</html>
