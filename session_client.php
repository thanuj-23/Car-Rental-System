<?php
// Include connection file
require 'connection.php';

// Use the Connect() function to get the connection object
$conn = Connect();

// Start the session
session_start();

// Check if the session variable is set
if (isset($_SESSION['login_client'])) {
    // Storing Session
    $user_check = $_SESSION['login_client'];

    // SQL Query To Fetch Complete Information Of User
    $query = "SELECT client_username FROM client WHERE client_username = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    
    // Check if a row is returned
    if ($row = mysqli_fetch_assoc($ses_sql)) {
        $login_session = $row['client_username'];
    } else {
        // Redirect if the user is not found in the database
        header("Location: clientlogin.php"); 
        exit(); 
    }
} else {
    // Redirect if the user is not logged in
    header("Location: clientlogin.php"); 
    exit(); 
}
?>
