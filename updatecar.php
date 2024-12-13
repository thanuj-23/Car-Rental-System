<?php
require_once('connection.php');
$conn = Connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $car_nameplate = $_POST['car_nameplate'];
    $ac_price = $_POST['ac_price'];
    $non_ac_price = $_POST['non_ac_price'];
    $ac_price_per_day = $_POST['ac_price_per_day'];
    $non_ac_price_per_day = $_POST['non_ac_price_per_day'];

    // Update the car details
    $sql = "UPDATE cars SET car_name=?, car_nameplate=?, ac_price=?, non_ac_price=?, ac_price_per_day=?, non_ac_price_per_day=? WHERE car_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddddi", $car_name, $car_nameplate, $ac_price, $non_ac_price, $ac_price_per_day, $non_ac_price_per_day, $car_id);

    if ($stmt->execute()) {
        echo "Car details updated successfully.";
        header("Location: entercar.php"); // Redirect to the main page after update
        exit();
    } else {
        echo "Error updating car details: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
