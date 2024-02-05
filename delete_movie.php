<?php
include 'db.php';

$movie_id = isset($_GET['movie']) ? $_GET['movie'] : null;

if (!$movie_id) {
    header('Location: form_admin.php');
    exit();
}

// SQL query to delete data from the 'movie' table
$delete_query = "DELETE FROM movie WHERE Name=?";
$stmt = $conn->prepare($delete_query);

if (!$stmt) {
    die("Error preparing delete query: " . $conn->error);
}

$stmt->bind_param("s", $movie_id);

// Execute the delete query
if ($stmt->execute()) {
    $success_message = "Film '$movie_id' successfully deleted.";
} else {
    $error_message = "Error deleting film: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Film</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .message-container {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px; /* Menambahkan jarak ke bawah */
        }

        .success {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }

        a.hmpg {
            padding: 10px; /* Mengganti padding menjadi 10px */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            text-decoration: none;
            background-color: red;
            color: #fff;
            cursor: pointer;
            margin-top: 10px; /* Menambahkan jarak ke atas */
        }

        a.hmpg:hover {
            background-color: maroon;
        }
    </style>
</head>
<body>
    <div class="message-container <?php echo isset($success_message) ? 'success' : 'error'; ?>">
        <?php echo isset($success_message) ? $success_message : $error_message; ?>
        <div><a class="hmpg" href="form_admin.php">Back to Homepage</a></div>
    </div>
</body>
</html>

