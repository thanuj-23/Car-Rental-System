<!DOCTYPE html>
<html lang="en">
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <title>About Us</title>
    <link rel="stylesheet" href="about.css">
    <script defer src="about.js"></script>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
</head>

<body>

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
            // Show logout button if user is logged in
            echo '<a href="logout.php" class="register-btn">Logout</a>';
        } else {
            // Show login and register buttons if user is not logged in
            echo '<a href="customerlogin.php" class="sign-in-btn">Sign In</a>';
            echo '<a href="customersignup.php" class="register-btn">Register</a>';
        }
        ?>
    </div>
</header>

<!-- Banner Section -->
<section class="banner">
    <h1>About Us</h1>
</section>

<!-- About Us Section -->
<section class="about-us">
    <div class="container">
        <div class="content">
            <div class="image">
                <img src="images/car-image.jpg" alt="Car Rental Service">
            </div>
            <div class="text">
                <h2>About Our Car Rental Service</h2>
                <p>
                    At QuickWay Car Rental, we pride ourselves on providing exceptional car rental services tailored to your needs. Our extensive fleet features a diverse selection of vehicles, ensuring that you find the perfect match for any occasion. Whether you need a reliable car for a business trip or a stylish vehicle for a weekend getaway, we are dedicated to making your experience enjoyable and hassle-free.
                </p>
                <ul class="features">
                    <li><i class="fas fa-car"></i> Diverse fleet of vehicles</li>
                    <li><i class="fas fa-map-marker-alt"></i> Multiple convenient pick-up locations</li>
                    <li><i class="fas fa-shield-alt"></i> Comprehensive insurance options</li>
                    <li><i class="fas fa-users"></i> Exceptional customer support</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="stats-section">
    <div class="stat-box">
        <i class="fa fa-car icon"></i>
        <div class="stat-number">30+</div>
        <p>Available Vehicles</p>
    </div>
    <div class="stat-box">
        <i class="fa fa-users icon"></i>
        <div class="stat-number">200+</div>
        <p>Satisfied Clients</p>
    </div>
    <div class="stat-box">
        <i class="fa fa-globe icon"></i>
        <div class="stat-number">3</div>
        <p>Countries Served</p>
    </div>
    <div class="stat-box">
        <i class="fa fa-calendar icon"></i>
        <div class="stat-number">2</div>
        <p>Years of Experience</p>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Expertise Section -->
<section class="expertise">
    <div class="container">
        <h2>Our Expertise</h2>
        <div class="expertise-grid">
            <div class="expertise-item">
                <h3>Car Rental Solutions</h3>
                <p>
                    We provide customized solutions tailored to your car rental needs, offering flexibility and variety.
                </p>
            </div>
            <div class="expertise-item">
                <h3>Custom Services</h3>
                <p>
                    Our team ensures your car rental service is designed with top-notch software and tailored solutions for your business.
                </p>
            </div>
            <div class="expertise-item">
                <h3>Customer Satisfaction</h3>
                <p>
                    We take pride in our commitment to customer satisfaction, delivering quality service and support to our clients.
                </p>
            </div>
        </div>
    </div>
</section>
<br><br>
<!-- Footer Section -->
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

<script src="script.js"></script>

</body>
</html>
