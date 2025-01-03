<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental | Home</title>
    <link rel="stylesheet" href="index.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
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

    <script>
        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>


    <section id="hero">
        <div class="container">
            <div class="text-content">
                <h4>Plan your trip now</h4>
                <h1>Explore the World with a Comfortable Car</h1>
                <p>Embark on unforgettable adventures and discover the world in unparalleled comfort and style with our fleet of exceptionally comfortable cars.</p>
                <div class="button-group">
                    <a href="cars.php" class="btn choose-btn">Choose a Car</a>
                </div>
            </div>
        </div>

        <div class="car-image">
            <img src="images/car.png" alt="Car Image">
        </div>
    </section>


    <section id="services">
        <div class="container2">
            <h2 class="section-title">Our Services</h2>
            <p class="section-caption">Explore a wide range of premium services designed to meet your transportation needs with ease and comfort.</p>
            <div class="service-wrapper">
                <!-- Service 1 -->
                <div class="service-box">
                    <div class="icon-box">
                        <i class="fas fa-car service-icon"></i>
                    </div>
                    <div class="service-content">
                        <h3>Car Rental</h3>
                        <p>Choose from a variety of cars to suit your needs and budget.</p>
                    </div>
                </div>

           
                <div class="service-box">
                    <div class="icon-box">
                        <i class="fas fa-user-tie service-icon"></i>
                    </div>
                    <div class="service-content">
                        <h3>Professional Drivers</h3>
                        <p>Our highly-trained, courteous drivers ensure a smooth and stress-free experience.</p>
                    </div>
                </div>

           
                <div class="service-box">
                    <div class="icon-box">
                        <i class="fas fa-headset service-icon"></i>
                    </div>
                    <div class="service-content">
                        <h3>24/7 Customer Support</h3>
                        <p>We're here for you around the clock, providing instant assistance for all inquiries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="row">
         
            <div class="col">
                <img src="images/logo.png" class="logo" alt="QuickWay Logo">
                <p>Car rentals with first-class service, 24/7 assistance, and a seamless travel experience. Travel in style and comfort wherever you go.</p>
            </div>


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

 
            <div class="col">
                <h3>Contact Details</h3>
                <p><br><i>No. 117 Kandy Rd,<br> 
                    Malabe<br></i>
                   <br>
                   <i>+94 77 811 2218</i><br><br>
                <a href="mailto:quickway@gmail.com" class="email-link"><i>quickway@gmail.com</i></a></p>
            </div>

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

</body>

</html>
