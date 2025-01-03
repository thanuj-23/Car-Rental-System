<?php
session_start();
require 'connection.php';
$conn = Connect();

if (isset($_POST['save_feedback']) && isset($_SESSION['login_customer'])) {
    $feedback_id = $_POST['feedback_id'];
    $feedback = htmlspecialchars($_POST['feedback']);
    $username = $_SESSION['login_customer'];

    $query = "UPDATE feedback SET feedback=? WHERE id=? AND username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sis", $feedback, $feedback_id, $username);

    if ($stmt->execute()) {
        $_SESSION['feedback_message'] = "Feedback updated successfully!";
    } else {
        $_SESSION['feedback_message'] = "Error updating feedback.";
    }
    
    $stmt->close();
}

$conn->close();
header("Location: contact.php");
exit;
?>
