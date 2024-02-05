<!-- edit_movie.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie - <?php echo isset($row['Name']) ? $row['Name'] : 'Unknown Movie'; ?></title>
    <!-- Tambahan stylesheet atau CDN yang diperlukan -->
    <style>
             body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #343a40;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #343a40;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a.btn-dlt{
            padding: 5px;
            /* width: 50%; */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            text-decoration: none;
            background-color: red;
            color: #fff;
            cursor: pointer;
        }

        a.btn-dlt:hover{
          background-color: maroon;
        }

        a.btn{
          background-color: #ffc107;
          padding: 10.5px;
          border-radius: 5px;
          text-decoration: none;
          color: #fff;
        }
        a.btn:hover{
          background-color: #ffca50;
        }
        a.btn-lo{
          background-color: red;
          padding: 10.5px;
          border-radius: 5px;
          text-decoration: none;
          color: #fff;
        }
        a.btn-lo:hover{
          background-color: maroon;
        }
        a.btn-hmp{
          background-color: green;
          padding: 10.5px;
          border-radius: 5px;
          text-decoration: none;
          color: #fff;
        }
        a.btn-lo-hmp:hover{
          background-color: forestgreen;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-body-tertiary">
        <div class="container-fluid" style="display: flex; padding: 15px;  justify-content: space-between; align-items: center;">
            <a class="navbar-brand" href="#">
                <img src="img/tixflix2 admin.png" height="60" alt="Logo TixFlix" loading="lazy" />
            </a>
            <div>
                <a class="btn" href="profile.php">Profile</a>
                <a class="btn-lo" href="logout.php">Logout</a>
                <a class="btn-hmp" href="form_admin.php">Homepage</a>
            </div>
        </div>
    </nav>

    <?php
    include 'db.php';

    $movie_id = isset($_GET['movie']) ? $_GET['movie'] : null;

    if (!$movie_id) {
        header('Location: form_admin.php');
        exit();
    }

    // Query untuk mendapatkan informasi film
    $movie_query = "SELECT * FROM movie WHERE Name = ?";
    $stmt = $conn->prepare($movie_query);
    $stmt->bind_param("s", $movie_id);
    $stmt->execute();
    $movie_result = $stmt->get_result();

    if ($movie_result->num_rows > 0) {
        $row = $movie_result->fetch_assoc();
        ?>
        <h2>Edit Movie - <?php echo $row['Name']; ?></h2>
        <form action="update_movie.php?movie=<?php echo $row['Name']; ?>" method="POST">
            <label for="Name">Name:</label>
            <input type="text" name="Name" value="<?php echo $row['Name']; ?>" required>

            <label for="Language">Language:</label>
            <input type="text" name="Language" value="<?php echo $row['Language']; ?>" required>

            <label for="Genre">Genre:</label>
            <input type="text" name="Genre" value="<?php echo $row['Genre']; ?>" required>

            <label for="Target_Audience">Target Audience:</label>
            <input type="text" name="Target_Audience" value="<?php echo $row['Target_Audience']; ?>" required>

            <label for="Film_Description">Description:</label>
            <textarea name="Film_Description" required><?php echo $row['Film_Description']; ?></textarea>

            <label for="Image_Path">Image Path:</label>
            <input type="text" name="Image_Path" value="<?php echo $row['Image_Path']; ?>" required>

            <input type="submit" value="Update Movie">
            <div>
                <a class="btn-dlt" href="delete_movie.php?movie=<?php echo $row['Name']; ?>">Delete Movie</a>
            </div>
        </form>
        <?php
    } else {
        echo "Movie not found.";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
