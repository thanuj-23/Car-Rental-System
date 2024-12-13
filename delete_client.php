<?php

$host = "localhost";
$user = "root";
$password = ""; 
$database = "carrental"; 

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['client_id'])) {
    $client_id = $_POST['client_id'];


    $deleteRelatedSql = "DELETE FROM clientcars WHERE client_username = ?";
    
    $stmt = $conn->prepare($deleteRelatedSql);
    $stmt->bind_param("s", $client_id);
    $stmt->execute();
    $stmt->close();


    $deleteClientSql = "DELETE FROM client WHERE client_username = ?";
    
    $stmt = $conn->prepare($deleteClientSql);
    $stmt->bind_param("s", $client_id);

    if ($stmt->execute()) {
        echo "Client deleted successfully.";
    } else {
        echo "Error deleting client: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No client ID provided.";
}
?>
