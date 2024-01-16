<?php
include 'db.php';

// Ambil parameter movie_id dari URL
$movie_id = isset($_GET['movie]']) ? $_GET['movie'] : null;

if (!$movie_id) {
    // Redirect ke halaman daftar film jika tidak ada movie_id
    header('Location: form_daftar_film.php');
    exit();
}

// Gunakan prepared statement untuk mencegah SQL injection
$movie_query = "SELECT * FROM movie WHERE movie = ?";
$stmt = $conn->prepare($movie_query);
$stmt->bind_param("i", $movie_id);
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
    <title>Detail Film - <?php echo $row['Name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .container img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Detail Film - <?php echo $row['Name']; ?></h2>

    <div class="container">
        <?php
        // Periksa apakah indeks "image_path" ada sebelum mengaksesnya
        if (isset($row['image_path'])) {
        ?>
            <img src='./img/<?php echo $row['image_path']; ?>' alt='<?php echo $row['Name']; ?>'>
        <?php
        } else {
            echo "Gambar tidak tersedia.";
        }
        ?>
        <p>Language: <?php echo $row['Language']; ?></p>
        <p>Genre: <?php echo $row['Genre']; ?></p>
        <p>Target Audience: <?php echo $row['Target_Audience']; ?></p>
        <p>Deskripsi: <?php echo $row['description']; ?></p>

        <h3>Pemesanan Tiket</h3>
        <form action="process_pemesanan_tiket.php" method="post" class="booking-form">
            <input type="hidden" name="movie_id" value="<?php echo $row['movie']; ?>">
            <label for="seat_count">Jumlah Kursi:</label>
            <input type="number" id="seat_count" name="seat_count" required>
            <input type="submit" value="Pesan Tiket">
        </form>
    </div>
</body>
</html>

<?php
} else {
    // Redirect ke halaman daftar film jika movie_id tidak valid
    header('Location: form_daftar_film.php');
    exit();
}

$stmt->close();
$conn->close();
?>
