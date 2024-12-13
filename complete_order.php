<?php 
session_start();
include('session_customer.php');
include('connection.php');

if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $feedback = $_POST['feedback'];

        $sql = "UPDATE rentedcars SET return_status = 'completed', feedback = '$feedback' WHERE id = '$orderId'";
        if ($conn->query($sql) === TRUE) {
            $carId = $_POST['car_id']; 
            $sqlUpdateCar = "UPDATE cars SET available = 'yes' WHERE car_id = '$carId'";
            if ($conn->query($sqlUpdateCar) === TRUE) {
                echo 
                "<script>alert('Thank you! Come again.'); window.location.href='myorder.php';
                </script>";
            } else {
                echo "Error updating car availability: " . $conn->error;
            }
        } else {
            echo "Error updating order: " . $conn->error;
        }
    }
    
    $sql = "SELECT * FROM rentedcars WHERE id = '$orderId'";
    $result = $conn->query($sql);
    $order = $result->fetch_assoc();
} else {
    die("No order ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> 
    <title>Complete Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            resize: none;
        }

        button {
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Complete Order</h1>
        <form action="complete_order.php?id=<?php echo $orderId; ?>" method="POST">
            <label for="feedback">Leave your feedback:</label>
            <textarea name="feedback" required></textarea>
            <input type="hidden" name="car_id" value="<?php echo $order['car_id']; ?>"> 
            <button type="submit">Complete Order</button>
        </form>
    </div>
</body>
</html>
