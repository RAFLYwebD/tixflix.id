<?php
include 'db.php';

session_start();

if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) {
    $user = $_SESSION['user'];
    $loggedInUser = $user['user_id'];
} else {
    header('Location: login.php');
    exit();
}

try {
    // Ambil semua data pemesanan berdasarkan user_id
    $queryDetail = "SELECT * FROM pemesanan_tiket_online WHERE user_id = ?";
    $stmtDetail = $conn->prepare($queryDetail);
    $stmtDetail->bind_param("i", $loggedInUser);
    $stmtDetail->execute();
    $resultDetail = $stmtDetail->get_result();

    if ($resultDetail->num_rows > 0) {
        while ($rowDetail = $resultDetail->fetch_assoc()) {
            // Tetapkan nilai ke variabel sesuai dengan kolom yang sesuai
            $bookingID = $rowDetail['Booking_ID'];
            $noOfTickets = $rowDetail['No_of_Tickets'];
            $cardNumber = $rowDetail['Card_Number'];
            $nameOnCard = $rowDetail['Name_on_Card'];
            $selectedTheatre = $rowDetail['Name_of_Theatre'];
            $selectedArea = $rowDetail['Area'];
            $price = $rowDetail['Total_Price'];
            $totalPrice = $rowDetail['Total_Price'];

            include 'invoice.php';
            echo '<br>';
            echo '<hr>';
        }
        exit();
    } else {
        echo "Belum ada data pemesanan.";
        exit();
    }
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
