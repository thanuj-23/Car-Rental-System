<?php 
session_start();
include('session_customer.php');
include('connection.php');

if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}

$customer_username = $_SESSION['login_customer'];

$sql = "SELECT r.*, c.car_name, c.car_id 
        FROM rentedcars AS r 
        JOIN cars AS c ON r.car_id = c.car_id 
        WHERE r.customer_username = '$customer_username'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css"> 
    <title>My Orders</title>
    <style>
        .container {
            width: 80%;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: green;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px;
        }

        .btn:hover {
            background-color: darkgreen;
        }

        .btn.disabled {
            background-color: grey;
            cursor: not-allowed;
        }

        .btn.disabled:hover {
            background-color: grey;
        }

        .actions {
            display: flex;
            justify-content: flex-start;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php" class="logo">
        <img src="images/logo.png" alt="Logo">
    </a>
    <ul id="mainmenu">
        <li><a href="index.php" class="menu-item">Home</a></li>
        <li><a href="cars.php" class="menu-item">Cars</a></li>
        <li><a href="booking.php" class="menu-item">Booking</a></li>
        <li class="dropdown">
            <a href="#" class="menu-item">My Account</a>
            <ul class="dropdown-content">
                <li><a href="myprofile.php" class="menu-item">My Profile</a></li>
                <li><a href="myorder.php" class="menu-item">My Orders</a></li>
                <li><a href="entercar.php" class="menu-item">Add New</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-item">Pages</a>
            <ul class="dropdown-content">
                    <li><a href="about.php" class="menu-item">About Us</a></li>
                    <li><a href="contactus.php" class="menu-item">Contact</a></li>
                    <li><a href="contact.php" class="menu-item">Feedbacks</a></li>
                </ul>
        </li>
    </ul>

    <div class="auth-buttons">
        <?php
        if (isset($_SESSION['login_customer']) || isset($_SESSION['login_client'])) {
            echo '<a href="logout.php" class="register-btn">Logout</a>';
        } else {
            echo '<a href="customerlogin.php" class="sign-in-btn">Sign In</a>';
            echo '<a href="customersignup.php" class="register-btn">Register</a>';
        }
        ?>
    </div>
</header>

<section class="banner" style="background-image:url('images/e1.jpg');">
</section>
<script>
        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
<div class="container">
    <h1>My Orders</h1>
    <table>
        <th>
            <tr>
                <th>Order Number</th>
                <th>Vehicle Name</th>
                <th>Booking Date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </th>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $orderId = $row['id'];
                    $carName = $row['car_name'];
                    $bookingDate = $row['booking_date'];
                    $rentStartDate = $row['rent_start_date'];
                    $rentEndDate = $row['rent_end_date'];
                    $returnStatus = $row['return_status'];

                    echo "<tr>
                        <td>{$orderId}</td>
                        <td>{$carName}</td>
                        <td>{$bookingDate}</td>
                        <td>{$rentStartDate}</td>
                        <td>{$rentEndDate}</td>
                        <td>{$returnStatus}</td>
                        <td class='actions'>";

                    if ($returnStatus != 'completed' && $returnStatus != 'returned') {
                        echo "<a href='update_order.php?id={$orderId}' class='btn'>Update</a>
                              <a href='return_order.php?id={$orderId}&car_id={$row['car_id']}' class='btn'>Cancel</a>
                              <a href='complete_order.php?id={$orderId}' class='btn'>Complete</a>";
                    } else {
                        echo "<span class='btn disabled'>Completed</span>
                              <span class='btn disabled'>Returned</span>";
                    }
                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
