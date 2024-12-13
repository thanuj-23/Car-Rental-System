<html>
<head>
  <title>Customer Signup | Car Rentals</title>
  <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
  <link rel="stylesheet" type="text/css" href="manager_registered_success.css">
</head>

<body>

  <nav class="navbar">
    <div class="navbar-container">
      <a class="navbar-brand" href="index.php">Car Rentals</a>
      <div class="navbar-right">
        <?php if (isset($_SESSION['login_client'])) { ?>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Welcome <?php echo $_SESSION['login_client']; ?></a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
        <?php } elseif (isset($_SESSION['login_customer'])) { ?>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Welcome <?php echo $_SESSION['login_customer']; ?></a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </nav>

  <!-- Inserting Customer Data -->
  <?php
  require 'connection.php';
  $conn = Connect();

  $customer_name = $conn->real_escape_string($_POST['customer_name']);
  $customer_username = $conn->real_escape_string($_POST['customer_username']);
  $customer_email = $conn->real_escape_string($_POST['customer_email']);
  $customer_phone = $conn->real_escape_string($_POST['customer_phone']);
  $customer_address = $conn->real_escape_string($_POST['customer_address']);
  $customer_password = $conn->real_escape_string($_POST['customer_password']);

  // Check if username already exists
  $check_username_query = "SELECT * FROM customers WHERE customer_username = '$customer_username'";
  $result = $conn->query($check_username_query);

  if ($result->num_rows > 0) {
    die("Username already taken. Please choose a different one.");
  } else {

 // add user_type when inserting data
$query = "INSERT INTO customers (customer_name, customer_username, customer_email, customer_phone, customer_address, customer_password, user_type) 
VALUES('$customer_name','$customer_username','$customer_email','$customer_phone','$customer_address','$customer_password', 'customer')";

    $success = $conn->query($query);

    if (!$success) {
      die("Couldn't enter data: " . $conn->error);
    }
  }

  $conn->close();
  ?>

  <!-- Success Message Section -->
  <div class="success-container">
    <div class="success-message">
      <h2>Welcome <?php echo $customer_name; ?>!</h2>
      <h1>Your account has been successfully created.</h1>
      <p>Login now from <a href="customerlogin.php">HERE</a></p>
    </div>
  </div>
</body>
</html>
