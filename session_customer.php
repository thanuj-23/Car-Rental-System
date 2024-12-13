<?php
// mysqli_connect() function opens a new connection to the MySQL server.
require 'connection.php';
$conn = Connect();

// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if none is active
}

// Storing Session
$user_check = $_SESSION['login_customer'];

// SQL Query To Fetch Complete Information Of User
$query = "SELECT customer_username FROM customers WHERE customer_username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['customer_username'];
?>
