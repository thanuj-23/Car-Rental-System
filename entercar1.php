<?php
session_start();
?>
<html>
<head>
    <title>Customer Signup | Car Rentals</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">Car Rentals</a>
            </div>

            <?php if (isset($_SESSION['login_client'])) { ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="entercar.php">Add Car</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            <?php } elseif (isset($_SESSION['login_customer'])) { ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </nav>

    <?php
    require 'connection.php';
    $conn = Connect();

    // Function to get image extension
    function GetImageExtension($imagetype) {
        if (empty($imagetype)) return false;
        switch ($imagetype) {
            case 'image/bmp': return '.bmp';
            case 'image/gif': return '.gif';
            case 'image/jpeg': return '.jpg';
            case 'image/png': return '.png';
            default: return false;
        }
    }

    // Ensure form data is present before processing
    if (isset($_POST['car_name']) && isset($_POST['car_nameplate']) && isset($_POST['ac_price']) && 
        isset($_POST['non_ac_price']) && isset($_POST['ac_price_per_day']) && isset($_POST['non_ac_price_per_day'])) {
      
        // Getting data from the form
        $car_name = $conn->real_escape_string($_POST['car_name']);
        $car_nameplate = $conn->real_escape_string($_POST['car_nameplate']);
        $ac_price = $conn->real_escape_string($_POST['ac_price']);
        $non_ac_price = $conn->real_escape_string($_POST['non_ac_price']);
        $ac_price_per_day = $conn->real_escape_string($_POST['ac_price_per_day']);
        $non_ac_price_per_day = $conn->real_escape_string($_POST['non_ac_price_per_day']);
        $available = "yes"; // Default availability

        // Check for duplicate car nameplate
        $check_query = "SELECT * FROM cars WHERE car_nameplate = '$car_nameplate'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Error: A car with this nameplate already exists.');</script>";
        } else {
            // File upload handling
            if (!empty($_FILES["uploadedimage"]["name"])) {
                $file_name = $_FILES["uploadedimage"]["name"];
                $temp_name = $_FILES["uploadedimage"]["tmp_name"];
                $imgtype = $_FILES["uploadedimage"]["type"];
                $ext = GetImageExtension($imgtype);
                $imagename = $_FILES["uploadedimage"]["name"];
                $target_path = "assets/img/cars/" . $imagename;

                // Ensure the directory exists
                if (!file_exists("assets/img/cars/")) {
                    mkdir("assets/img/cars/", 0777, true);
                }

                // Move the uploaded file to the target path
                if (move_uploaded_file($temp_name, $target_path)) {
                    // Insert the car details with image path
                    $query = "INSERT INTO cars (car_name, car_nameplate, car_img, ac_price, non_ac_price, ac_price_per_day, non_ac_price_per_day, available) 
                              VALUES ('$car_name', '$car_nameplate', '$target_path', '$ac_price', '$non_ac_price', '$ac_price_per_day', '$non_ac_price_per_day', '$available')";

                    if ($conn->query($query) === TRUE) {
                        // Get car_id from the cars table
                        $query1 = "SELECT car_id FROM cars WHERE car_nameplate = '$car_nameplate'";
                        $result = mysqli_query($conn, $query1);
                        $rs = mysqli_fetch_array($result, MYSQLI_BOTH);
                        $car_id = $rs['car_id'];

                        // Check if client exists before inserting into clientcars
                        $client_username = $_SESSION['login_client'];
                        $client_check_query = "SELECT * FROM client WHERE client_username = '$client_username'";
                        $client_check_result = mysqli_query($conn, $client_check_query);

                        if (mysqli_num_rows($client_check_result) > 0) {
                            // Insert into clientcars table
                            $query2 = "INSERT INTO clientcars (car_id, client_username) VALUES ('$car_id', '$client_username')";
                            $conn->query($query2);

                            // Redirect after success
                            header("location: entercar.php");
                            exit; // Ensure no further code is executed after the redirect
                        } else {
                            // Error if client doesn't exist
                            echo "<script>alert('Error: Client does not exist in the system.');</script>";
                        }
                    } else {
                        // Error with car entry
                        echo "Error: " . $query . "<br>" . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Please select a file to upload.";
            }
        }
    } else {
        echo "Error: Missing required fields.";
    }

    $conn->close();
    ?>

</body>

<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© <?php echo date("Y"); ?> Car Rentals</h5>
            </div>
        </div>
    </div>
</footer>
</html>
