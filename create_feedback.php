<?php
session_start();
require 'connection.php';
$conn = Connect();

if (isset($_POST['submit_feedback']) && isset($_SESSION['login_customer'])) {
    $feedback = htmlspecialchars($_POST['feedback']);
    $username = $_SESSION['login_customer'];

    $query = "INSERT INTO feedback (username, feedback) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $feedback);

    if ($stmt->execute()) {
        $_SESSION['feedback_message'] = "Feedback submitted successfully!";
    } else {
        $_SESSION['feedback_message'] = "Error submitting feedback.";
    }
    
    $stmt->close();
}

$conn->close();
header("Location: contact.php");
exit;
?>
