<?php
// Ensure the session is only started once
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Starting Session
}

// Check if the user is logged in as either customer or client
if (!isset($_SESSION['login_customer']) && !isset($_SESSION['login_client'])) {
    header("location: index.php"); // Redirect if not logged in
    exit;
}

require 'connection.php';
$conn = Connect();

// Check for a success message after profile update
if (isset($_SESSION['update_success'])) {
    $success_message = $_SESSION['update_success']; // Store message for display
    unset($_SESSION['update_success']); // Clear the message after displaying it
}

// Determine if the logged-in user is a client or customer
$logged_username = isset($_SESSION['login_client']) ? $_SESSION['login_client'] : (isset($_SESSION['login_customer']) ? $_SESSION['login_customer'] : null);

// Fetch the user type (customer or client) and other details
if ($logged_username) {
    if (isset($_SESSION['login_client'])) {
        // Logged in as a client
        $query = "SELECT 'client' AS user_type FROM client WHERE client_username=?";
    } else {
        // Logged in as a customer and fetching their details
        $query = "SELECT customer_name, customer_email, customer_phone, customer_address FROM customers WHERE customer_username=?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $logged_username);
    $stmt->execute();

    if (isset($_SESSION['login_client'])) {
        $stmt->bind_result($user_type);
    } else {
        // Bind the result for customer details
        $stmt->bind_result($customer_name, $customer_email, $customer_phone, $customer_address);
    }
    $stmt->fetch();
    $stmt->close();
} else {
    header("location: index.php"); // Redirect if user is not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex; /* Use flexbox to center content */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            flex-direction: column; /* Arrange items vertically */
            height: 100vh; /* Full viewport height */
        }
        h2 {
            color: #4CAF50; /* Green color */
            text-align: center;
        }
        h3 {
            color: #4CAF50; /* Green color */
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensure padding doesn't affect total width */
        }
        button {
            background-color: #4CAF50; /* Green color */
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s; /* Add transition for hover effect */
        }
        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .profile-info {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%; /* Full width */
            max-width: 600px; /* Set a max-width for the profile box */
            margin: 0 auto; /* Center the box */
        }
        .alert {
            background-color: #4CAF50; /* Green background */
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            position: absolute; /* Position it absolutely */
            top: 20px; /* 20px from the top */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%); /* Adjust the position to truly center */
            width: 90%; /* Responsive width */
            max-width: 600px; /* Maximum width */
            display: none; /* Initially hidden */
        }
    </style>
</head>
<body>

<?php if (isset($success_message)) : ?>
    <div class="alert"><?php echo htmlspecialchars($success_message); ?></div>
<?php endif; ?>

<div class="profile-info">
<h2>My Profile</h2>

    <?php if (isset($_SESSION['login_client'])) : ?>
        <h3>You are logged in as a client</h3>
        <p>To change your password, fill in the details below:</p>
        
        <!-- Password change form -->
        <form action="change_password.php" method="POST">
            <button type="submit" name="change_password">Change Password</button>
        </form>

    <?php elseif (isset($_SESSION['login_customer'])) : ?>
        <h3>Your Profile Information</h3>
        <!-- Display all the details of the logged-in customer -->
        <p><strong>Name:</strong> <?php echo htmlspecialchars($customer_name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($customer_email); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer_phone); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($customer_address); ?></p>

        <!-- Option to update or delete profile -->
        <form action="update_profile.php" method="POST">
            <label for="customer_name">Name:</label>
            <input type="text" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>" required>

            <label for="customer_email">Email:</label>
            <input type="email" id="customer_email" name="customer_email" value="<?php echo htmlspecialchars($customer_email); ?>" required>

            <label for="customer_phone">Phone:</label>
            <input type="text" id="customer_phone" name="customer_phone" value="<?php echo htmlspecialchars($customer_phone); ?>" required>

            <label for="customer_address">Address:</label>
            <input type="text" id="customer_address" name="customer_address" value="<?php echo htmlspecialchars($customer_address); ?>" required>

            <button type="submit" name="update">Update Profile</button>
        </form>

        <form action="delete_profile.php" method="POST">
            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</button>
        </form>
    <?php endif; ?>
</div>

<script>
    // Show the alert if it exists
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
        alertBox.style.display = 'block'; // Make it visible
        setTimeout(() => {
            alertBox.style.display = 'none'; // Hide after 3 seconds
        }, 3000); // Change to your desired duration
    }
</script>

</body>
</html>

<?php
// Close the database connection after HTML has been rendered
$conn->close();
?>
