<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Pemesanan Tiket</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
      body {
        background-image: url(img/tixflix3.png);
        background-size: cover;
        font-family: 'Poppins', sans-serif;
        margin-top: 220px;
        margin-bottom: 220px;
      }

      .invoice {
        background-color: white;
        max-width: 600px;
        margin: auto;
        border: 1px solid #ddd;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .invoice-image {
        max-width: 50%;
        height: auto;
        display: block;
        margin: auto;
      }

      h2 {
        margin-top: 10px;
        margin-bottom: -8px;
        text-align: center;
      }

      .invoice-details {
        margin-top: 20px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th,
      td {
        background-color: white;
        border: 1px solid black;
        padding: 10px;
        text-align: center;
      }

      th {
        background-color: gray;
      }

      .total {
        margin-top: 20px;
        text-align: right;
      }

      .thank-you {
        margin-top: 20px;
        text-align: center;
      }

      a.py_btn{
        color: #fff;
        padding: 5px;
        width: 150px;
        display: flex;
        align-items: center;
        background-color: #ffc107;
        border-radius: 5px;
        text-decoration: none;
      }

    </style>
  </head>
  <body>




    <div class="invoice">
      <h2>Booking Ticket Invoice</h2>
      <img src="img/tixflix2.png" alt="" class="invoice-image" />

      <br />

      <div class="invoice-details">
        <p>
          <strong>Booking ID:</strong>
          <?php echo $bookingID; ?>
        </p>
        <p>
          <strong>No of Tickets:</strong>
          <?php echo $noOfTickets; ?>
        </p>
        <p>
          <strong>Card Number:</strong>
          <?php echo $cardNumber; ?>
        </p>
        <p>
          <strong>Name on Card:</strong>
          <?php echo $nameOnCard; ?>
        </p>
        <p>
          <strong>Theater Name:</strong>
          <?php echo $selectedTheatre; ?>
        </p>
        <p>
          <strong>Area:</strong>
          <?php echo $selectedArea; ?>
        </p>
        <p>
          <strong>Date:</strong>
          <?php echo date('Y-m-d H:i:s'); ?>
        </p>
      </div>

      <table>
        <thead>
          <tr>
            <!-- <th>Film</th> -->
            <th>Jumlah Tiket</th>
            <th>Harga Tiket</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $noOfTickets; ?></td>
            <td>
              Rp.
              <?php echo number_format($price, 2); ?>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="total">
        <p>
          <strong>Total Pembayaran:</strong> Rp.
          <?php echo number_format($totalPrice, 2); ?>
        </p>
      </div>

      <div class="thank-you">
        <p>Thank You for Your Payment!</p>
      </div>
    </div>
    <div>
        <a class="py_btn" href="profile.php">Check Your Payment</a>
    </div>
  </body>
</html>