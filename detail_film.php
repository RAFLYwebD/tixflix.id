<?php
include 'db.php';

$movie_id = isset($_GET['movie']) ? $_GET['movie'] : null;

if (!$movie_id) {
    header('Location: form_daftar_film.php');
    exit();
}

$movie_query = "SELECT * FROM movie WHERE Name = ?";
$stmt = $conn->prepare($movie_query);
$stmt->bind_param("s", $movie_id);
$stmt->execute();
$movie_result = $stmt->get_result();

if ($movie_result->num_rows > 0) {
    $row = $movie_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['Name']; ?></title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(img/tixflix3.png);
            background-size: cover;
            margin: 0;
            /* padding: 20px; */
            box-sizing: border-box;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            text-align: left;
            margin: 0 auto;
            margin-top: 125px;
        }

        .container img {
            width: 40%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
            float: left;
            margin-right: 20px;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
        }

        p {
            color: #555;
            margin-bottom: 15px;
            line-height: 0.5;
        }

        a.pesantik{
            border: #ffc107;
            text-decoration: none;
            background-color: #ffc107;
            padding: 10px;
            border-radius: 15px;
            color: white;
        }

        a.pesantik:hover{
            background-color: #ffca2c;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            clear: both; /* Clear the float */
        }

        p.desc{
            line-height: 1;
        }

        a.back{
            display: flex;
            justify-content: center;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #ffc107;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ffca2c;
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
                <img src="img/tixflix2.png" height="60" alt="Logo TixFlix" loading="lazy" />
            </a>
            <div>
                <a class="btn" href="profile.php">Profile</a>
                <a class="btn-lo" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2><b><?php echo $row['Name']; ?></b></h2>
        

        <?php if (isset($row['Image_Path'])) : ?>
            <img src='./img/<?php echo $row['Image_Path']; ?>' alt='<?php echo $row['Name']; ?>'>
        <?php else : ?>
            <p>Gambar tidak tersedia.</p>
        <?php endif; ?>

        <h3><b>Pemesanan Tiket</b></h3>
        <p><strong>Language:</strong> <?php echo $row['Language']; ?></p>
        <p><strong>Genre:</strong> <?php echo $row['Genre']; ?></p>
        <p><strong>Target Audience:</strong> <?php echo $row['Target_Audience']; ?></p>
        <p><strong>Description:</strong></p>
        <p class="desc"><?php echo $row['Film_Description']; ?></p>
        <br>
    <div>
        <a class="pesantik" href="pengisian_data.php">Booking Now</a>
    </div>
    <br><br>
    <div>
        <a class="back" href="form_daftar_film.php">Previous</a>
    </div>
</form>
    </div>
</body>
</html>




<?php
} else {
    header('Location: form_daftar_film.php');
    exit();
}

$stmt->close();
$conn->close();
?>
