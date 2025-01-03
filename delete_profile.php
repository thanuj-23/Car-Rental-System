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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    // Start by deleting related records in rentedcars
    $deleteRentedCarsQuery = "DELETE FROM rentedcars WHERE customer_username=?";
    $stmtRentedCars = $conn->prepare($deleteRentedCarsQuery);
    $stmtRentedCars->bind_param("s", $logged_username);

    if ($stmtRentedCars->execute()) {
        // After deleting related rentedcars, delete the customer from customers table
        $deleteCustomerQuery = "DELETE FROM customers WHERE customer_username=?";
        $stmtCustomer = $conn->prepare($deleteCustomerQuery);
        $stmtCustomer->bind_param("s", $logged_username);

        if ($stmtCustomer->execute()) {
            // Log out the user after deletion
            session_unset(); // Remove all session variables
            session_destroy(); // Destroy the session
            
            $stmtCustomer->close();
            
            // Redirect to the signup page
            header("location: customersignup.php");
            exit;
        } else {
            echo "Error deleting customer: " . $conn->error;
        }

        $stmtCustomer->close();
    } else {
        echo "Error deleting rented cars: " . $conn->error;
    }

    $stmtRentedCars->close();
}

$conn->close();
?>
