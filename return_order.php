<?php 
session_start();
include('session_customer.php');
include('connection.php');

if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}


if (isset($_GET['id']) && isset($_GET['car_id'])) {
    $orderId = $_GET['id'];
    $carId = $_GET['car_id'];


    if (empty($orderId) || empty($carId)) {
        die("Order ID or Car ID is missing.");
    }


    $sql = "UPDATE rentedcars SET return_status = 'canceled' WHERE id = '$orderId'";
    
    if ($conn->query($sql) === TRUE) {
        

        $sqlUpdateCar = "UPDATE cars SET available = 'yes' WHERE car_id = '$carId'";
        
        if ($conn->query($sqlUpdateCar) === TRUE) {

            
            echo "
            <script>alert('Order canceled successfully. The car is now available for renting again.'); window.location.href='myorder.php';
            </script>";
        } else {

            echo "
            <script>alert('Error updating car availability: " . $conn->error . "'); window.location.href='myorder.php';
            </script>";
        }

    } else {

        echo "
        <script>alert('Error canceling order: " . $conn->error . "'); window.location.href='myorder.php';
        </script>";
    }
} else {

    die("No order ID or car ID provided.");
}
?>
