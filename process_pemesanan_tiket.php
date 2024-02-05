<?php
include 'db.php';

session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedInUser = $user['user_id'];
} else {
    header('Location: login.php');
    exit();
}
function generateBookingID($prefix = 'BK', $length = 8) {
    $uniqueNumber = generateUniqueNumber($length - strlen($prefix));
    $bookingID = $prefix . $uniqueNumber;
    return $bookingID;
}

function generateUniqueNumber($length) {
    $min = pow(10, ($length - 1));
    $max = pow(10, $length) - 1;
    return rand($min, $max);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noOfTickets = $_POST['No_of_Tickets'];
    $cardNumber = $_POST['Card_Number'];
    $firstName = $user['First_Name'];
    $lastName = $user['Last_Name'];
    $nameOnCard = $firstName . ' ' . $lastName;
    
    $selectedTheatre = $_POST['Name_of_Theatre'];
    $selectedArea = $_POST['Area'];


    if (!is_numeric($noOfTickets) || $noOfTickets <= 0) {
        echo "Jumlah tiket tidak valid.";
        exit();
    }

    try {
        $bookingID = generateBookingID();

        $getPriceQuery = "SELECT price FROM theatre WHERE Name_of_Theatre = ? LIMIT 1";
        $priceStmt = $conn->prepare($getPriceQuery);
        $priceStmt->bind_param("s", $selectedTheatre);
        $priceStmt->execute();
        $priceStmt->bind_result($price);

        if ($priceStmt->fetch()) {
            $priceStmt->close();

            $insertQuery = "INSERT INTO pemesanan_tiket_online (user_id, No_of_Tickets, Card_Number, Name_on_Card, Name_of_Theatre, Area, Booking_ID, Total_Price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $totalPrice = $noOfTickets * $price;

            if ($stmt->execute([$loggedInUser, $noOfTickets, $cardNumber, $nameOnCard, $selectedTheatre, $selectedArea, $bookingID, $totalPrice])) {
                $stmt->close();
            
                $lastBookingID = $conn->insert_id;
            
                $updateUserQuery = "UPDATE pemesanan_tiket_online SET user_id = ?, Name_on_Card = ? WHERE Booking_ID = ?";
                $updateStmt = $conn->prepare($updateUserQuery);
            
                $nameOnCardDefault = $loggedInUser . '_' . $user['First_Name'];
                $updateStmt->bind_param("sss", $loggedInUser, $nameOnCardDefault, $lastBookingID);
            
                if ($updateStmt->execute()) {
                    $updateStmt->close();
            
                    include 'invoice_pay.php';
                    exit();
                } else {
                    throw new Exception("Error updating user_id and Name_on_Card in pemesanan_tiket_online: " . $updateStmt->error);
                }
            } else {
                throw new Exception("Error inserting pemesanan data: " . $stmt->error);
            }
        } else {
            echo "Harga tiket tidak ditemukan.";
            exit();
        }
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
} else {
    header('Location: form_pemesanan_tiket.php');
    exit();
}
?>
