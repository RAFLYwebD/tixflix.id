<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $movie_id = $_POST['Movie_ID'];
    $name = $_POST['Name'];
    $image_path = $_POST['Image_Path'];
    $language = $_POST['Language'];
    $genre = $_POST['Genre'];
    $target_audience = $_POST['Target_Audience'];
    $film_description = $_POST['Film_Description'];

    // Validate input
    if (empty($movie_id) || empty($name) || empty($image_path) || empty($language) || empty($genre) || empty($target_audience) || empty($film_description)) {
        echo "All fields are required.";
    } else {
        // Check if the movie already exists
        $check_query = "SELECT * FROM movie WHERE Movie_ID = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("i", $movie_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "Movie with the same Movie ID already exists.";
        } else {
            // SQL query to insert data into the 'movie' table
            $insert_query = "INSERT INTO movie (Movie_ID, Name, Image_Path, Language, Genre, Target_Audience, Film_Description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("issssss", $movie_id, $name, $image_path, $language, $genre, $target_audience, $film_description);

            // Execute the insert query
            if ($stmt->execute()) {
                echo "Film successfully added to the database.";
            } else {
                echo "Error inserting film: " . $stmt->error;
            }

            $stmt->close();
        }

        $check_stmt->close();
    }
}

$conn->close();
?>
