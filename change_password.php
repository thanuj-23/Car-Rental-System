<?php
// Ensure the session is only started once
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Starting Session
}

// Check if the client is logged in
if (!isset($_SESSION['login_client'])) {
    header("location: index.php"); // Redirect if not logged in
    exit;
}

require 'connection.php';
$conn = Connect();

$logged_username = $_SESSION['login_client'];

// Initialize variables to prevent warnings
$current_password = $new_password = $confirm_password = "";
$error_message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set before accessing them
    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        // Collect the form data
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Fetch the client's current password from the database
        $query = "SELECT client_password FROM client WHERE client_username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $logged_username);
        $stmt->execute();
        $stmt->bind_result($stored_password);
        $stmt->fetch();
        $stmt->close();

        // Verify if the current password is correct
        if ($stored_password !== $current_password) {
            // If the current password is incorrect
            $error_message = "The current password is incorrect.";
        } elseif ($new_password !== $confirm_password) {
            // If the new password and confirmation password do not match
            $error_message = "New password and confirmation password do not match.";
        } else {
            // Update the password in the database
            $update_query = "UPDATE client SET client_password=? WHERE client_username=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ss", $new_password, $logged_username);

            if ($stmt->execute()) {
                // Password updated successfully, display popup and redirect
                echo "<script>
                        alert('Password changed successfully!');
                        window.location.href = 'index.php'; // Redirect to home page
                      </script>";
                exit; // Ensure no further code is executed
            } else {
                $error_message = "Error updating password. Please try again.";
            }

            $stmt->close();
        }
    } else {
        // Error handling if form fields are not set
        $error_message = "All fields are required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>

<h2>Change Password</h2>

<!-- Display success or error message -->
<?php if ($error_message) { echo "<p class='error'>$error_message</p>"; } ?>

<form action="change_password.php" method="POST">
    <label for="current_password">Current Password:</label>
    <input type="password" name="current_password" required>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Change Password</button>
</form>

</body>
</html>
