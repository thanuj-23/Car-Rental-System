<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup | Car Rentals</title>
    <link rel="stylesheet" href="signup.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css"> <!-- Additional styles -->
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
    <script>
    window.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    })
</script>

<br><br><br><br><br><br><br>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color:#fff;">Car Rentals - Registration</h1>
            <p class="text-center" style="color:#fff;">Get started by creating a customer account</p>
        </div>
    </div>
<br><br>
    <div class="container signup-container">
        <div class="panel">
            <div class="panel-heading">Create Account</div><br>
            <div class="panel-body">
                <form action="customer_registered_success.php" method="POST">
                    <div class="form-group">
                        <label for="customer_name"><span class="text-danger">*</span> Full Name:</label>
                        <input class="form-control" id="customer_name" type="text" name="customer_name" placeholder="Your Full Name" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_username"><span class="text-danger">*</span> Username:</label>
                        <input class="form-control" id="customer_username" type="text" name="customer_username" placeholder="Your Username" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_email"><span class="text-danger">*</span> Email:</label>
                        <input class="form-control" id="customer_email" type="email" name="customer_email" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone"><span class="text-danger">*</span> Phone:</label>
                        <input class="form-control" id="customer_phone" type="text" name="customer_phone" placeholder="Phone" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_address"><span class="text-danger">*</span> Address:</label>
                        <input class="form-control" id="customer_address" type="text" name="customer_address" placeholder="Address" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_password"><span class="text-danger">*</span> Password:</label>
                        <input class="form-control" id="customer_password" type="password" name="customer_password" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    <p style="text-align:center;">Already have an account?<a href="customerlogin.php" style="text-decoration: none;color:green;"><b>Login.<b></a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
