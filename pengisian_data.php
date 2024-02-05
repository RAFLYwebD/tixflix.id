    <?php
    include 'db.php';

session_start(); // Mulai sesi

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('Location: login.php');
    exit();
}

$movie_query = "SELECT * FROM movie WHERE Name = ?";
$stmt = $conn->prepare($movie_query);
$stmt->bind_param("s", $movie_id);
$stmt->execute();
$movie_result = $stmt->get_result();

if ($movie_result->num_rows > 0) {
    $row = $movie_result->fetch_assoc();

}
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Form Pemesanan Tiket</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"/>
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins' sans-serif;
                background-image: url(img/tixflix3.png);
                background-size: cover;
                font-family: Arial, sans-serif;
            }

            h2 {
                margin-top: 200px;
                display: flex;
                justify-content: center;
            }

            form {
                line-height: 1;
                max-width: 400px;
                margin: auto;
            }

            label {
                font-family: Arial, Helvetica, sans-serif;
                display: block;
                margin-bottom: 8px;
            }

            input, select {
                border-radius: 15px;
                width: 100%;
                padding: 10px;
                margin-bottom: 16px;
                box-sizing: border-box;
            }

            button {
                background-color: #ffc107;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
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

        <h2><b>Booking Tickets</b></h2>
        <br>
        <form action="process_pemesanan_tiket.php" method="post">


            <label for="First_Name">Name</label>
            <input type="text" id="First_Name" name="First_Name" value="<?php echo $user['First_Name']; ?> <?php echo $user['Last_Name']; ?>">
        
            <label for="No_of_Tickets">No. Tickets:</label>
            <input type="number" id="No_of_Tickets" name="No_of_Tickets" required />

            <label for="Card_Number">Card Number:</label>
            <input type="text" id="Card_Number" name="Card_Number" required />

            <label for="Name_of_Theatre">Name of Theater:</label>
            <select id="Name_of_Theatre" name="Name_of_Theatre" required>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "final_db");
                if ($conn) {
                    $query = "SELECT DISTINCT Name_of_Theatre, Area FROM theatre";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['Name_of_Theatre'] . "' data-area='" . $row['Area'] . "'>" . $row['Name_of_Theatre'] . "</option>";
                    }

                    mysqli_close($conn);
                }
                ?>
            </select>

            <label for="Area">Area:</label>
            <input type="text" id="Area" name="Area" value="" readonly>



            

            <button type="submit">Booking</button>
            <br><br>
            <div>
                <a href="detail_film.php">Previous</a>
            </div>
        </form>

        <script>
            var theatreSelect = document.getElementById("Name_of_Theatre");
            var areaInput = document.getElementById("Area");

            theatreSelect.addEventListener("change", function() {
                var selectedOption = this.options[this.selectedIndex];
                areaInput.value = selectedOption.getAttribute('data-area');
            });
        </script>
    </body>
    </html>
