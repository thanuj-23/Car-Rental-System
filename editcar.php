<!DOCTYPE html>
<html>

<?php 
include('session_client.php');
include('connection.php'); 
?> 
<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" type="text/css" href="assets/css/clientpage.css" />
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Navigation Styles */
        nav {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Container Styles */
        .container {
            margin-top: 65px;
            padding: 20px;
        }

        .form-area {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 0 auto;
            max-width: 600px;
        }

        .form-area h3 {
            margin-bottom: 25px;
            text-align: center;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #28a745;
            outline: none;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Alert Styles */
        .alert {
            margin: 20px auto;
            text-align: center;
            padding: 15px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <div>
            <a href="index.php">Car Rentals</a>
            <?php if(isset($_SESSION['login_client'])) { ?> 
                <span>Welcome <?php echo $_SESSION['login_client']; ?></span>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="clientlogin.php">Employee</a>
            <?php } ?>
        </div>
    </nav>

    <div class="container">
        <div class="form-area">
            <form role="form" action="updatecar.php" method="POST">
                <h3>Edit Car Details</h3>

                <?php
                if (isset($_GET['car_id'])) {
                    $car_id = $_GET['car_id'];
                    $sql = "SELECT * FROM cars WHERE car_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $car_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $car = $result->fetch_assoc();
                    } else {
                        echo '<div class="alert alert-danger">No car found with that ID.</div>';
                        exit;
                    }
                    $stmt->close();
                } else {
                    echo '<div class="alert alert-danger">No car ID specified.</div>';
                    exit;
                }
                ?>

                <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">

                <div class="form-group">
                    <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Car Name" value="<?php echo $car['car_name']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" placeholder="Vehicle Number Plate" value="<?php echo $car['car_nameplate']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="ac_price" name="ac_price" placeholder="AC Fare per KM (Rs)" value="<?php echo $car['ac_price']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="non_ac_price" name="non_ac_price" placeholder="Non-AC Fare per KM (Rs)" value="<?php echo $car['non_ac_price']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="ac_price_per_day" name="ac_price_per_day" placeholder="AC Fare per day (Rs)" value="<?php echo $car['ac_price_per_day']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="non_ac_price_per_day" name="non_ac_price_per_day" placeholder="Non-AC Fare per day (Rs)" value="<?php echo $car['non_ac_price_per_day']; ?>" required>
                </div>

                <div class="form-group">
                    <input name="uploadedimage" type="file" class="form-control">
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-success">Update Car</button>    
            </form>
        </div>

        <!-- Display Success Message -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
            <div class="alert alert-success">Car details updated successfully!</div>
        <?php } ?>
    </div>

</body>
</html>
