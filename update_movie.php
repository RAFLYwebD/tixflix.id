<!-- update_movie.php -->
<?php
include 'db.php';

$movie_id = isset($_GET['movie']) ? $_GET['movie'] : null;

if (!$movie_id) {
    header('Location: form_admin.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $name = $_POST['Name'];
    // Retrieve other values as needed

    // SQL query to update data in the 'movie' table
    $update_query = "UPDATE movie SET Name=? WHERE Name=?";
    $stmt = $conn->prepare($update_query);

    if (!$stmt) {
        die("Error preparing update query: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $movie_id);

    // Execute the update query
    if ($stmt->execute()) {
        header("Location: detail_admin.php?movie=$name");
        exit();
    } else {
        echo "Error updating movie: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
