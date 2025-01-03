<!DOCTYPE html>
<html>

<?php 
include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" type="text/css" media="screen" href="bookingconfirm.css" />
    <link rel="icon" href="images/logo.png" type="image/x-icon">
</head>

<body>

<?php
$type = isset($_POST['radio']) ? $_POST['radio'] : null;
$charge_type = isset($_POST['radio1']) ? $_POST['radio1'] : null;
$customer_username = $_SESSION["login_customer"];
$car_id = $conn->real_escape_string($_POST['hidden_carid']);
$rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
$rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
$return_status = "NR"; 
$fare = "NA";

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$err_date = dateDiff("$rent_start_date", "$rent_end_date");

$sql0 = "SELECT * FROM cars WHERE car_id = '$car_id'";
$result0 = $conn->query($sql0);

if (mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)) {
        $car_name = $row0["car_name"];
        $car_nameplate = $row0["car_nameplate"];

        if($type == "ac" && $charge_type == "km"){
            $fare = $row0["ac_price"];
        } else if ($type == "ac" && $charge_type == "days"){
            $fare = $row0["ac_price_per_day"];
        } else if ($type == "non_ac" && $charge_type == "km"){
            $fare = $row0["non_ac_price"];
        } else if ($type == "non_ac" && $charge_type == "days"){
            $fare = $row0["non_ac_price_per_day"];
        } else {
            $fare = "NA";
        }
    }
}

if($err_date >= 0) { 
    $sql1 = "INSERT into rentedcars(customer_username, car_id, booking_date, rent_start_date, rent_end_date, fare, charge_type, return_status) 
    VALUES('" . $customer_username . "','" . $car_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" . $charge_type . "','" . $return_status . "')";
    
    $result1 = $conn->query($sql1);

    if (!$result1) {
        die("Couldn't enter data into rentedcars: " . $conn->error);
    }

    $id = mysqli_insert_id($conn);
    
    $checkColumnQuery = "SHOW COLUMNS FROM cars LIKE 'available'";
    $checkColumnResult = $conn->query($checkColumnQuery);

    if ($checkColumnResult && mysqli_num_rows($checkColumnResult) > 0) {
        $sql2 = "UPDATE cars SET available = 'no' WHERE car_id = '$car_id'";
        $result2 = $conn->query($sql2);
        
        if (!$result2) {
            die("Couldn't update car available: " . $conn->error);
        }
    } else {
        $addColumnQuery = "ALTER TABLE cars ADD available ENUM('yes', 'no') DEFAULT 'yes'";
        if (!$conn->query($addColumnQuery)) {
            die("Couldn't add available column: " . $conn->error);
        }
        $sql2 = "UPDATE cars SET available = 'no' WHERE car_id = '$car_id'";
        if (!$conn->query($sql2)) {
            die("Couldn't update car available after adding the column: " . $conn->error);
        }
    }
?>

<div class="container">
    <div class="invoice">
        <header>
            <h1>Car Rental System</h1>
            <h2>Booking Confirmation</h2>
            <p>Date: 
                <?php echo date("Y-m-d"); ?>
            </p>
            <p>Order Number: <span class="order-number"><?php echo "$id"; ?></span></p>
        </header>

        <div class="details">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> 
            <?php echo $customer_username; ?>
            </p>
        </div>

        <div class="car-details">
            <h3>Vehicle Details</h3>
            <p><strong>Vehicle Name:</strong> 
            <?php echo $car_name; ?>
            </p>
            <p><strong>Vehicle Number:</strong> 
            <?php echo $car_nameplate; ?>
            </p>
            <?php if($charge_type == "days"){ ?>
                <p><strong>Fare:</strong> Rs. 
                <?php echo $fare; ?>
                /day</p>
            <?php } else { ?>
                <p><strong>Fare:</strong> Rs. 
                <?php echo $fare; ?>/km
                </p>
            <?php } ?>
        </div>

        <div class="booking-info">
            <h3>Booking Information</h3>
            <p><strong>Booking Date:</strong> 
            <?php echo date("Y-m-d"); ?>
            </p>
            <p><strong>Start Date:</strong> 
            <?php echo $rent_start_date; ?>
            </p>
            <p><strong>Return Date:</strong> 
            <?php echo $rent_end_date; ?>
            </p>
        </div>
        
        <div class="button-container">
            <a href="myorder.php" class="btn">My Orders</a>
            <a href="index.php" class="btn">Back to Home</a>
        </div>

        <footer>
            <p>Thank you for choosing our service. We wish you a safe journey!</p>
        </footer>
    </div>
</div>
<?php } ?>

</body>
</html>
