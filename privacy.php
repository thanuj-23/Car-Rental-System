<!DOCTYPE html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy policy</title>
    <link rel="stylesheet" href="assets/css/privacy.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

    <!-- Header -->
    
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
                <li><a href="#" class="menu-item">My Orders</a></li>
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
    <script>
        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>
    <!-- Privacy Policy Content -->
    <div class="privacy-policy main-content">
        <div class="introduction">
            <p>Welcome to the privacy policy of QuickWay Car Rental. We value your privacy and are dedicated to safeguarding your personal data. This privacy policy outlines how we protect your personal data as a customer and provides updates on your privacy rights and legal protection. Our company is responsible for the collection, handling, and processing of your personal data.</p>
        </div>
        <br>
        <div class="title">
            <p>PRIVACY POLICY FOR QUICKWAY</p>
        </div>
        <div class="introduction-2">
            <p>This privacy policy describes how QuickWay collects, uses, and shares personal information obtained through our car rental services. By using our services, you agree to the terms outlined in this policy.</p>
        </div>

        <!-- Section 1 -->
        <div class="content">
            <div class="heading-1">
                <h1>1. Information We Collect</h1>
            </div>
            <div class="heading-1para">
                <p>• Personal Information: Name, contact details (email, phone number), driver’s license information, and payment details.
                <br>• Rental Information: Rental history, vehicle preferences, and reservation details.
                <br>• Location Data: GPS data from rented vehicles, addresses related to pickup and drop-off, and real-time vehicle tracking.
                <br>• Communication Data: Records of communications with customer support or our company.
                <br>• Technical Data: IP addresses, device information, browser types, and activity logs on our website or mobile app.
                </p>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="content">
            <div class="heading-2">
                <h1>2. How We Use Your Information</h1>
            </div>
            <div class="heading-2para">
                <p>• To process bookings and payments.
                <br>• To verify identity and driver’s eligibility.
                <br>• To manage rental services and provide customer support.
                <br>• To monitor and improve the performance and safety of our vehicles.
                <br>• For marketing purposes, including sending offers or promotions (with consent).
                <br>• To comply with legal obligations, such as responding to law enforcement requests.
                </p>
            </div>
        </div>

        <!-- Section 3 -->
        <div class="content">
            <div class="heading-3">
                <h1>3. How We Share Your Information</h1>
            </div>
            <div class="heading-3para">
                <p>• Service Providers: With trusted third-party service providers who help us with billing, vehicle tracking, and customer support.
                <br>• Business Transfers: In the event of a merger, acquisition, or sale of assets, your personal information may be transferred to the involved parties.
                <br>• Legal Requirements: When required by law, we may disclose your information to government authorities, law enforcement, or third parties in response to legal requests.
                <br>• Insurance and Accident Claims: With insurance companies, law enforcement, or relevant authorities in the event of an accident.
                </p>
            </div>
        </div>

        <!-- Section 4 -->
        <div class="content">
            <div class="heading-4">
                <h1>4. Data Retention</h1>
            </div>
            <div class="heading-4para">
                <p>We will retain your personal information for as long as necessary to fulfill the purposes for which it was collected, comply with legal obligations, or resolve disputes.</p>
            </div>
        </div>

        <!-- Section 5 -->
        <div class="content">
            <div class="heading-5">
                <h1>5. Security Measures</h1>
            </div>
            <div class="heading-5para">
                <p>We employ industry-standard security measures to protect your data against unauthorized access, disclosure, or destruction. However, no system is 100% secure, and we cannot guarantee absolute security.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
                    <li><a href="contactus.php">Contact Us</a></li>
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
                    <a href="#"><img src="images/icon/facebook.png" alt="Facebook" class="social-img"></a>
                    <a href="#"><img src="images/icon/twitter.png" alt="Twitter" class="social-img"></a>
                    <a href="#"><img src="images/icon/linkedin.png" alt="LinkedIn" class="social-img"></a>
                    <a href="#"><img src="images/icon/youtube.png" alt="YouTube" class="social-img"></a>
                    <a href="#"><img src="images/icon/whatsapp.png" alt="WhatsApp" class="social-img"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 QuickWay Rent a Car. All Rights Reserved<br>
                <a href="privacy.php" class="col">Privacy policy</a> | <a href="terms.php" class="col">Terms and Conditions</a>
            </p>
        </div>
    </footer>

</body>
</html>


