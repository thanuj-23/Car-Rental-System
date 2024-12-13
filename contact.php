<?php
session_start();
require 'connection.php';
$conn = Connect();

// Check if the user is logged in as a customer to allow feedback modification
$logged_username = isset($_SESSION['login_customer']) ? $_SESSION['login_customer'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
   
    <style>
        .feedback-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Center the section */
            max-width: 80%; /* Restrict the width to 80% of the viewport */
            margin-left: 20%; /* Add left margin */
            margin-right: 20%; /* Add right margin */
        }
        .feedback-list {
            margin-bottom: 20px;
        }
        .feedback-item {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }
        h3 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
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
</header>

<br><br>
<!-- Banner Section -->
<section class="banner">
    <h1>Customer Feedback</h1>
</section>
<script>
    window.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    })
</script>

<section class="feedback-section">
    <h3>Customer Feedback</h3>
    
    <!-- Display feedback -->
    <div class="feedback-list">
        <?php
        // Fetch and display all feedback
        $feedback_query = "SELECT id, username, feedback FROM feedback";
        $feedback_result = $conn->query($feedback_query);
        
        if ($feedback_result->num_rows > 0) {
            while ($row = $feedback_result->fetch_assoc()) {
                echo "<div class='feedback-item'>";
                echo "<p style='margin: 0;'><strong>{$row['username']}:</strong> {$row['feedback']}</p>";
                
                // If the logged-in user is the owner of the feedback, show edit/delete options
                if ($logged_username == $row['username']) {
                    echo "<form action='update_feedback.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='feedback_id' value='{$row['id']}'>
                            <input type='submit' name='edit_feedback' value='Edit' style='background-color: #4CAF50; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;'>
                          </form>";
                    echo "<form action='delete_feedback.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='feedback_id' value='{$row['id']}'>
                            <input type='submit' name='delete_feedback' value='Delete' style='background-color: #f44336; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;' onclick='return confirm(\"Are you sure you want to delete this feedback?\")'>
                          </form>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }
        ?>
    </div>

    <!-- Leave Feedback Form (only for logged-in customers) -->
    <?php if ($logged_username): ?>
    <h3>Leave a Feedback</h3>
    <form action="create_feedback.php" method="POST" style="margin-top: 10px;">
        <textarea name="feedback" placeholder="Write your feedback here..." rows="4" required></textarea>
        <button type="submit" name="submit_feedback">Submit Feedback</button>
    </form>
    <?php else: ?>
    <p><a href="customerlogin.php">Login</a> to leave feedback.</p>
    <?php endif; ?>
</section>
<br><br>
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

<?php
$conn->close();
?>
