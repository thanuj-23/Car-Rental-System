<?php
// Ensure the session is only started once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'connection.php';
$conn = Connect();

// Check if the user is logged in as a customer
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php");
    exit;
}

$logged_username = $_SESSION['login_customer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Sanitize the form inputs
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $customer_email = htmlspecialchars($_POST['customer_email']);
    $customer_phone = htmlspecialchars($_POST['customer_phone']);
    $customer_address = htmlspecialchars($_POST['customer_address']);
    
    // Prepare the SQL query to update customer details
    $query = "UPDATE customers SET customer_name=?, customer_email=?, customer_phone=?, customer_address=? WHERE customer_username=?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $customer_name, $customer_email, $customer_phone, $customer_address, $logged_username);
    
    if ($stmt->execute()) {
        // If update is successful, set a session message
        $_SESSION['update_success'] = "Your profile has been updated successfully!";
        $stmt->close();
        
        // Redirect back to the profile page
        header("location: myprofile.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
