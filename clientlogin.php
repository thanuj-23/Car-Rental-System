<?php
include('login_client.php'); // Includes Login Script

if (isset($_SESSION['login_client'])) {
    header("location: index.php"); // Redirecting
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login | Car Rental</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <style>
        /* Global Styles */
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .jumbotron {
            background-color: transparent;
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }

        .info {
            font-size: 12px;
            text-align: center;
            margin-top: 15px;
        }
        
        /* Navigation Styles */
        nav {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
        }
        
        nav a {
            color: green;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <nav style="background-color: #f8f9fa; padding: 10px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">
        <div style="text-align: right;">
            <?php
            if (isset($_SESSION['login_client'])) {
            ?>
                <a href="index.php">Home</a>
                <span>Welcome <?php echo $_SESSION['login_client']; ?></span>
                <a href="logout.php">Logout</a>
            <?php
            } else {
            ?>
                <a href="index.php">Home</a>
                <a href="clientlogin.php">Client</a>
            <?php
            }
            ?>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1>QuickWay Car Rental System - Client Panel</h1>
            <p>Please LOGIN to continue.</p>
        </div>

        <div class="error-message">
            <span><?php echo isset($error) ? $error : ''; ?></span>
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label for="client_username"><span class="text-danger">*</span> Username:</label>
                <input class="form-control" id="client_username" type="text" name="client_username" placeholder="Username" required autofocus>
            </div>

            <div class="form-group">
                <label for="client_password"><span class="text-danger">*</span> Password:</label>
                <input class="form-control" id="client_password" type="password" name="client_password" placeholder="Password" required>
            </div>

            <button class="btn" name="submit" type="submit" value="Login">Submit</button>

            <div class="info">
                <h5><b>Only Registered Clients can add cars.</b></h5>
                <p>If you want to register as a client in QuickWay Car Rental System, please contact us.</p>
            </div>
        </form>
    </div>

</body>

</html>
