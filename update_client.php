<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "carrental"; 

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$client_username = $_POST['client_username'];
$client_name = $_POST['client_name'];
$client_phone = $_POST['client_phone'];
$client_email = $_POST['client_email'];
$client_address = $_POST['client_address'];


$sql = "UPDATE client 
        SET client_name='$client_name', client_phone='$client_phone', client_email='$client_email', client_address='$client_address' 
        WHERE client_username='$client_username'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Client updated successfully!'); window.location.href='admin.php';</script>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
