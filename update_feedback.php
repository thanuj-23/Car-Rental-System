<?php
session_start();
require 'connection.php';
$conn = Connect();

if (isset($_POST['edit_feedback']) && isset($_SESSION['login_customer'])) {
    $feedback_id = $_POST['feedback_id'];
    $username = $_SESSION['login_customer'];

    // Fetch the feedback content
    $query = "SELECT feedback FROM feedback WHERE id=? AND username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $feedback_id, $username);
    $stmt->execute();
    $stmt->bind_result($feedback);
    $stmt->fetch();
    $stmt->close();

    // Display feedback editing form
    if ($feedback) {
        echo '<style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .edit-feedback-form {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    max-width: 500px;
                    margin: 20px auto;
                }
                textarea {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    margin-bottom: 10px;
                    resize: none; /* Disable resizing for a cleaner look */
                }
                button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 10px 15px;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }
                button:hover {
                    background-color: #45a049;
                }
              </style>';
              
        echo "<div class='edit-feedback-form'>
                <h3>Edit Feedback</h3>
                <form action='save_feedback.php' method='POST'>
                    <textarea name='feedback' required>{$feedback}</textarea>
                    <input type='hidden' name='feedback_id' value='{$feedback_id}'>
                    <button type='submit' name='save_feedback'>Save Feedback</button>
                </form>
              </div>";
    } else {
        echo "<p>No feedback found or permission denied.</p>";
    }
}

$conn->close();
?>
