<!DOCTYPE html>
<html>
<?php 
session_start();
include('session_customer.php');
include('connection.php'); 

if(!isset($_SESSION['login_customer'])){
    header("location: customerlogin.php");
}


if (!isset($_GET['id'])) {
    echo "

    <script>
        alert('Please select a car to book first.'); window.location.href='cars.php';
    </script>";

    exit();
}

?> 
<title>Book Car</title>
<head>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <style>
        header {
            background-color: white;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width:99%;
        }

        .logo img {
            width: 120px;
        }

        #mainmenu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
            background-color: #fff;
        }

        #mainmenu li {
            padding: 15px;
        }

        #mainmenu .menu-item {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .auth-buttons a {
            text-decoration: none;
            margin: 0 10px;
            padding: 8px 16px;
            background-color: green;
            color: white;
            border-radius: 4px;
        }

        .banner {
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        .container {
            margin-top: 90px;
        }

        .form-area {
            background-color: white;
            padding: 20px;
            border: 2px solid green;
            border-radius: 8px;
            width: 40%; 
            margin: 0 auto;
        }

        h5 {
            color: #333;
            margin-bottom: 10px;
        }

        label {
            color: #333;
        }

        input[type="date"],
        input[type="submit"] {
            width: 30%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .form-area h5 {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .form-area .btn-warning {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

    </style>

    <script>
        function updateFare() {
            var acPrice = "Rs. 23/km and Rs. 45/day";
            var nonAcPrice = "Rs. 23/km and Rs. 21/day"; 
            var fareDisplay = document.getElementById('fare-display');
            var acRadio = document.getElementById('ac-radio');
            var nonAcRadio = document.getElementById('non-ac-radio');
            
            if (acRadio.checked) {
                fareDisplay.innerHTML = acPrice;
            } else if (nonAcRadio.checked) {
                fareDisplay.innerHTML = nonAcPrice;
            } else {
                fareDisplay.innerHTML = "Select a car type"; 
            }
        }
    </script>
    
</head>
<body ng-app="">
<header>
    <a href="index.php" class="logo">
        <img src="images/logo.png" alt="Logo">
    </a>
    <ul id="mainmenu">
        <li><a href="index.php" class="menu-item">Home</a></li>
        <li><a href="cars.php" class="menu-item">Cars</a></li>
        <li><a href="booking.php" class="menu-item">Booking</a></li>
        <li class="dropdown">
            <a href="#" class="menu-item">My Account</a>
            <ul class="dropdown-content">
                <li><a href="myprofile.php" class="menu-item">My Profile</a></li>
                <li><a href="myorder.php" class="menu-item">My Orders</a></li>
                <li><a href="entercar.php" class="menu-item">Add New</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-item">Pages</a>
            <ul class="dropdown-content">
                    <li><a href="about.php" class="menu-item">About Us</a></li>
                    <li><a href="contactus.php" class="menu-item">Contact</a></li>
                    <li><a href="contact.php" class="menu-item">Feedbacks</a></li>
                </ul>
        </li>
    </ul>

    <div class="auth-buttons">
        <?php
        if (isset($_SESSION['login_customer']) || isset($_SESSION['login_client'])) {
            echo '<a href="logout.php" class="register-btn">Logout</a>';
        } else {
            echo '<a href="customerlogin.php" class="sign-in-btn">Sign In</a>';
            echo '<a href="customersignup.php" class="register-btn">Register</a>';
        }
        ?>
    </div>
</header>

<section class="banner">
    <h1>Complete your booking here</h1>
</section>

<div class="container">
    <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
            <?php
            $car_id = $_GET["id"];
            $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
            $result1 = mysqli_query($conn, $sql1);

            if(mysqli_num_rows($result1) > 0){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $car_name = $row1["car_name"];
                    $car_nameplate = $row1["car_nameplate"];
                }
            } else {
                echo "<h5>Error: Car details not found!</h5>";
                exit();
            }
            ?>

            <h5>Selected Car: <b><?php echo($car_name); ?></b></h5>
            <h5>Number Plate: <b><?php echo($car_nameplate); ?></b></h5>
            
            <label>Start Date:</label>
            <input type="date" name="rent_start_date" min="<?php echo(date('Y-m-d')); ?>" required>   
            
            <label>End Date:</label>
            <input type="date" name="rent_end_date" min="<?php echo(date('Y-m-d')); ?>" required>

            <h5> Choose your car type:  &nbsp;
            <input id="ac-radio" onclick="updateFare()" type="radio" name="radio" value="ac" required> <b>With AC </b>&nbsp;
            <input id="non-ac-radio" onclick="updateFare()" type="radio" name="radio" value="non_ac"><b>With-Out AC </b>
            
            <h5>Fare: <b id="fare-display">Select a car type</b></h5>

            <h5>Charge type:</h5>
            <label><input type="radio" name="charge_type" value="km"> per KM</label>
            <label><input type="radio" name="charge_type" value="days"> per day</label>

            <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
            <br>
            <center><input type="submit" name="submit" value="Rent Now"></center>
        </form>
    </div>
</div>
<br><br>
</body>
</html>
