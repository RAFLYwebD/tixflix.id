<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h2, h4 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form, a {
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

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }

        a:hover {
            background-color: #1d6fa5;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="login_identifier">Email ID or Phone Number:</label>
        <input type="text" id="login_identifier" name="login_identifier" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>

    <h4>Belum Punya Akun?</h4>
    <a href="register.html">Klik Untuk Registrasi</a>
</body>
</html>
