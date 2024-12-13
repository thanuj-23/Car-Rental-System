<?php

include('connection.php'); 

// Ensure a connection is made
$conn = Connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['car_id'])) {
        $car_id = $_POST['car_id'];

        // First, delete any related records in the clientcars table
        $delete_clientcars_sql = "DELETE FROM clientcars WHERE car_id = ?";
        if ($stmt = mysqli_prepare($conn, $delete_clientcars_sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $car_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Then, delete any related records in the rentedcars table
        $delete_rentedcars_sql = "DELETE FROM rentedcars WHERE car_id = ?";
        if ($stmt = mysqli_prepare($conn, $delete_rentedcars_sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $car_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Now, delete the car from the cars table
        $delete_cars_sql = "DELETE FROM cars WHERE car_id = ?";
        if ($stmt = mysqli_prepare($conn, $delete_cars_sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $car_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "Car deleted successfully!";
                header('Location: entercar.php'); // Redirect back to the car list page
                exit();
            } else {
                echo "Error deleting car: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo "Car ID is not set.";
    }
}

mysqli_close($conn);
?>
