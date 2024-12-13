<?php
session_start();
require 'connection.php';
$conn = Connect();

if (isset($_POST['delete_feedback']) && isset($_SESSION['login_customer'])) {
    $feedback_id = $_POST['feedback_id'];
    $username = $_SESSION['login_customer'];

    $query = "DELETE FROM feedback WHERE id=? AND username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $feedback_id, $username);

    if ($stmt->execute()) {
        $_SESSION['feedback_message'] = "Feedback deleted successfully!";
    } else {
        $_SESSION['feedback_message'] = "Error deleting feedback.";
    }

    $stmt->close();
}

$conn->close();
header("Location: contact.php");
exit;
?>
