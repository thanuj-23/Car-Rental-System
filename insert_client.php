<?php
include('connection.php');
$conn = Connect();


$client_username = $_POST['client_username'];
$client_name = $_POST['client_name'];
$client_phone = $_POST['client_phone'];
$client_email = $_POST['client_email'];
$client_address = $_POST['client_address'];
$client_password = $_POST['client_password'];


$sql = "INSERT INTO client (client_username, client_name, client_phone, client_email, client_address, client_password, user_type) 
        VALUES ('$client_username', '$client_name', '$client_phone', '$client_email', '$client_address', '$client_password', 'client')";

if ($conn->query($sql) === TRUE) {
    echo "
    
    <script>alert('Client registered successfully!'); window.location.href='admin.php';
    </script>";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
