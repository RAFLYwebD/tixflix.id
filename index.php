<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('img/tixflix3.png');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        nav {
            background-color: transparent;
            border: none;
        }

        h2, h4 {
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
            width: 50%;
            background-color: #fce30d;
            border-radius: 15px;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #ffc250;
        }

        a {
            color: blue;
            text-decoration: underline;
        }

        nav {
            background-color: transparent;
            border: none;
        }

        .flex{
            display: flex;
            gap: 5px;
        }

        a.admin{
            border: grey;
            height: 27px;
            width: 50%;
            text-decoration: none;
            color: #fff;
            padding: 5px;
            padding-top: 7px;
            padding-bottom: 5px;
            background-color: green;
            border-radius: 15px;
        }

        a.admin:hover{
            background-color: forestgreen;
        }
        

    </style>
</head>
<body>

<div>
    <img src="img/tixflix2.png" alt="Tixflix" width="500" height="auto">
</div>

<br>
<br>
<br>

<h2>LOGIN</h2>
<form action="login.php" method="post">
    <label for="login_identifier">Email ID or Phone Number:</label>
    <input type="text" id="login_identifier" name="login_identifier" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <div class="flex">
        <input type="submit" value="Login">
        <a href="admin.php" class="admin">Admin</a>
    </div>
    
</form>

<h4>Belum Punya Akun?</h4>
<a class="regis" href="register.html">Klik Untuk Registrasi</a>
</body>
</html>
