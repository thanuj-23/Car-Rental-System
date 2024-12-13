<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="contact.js"></script>
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
            </ul>
        </li>
    </ul>
</header>

<br><br>
<!-- Banner Section -->
<section class="banner">
    <h1>Contact Us</h1>
</section>
<script>
    window.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    })
</script>

<section class="contact-section">
    <div class="container">
        <!-- Left side: Get in Touch Section -->
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p>Welcome to Quickway, your go-to car rental service with a diverse fleet, competitive rates, and excellent customer support. Find the perfect vehicle for any occasion today!</p>
            
            <div class="info-item">
                <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <h4>Address</h4>
                    <p>No. 117 Kandy Rd,
                        Malabe</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="icon-circle"><i class="fas fa-phone-alt"></i></div>
                <div>
                    <h4>Phone Number</h4>
                    <p>+94 77 811 2218</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                <div>
                    <h4>Email</h4>
                    <p>quickway@gmail.com</p>
                </div>
            </div>
        </div>

        <!-- Right side: Contact Form -->
        <div class="contact-form">
            <h3>Send a Message</h3>
            <form id="contactForm" action="process_contact.php" method="POST">
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                <input type="tel" id="phone" name="phone" placeholder="Your Phone Number" required>
                <textarea id="message" name="message" placeholder="Message" rows="4" required></textarea>
                <button type="submit">Submit</button>
            </form>
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
        <p>2024 QuickWay Rent a Car. All Rights Reserved</p>
    </div>
</footer>

</body>
</html>