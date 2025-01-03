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

        /* Table Styles */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

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
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <div>
            <a href="index.php">&it;Back to Home</a>
            <?php if(isset($_SESSION['login_client'])) { ?> 
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="clientlogin.php">Employee</a>
            <?php } ?>
        </div>
    </nav>

    <div class="container">
        <div class="form-area">
            <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
                <h3>Please Provide Your Car Details</h3>

                <div class="form-group">
                    <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Car Name" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" placeholder="Vehicle Number Plate" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="ac_price" name="ac_price" placeholder="AC Fare per KM (Rs)" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="non_ac_price" name="non_ac_price" placeholder="Non-AC Fare per KM (Rs)" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="ac_price_per_day" name="ac_price_per_day" placeholder="AC Fare per day (Rs)" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="non_ac_price_per_day" name="non_ac_price_per_day" placeholder="Non-AC Fare per day (Rs)" required>
                </div>

                <div class="form-group">
                    <input name="uploadedimage" type="file" class="form-control">
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">Submit for Rental</button>    
            </form>
        </div>

        <!-- Display Success Message -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
            <div class="alert alert-success">Car details updated successfully!</div>
        <?php } ?>

        <div class="form-area" style="padding: 20px;">
            <form action="" method="POST">
                <h3>My Cars</h3>
                <?php
                $user_check = $_SESSION['login_client'];
                $sql = "SELECT * FROM cars WHERE car_id IN (SELECT car_id FROM clientcars WHERE client_username='$user_check');";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Nameplate</th>
                                <th>AC Fare (/km)</th>
                                <th>Non-AC Fare (/km)</th>
                                <th>AC Fare (/day)</th>
                                <th>Non-AC Fare (/day)</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td>
                                    <form action="editcar.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="car_id" value="<?php echo $row['car_id']; ?>">
                                        <button type="submit" class="btn btn-success" style="font-size: 12px;">
                                            Edit
                                        </button>
                                    </form>
                                    <form action="deletecar.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="car_id" value="<?php echo $row['car_id']; ?>">
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px;" onclick="return confirm('Are you sure you want to delete this car?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td><?php echo $row["car_name"]; ?></td>
                                <td><?php echo $row["car_nameplate"]; ?></td>
                                <td><?php echo $row["ac_price"]; ?></td>
                                <td><?php echo $row["non_ac_price"]; ?></td>
                                <td><?php echo $row["ac_price_per_day"]; ?></td>
                                <td><?php echo $row["non_ac_price_per_day"]; ?></td>
                                <td><?php echo isset($row["availabile"]) ? $row["availabile"] : 'N/A'; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h4><center>No Cars available</center></h4>
                <?php } ?>
            </form>
        </div>
    </div>
</body>
</html>
