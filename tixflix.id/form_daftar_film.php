<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            overflow: hidden;
            width: 300px;
        }

       
        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
            text-align: center;
        }

        .card h3 {
            margin-bottom: 8px;
        }

        .card p {
            color: #555;
        }

        .details-link {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
            background-color: yellow;
            color: black;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/tixflix.png" alt="Logo" width="180" height="100" class="d-inline-block align-text-top">
    </a>
  </div>
</nav>

    <!-- <h2>Show Now</h2> -->



    <div class="container">
        <?php
            include 'db.php';

            $movie_query = "SELECT * FROM movie";
            $movie_result = $conn->query($movie_query);

            while ($row = $movie_result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<img src='./img/{$row['Image_Path']}' alt='{$row['Name']}'>";
                echo "<div class='card-content'>";
                echo "<h3>{$row['Name']}</h3>";
                echo "<p>Genre: {$row['Genre']}</p>";
                echo "<a class='details-link' href='detail_film.php'?movie={$row['Name']}'>Details & Booking</a>";
                echo "</div>";
                echo "</div>";
            }

            $conn->close();
        ?>
    </div>
<br><br>
    <div class="text-center mt-4">
    <a class="btn btn-danger" href="logout.php">Logout</a>
</div>
</body>
</html>
