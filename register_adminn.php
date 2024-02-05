<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background-image: url("img/tixflix3.png");
        background-size: cover;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      h2,
      h4 {
        text-align: center;
        margin-bottom: 20px;
        color: black;
      }

      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        text-decoration: none;
        color: #333;
        margin-bottom: 20px;
      }

      form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 15px;
        font-size: 14px;
      }

      form input[type="submit"] {
        background-color: #fce30d;
        border-radius: 15px;
        color: #fff;
        cursor: pointer;
      }

      form input[type="submit"]:hover {
        background-color: #ffc250;
      }
    </style>
</head>
<body>
<br />
        <div>
          <h2>REGISTER ADMIN</h2>
          <form method="POST" action="register_admin.php">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>
        
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required>
        
            <label for="email_id">Email:</label>
            <input type="email" name="email_id" id="email_id" required>
        
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" required>
      
            <!-- Other form fields -->
        
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Register" />
        
            <div>
              <a href="index.php">Login</a>
            </div>
        </form>
</body>
</html>