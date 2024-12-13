<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="assets/css/privacy-policy.css"> <!-- Adjusted the path to match your structure -->
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        

        /* Main content styles */
        .main-content {
            margin: 65px 20px 20px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .main-content h1 {
            color: #333;
        }

        .content {
            margin-bottom: 20px;
        }


    </style>
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
                    <li><a href="#" class="menu-item">My Profile</a></li>
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
    </header>
    <section class="banner" style="background: url('images/tc.jpg');">
</section>
    <script>
        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <!-- Main Content -->
    <div class="main-content">
        <h1>Terms and Conditions for QuickWay Car Rental</h1>
        <div class="content">
            <h2>1. Introduction</h2>
            <p>Welcome to the Terms and Conditions for QuickWay Car Rental. By using our services, you agree to comply with and be bound by the following terms. Please review them carefully.</p>
        </div>
        <div class="content">
            <h2>2. Booking and Cancellation</h2>
            <p>To book a vehicle, you must provide valid identification and payment information. Cancellations made within 24 hours of the rental start time may incur a fee.</p>
        </div>
        <div class="content">
            <h2>3. Rental Conditions</h2>
            <p>Renters must be at least 21 years old and possess a valid driver’s license. All rental vehicles must be returned in the same condition as received.</p>
        </div>
        <div class="content">
            <h2>4. Liability</h2>
            <p>QuickWay Car Rental is not responsible for any damages or losses incurred during the rental period. Renters are responsible for any damages to the vehicle.</p>
        </div>
        <div class="content">
            <h2>5. Changes to Terms</h2>
            <p>QuickWay reserves the right to change these terms at any time. Changes will be communicated through our website.</p>
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
            <!-- Social Media Section -->
            <div class="col">
                <h3>Social Network</h3>
                <div class="social-icons">
                    <a href="https://web.facebook.com/"><img src="images/icon/facebook.png" alt="Facebook" class="social-img"></a>
                    <a href="https://x.com/"><img src="images/icon/twitter.png" alt="Twitter" class="social-img"></a>
                    <a href="https://linkedin.com/"><img src="images/icon/linkedin.png" alt="LinkedIn" class="social-img"></a>
                    <a href="https://youtube.com/"><img src="images/icon/youtube.png" alt="YouTube" class="social-img"></a>
                    <a href="https://web.whatsapp.com/"><img src="images/icon/whatsapp.png" alt="WhatsApp" class="social-img"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; QuickWay 2024 - All Rights Reserved</p>
        </div>
    </footer>
</body>
</html>
