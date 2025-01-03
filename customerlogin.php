<?php
include('login_customer.php'); // Includes Login Script

if (isset($_SESSION['login_customer'])) {
    if($_SESSION['login_customer'] == 'admin'){
		header("location: admin.php");
	}else{
        header("location: index.php"); //Redirecting
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
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
	</header>	

<br><br>

    <div class="login-container">
        <h2></h2>
        <p class="text-center">Please LOGIN to continue.</p>

        <form action="" method="POST">
            <label for="customer_username">Username:</label>
            <input id="customer_username" type="text" name="customer_username" placeholder="Username" required autofocus>

            <label for="customer_password">Password:</label>
            <input id="customer_password" type="password" name="customer_password" placeholder="Password" required>

            <span class="error"><?php echo $error; ?></span>

            <button name="submit" type="submit" value="Login">Submit</button>

            <p>or</p>
            <p><a href="customersignup.php">Create a new account.</a></p>
        </form>
    </div>
</body>

</html>

