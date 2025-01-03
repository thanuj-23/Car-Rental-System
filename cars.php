<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rentals</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Car List Styling */
        .menu-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 0 auto;
            max-width: 1200px;
            padding: 20px;
        }

        .sub-menu {
            width: 80%;
            background: #fff;
            margin: 15px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 10px;
            text-align: center;
            overflow: hidden; /* To prevent overflow from images */
        }

        .sub-menu:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .sub-menu img {
            max-width: 100%;
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .sub-menu img:hover {
            transform: scale(1.05); /* Zoom effect on image hover */
        }

        .sub-menu h5, .sub-menu h6 {
            margin: 10px 0;
        }

        .sub-menu h5 {
            font-size: 20px;
            font-weight: bold;
        }

        .sub-menu h6 {
            font-size: 16px;
            color: #555;
        }

        .banner {
            background-color: #2e7d32;
            padding: 60px 0;
            text-align: center;
            color: white;
            height: 40%;
        }

        .banner h1 {
            font-size: 60px;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        @media (max-width: 768px) {
            .sub-menu {
                width: 45%; /* Adjust for medium screens */
            }
        }

        @media (max-width: 480px) {
            .sub-menu {
                width: 100%; /* Full width on small screens */
            }
        }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

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

    <!-- Dynamic Authentication Buttons -->
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
    <h1>Available Cars</h1>
</section>
<script>
        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>

<br>
<section class="menu-content">

<?php   
$sql1 = "SELECT * FROM cars WHERE available='yes'";
$result1 = mysqli_query($conn, $sql1);

if (!$result1) {
    die("Error retrieving data: " . mysqli_error($conn));
}

if(mysqli_num_rows($result1) > 0) {
    while($row1 = mysqli_fetch_assoc($result1)){
        $car_id = $row1["car_id"];
        $car_name = $row1["car_name"];
        $ac_price = $row1["ac_price"];
        $ac_price_per_day = $row1["ac_price_per_day"];
        $non_ac_price = $row1["non_ac_price"];
        $non_ac_price_per_day = $row1["non_ac_price_per_day"];
        $car_img = $row1["car_img"];
?>
    <a href="booking.php?id=<?php echo($car_id) ?>">
        <div class="sub-menu">
            <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Car image">
            <h5><b><?php echo $car_name; ?></b></h5>
            <h6>AC Fare: <?php echo ("Rs. " . $ac_price . "/km & Rs." . $ac_price_per_day . "/day"); ?></h6>
            <h6>Non-AC Fare: <?php echo ("Rs. " . $non_ac_price . "/km & Rs." . $non_ac_price_per_day . "/day"); ?></h6>
        </div>
    </a>
<?php 
    }
} else {
    echo "<h1>No cars available :</h1>";
}
?>
</section>

<script>
    function sendGaEvent(category, action, label) {
        ga('send', {
            hitType: 'event',
            eventCategory: category,
            eventAction: action,
            eventLabel: label
        });
    }
</script>

<br><br>
<!-- Footer Begin -->
<footer>
    <div class="row">
        <!-- Logo and About Section -->
        <div class="col">
            <img src="images/logo.png" class="logo" alt="QuickWay Logo">
            <p>Car rentals with first-class service, 24/7 assistance, and a seamless travel experience. Travel in style and comfort wherever you go.</p>
        </div>

        <!-- Quick Links Section -->
        <div class="col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cars.php">Cars</a></li>
                <li><a href="booking.php">Booking</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>

        <!-- Contact Details Section -->
        <div class="col">
            <h3>Contact Details</h3>
            <p><br><i>No. 117 Kandy Rd,<br> 
                Malabe<br></i>
               <br>
               <i>+94 77 811 2218</i><br><br>
            <a href="mailto:quickway@gmail.com" class="email-link"><i>quickway@gmail.com</i></a></p>
        </div>

        <!-- Social Media Section -->
        <div class="col">
            <h3>Social Network</h3>
            <div class="social-icons">
                <a href="https://web.facebook.com/"><img src="images/icon/facebook.png" alt="Facebook" class="social-img"></a>
                <a href="https://x.com/"><img src="images/icon/twitter.png" alt="Twitter" class="social-img"></a>
                <a href="https://linkedin.com/"><img src="images/icon/linkedin.png" alt="LinkedIn" class="social-img"></a>
                <a href="https://youtube.com/"><img src="images/icon/youtube.png" alt="Pinterest" class="social-img"></a>
                <a href="https://web.whatsapp.com/"><img src="images/icon/whatsapp.png" alt="RSS" class="social-img"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; QuickWay 2024 - All Rights Reserved<br>
            <a href="privacy.php" class="col">Privacy policy</a> | <a href="terms.php" class="col">Terms and Conditions</a>
        </p>
    </div>
</footer>
<!-- Footer End -->

</body>
</html>
