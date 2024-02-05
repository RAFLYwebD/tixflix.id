<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("img/tixflix3.png");
            background-size: cover;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            margin-top: 35px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            overflow: hidden;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .card-content {
            padding: 20px;
            text-align: center;
        }

        .card h3 {
            margin-bottom: 8px;
            color: #333;
        }

        .card p {
            color: #555;
        }

        .details-link {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
            background-color: #ffc107;
            color: #fff;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .details-link:hover {
            background-color: #ffca50;
            color: #fff;
        }

        .logo {
            width: 180px;
            height: 100px;
        }


        a.btn{
            background-color: #ffc107;
            text-decoration: none;
            color: #fff;
            }

        a.btn:hover{
            background-color: #ffca50;
            text-decoration: none;
            color: #fff;
        }

        a.btn-lo{
            padding: 10.5px;
            border-radius: 5px;
            background-color: #ffc107;
            text-decoration: none;
            color: #fff;
        }

        a.btn-lo:hover{
            background-color: #ffca50;
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-light bg-body-tertiary">
        <div class="container-fluid" style="display: flex; justify-content: space-between; align-items: center;">
            <a class="navbar-brand" href="#">
                <img src="img/tixflix2 admin.png" height="60" alt="Logo TixFlix" loading="lazy" />
            </a>
            <div>
                <!-- <a class="btn" href="profile.php">Profile</a> -->
                <a class="btn" href="insert_movie.html">Insert Movie</a>
                <a class="btn-lo" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

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
            echo "<a class='details-link' href='detail_admin.php?movie={$row['Name']}'>Edit File</a>";
            echo "</div>";
            echo "</div>";
        }

        $conn->close();
        ?>
    </div>

</body>

</html>


