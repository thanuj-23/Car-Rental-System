<?php
session_start();
include('session_customer.php');
include('connection.php');

if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
    exit;
}

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];


    $sql = "SELECT * FROM rentedcars WHERE id = '$orderId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        die("Order not found.");
    }
} else {
    die("No order ID provided.");
}


$sqlCarTypes = "SELECT * FROM cars"; 
$carTypesResult = $conn->query($sqlCarTypes);
$carTypes = [];
if ($carTypesResult->num_rows > 0) {
    while ($row = $carTypesResult->fetch_assoc()) {
        $carTypes[] = $row;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rent_start_date = isset($_POST['rent_start_date']) ? $_POST['rent_start_date'] : '';
    $rent_end_date = isset($_POST['rent_end_date']) ? $_POST['rent_end_date'] : '';
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : '';


    if (!empty($rent_start_date) && !empty($rent_end_date) && !empty($car_id)) {
 
        $sqlUpdate = "UPDATE rentedcars SET rent_start_date='$rent_start_date', rent_end_date='$rent_end_date', car_id='$car_id' WHERE id='$orderId'";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo "<script>alert('Order updated successfully.'); window.location.href='myorder.php';</script>";
        } else {
            echo "Error updating order: " . $conn->error;
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Order</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 20px auto;
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
            display: block;
            margin: 10px 0 5px;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
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
    <h1>Update Order</h1>
    <form action="update_order.php?id=<?php echo $orderId; ?>" method="POST">
        <label for="car_id">Select Car Type:</label>
        <select name="car_id" required>
            <option value="">Select a car</option>
            <?php foreach ($carTypes as $car) : ?>
                <option value="<?php echo $car['car_id']; ?>" <?php echo ($car['car_id'] == $order['car_id']) ? 'selected' : ''; ?>>
                    <?php echo $car['car_name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="rent_start_date">Start Date:</label>
        <input type="date" name="rent_start_date" value="<?php echo isset($order['rent_start_date']) ? $order['rent_start_date'] : ''; ?>" required>

        <label for="rent_end_date">End Date:</label>
        <input type="date" name="rent_end_date" value="<?php echo isset($order['rent_end_date']) ? $order['rent_end_date'] : ''; ?>" required>

        <button type="submit">Update Order</button>
    </form>
</div>

</body>
</html>
