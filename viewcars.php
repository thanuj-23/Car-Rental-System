<?php
session_start();
if(!isset($_SESSION['login_client'])) {
    header("location: clientlogin.php"); // Redirect to login page if not logged in
}

require 'connection.php';
$conn = Connect();
?>

<html>
  <head>
    <title>Car List | Car Rentals</title>
  </head>

  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <body>
    <div class="container">
      <h2>Available Cars</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Car Image</th>
            <th>Car Name</th>
            <th>Car Nameplate</th>
            <th>AC Price per KM</th>
            <th>Non-AC Price per KM</th>
            <th>AC Price per Day</th>
            <th>Non-AC Price per Day</th>
            <th>Availability</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM cars";
          $result = $conn->query($query);

          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td><img src='" . $row['car_img'] . "' width='100'></td>";
              echo "<td>" . $row['car_name'] . "</td>";
              echo "<td>" . $row['car_nameplate'] . "</td>";
              echo "<td>" . $row['ac_price'] . "</td>";
              echo "<td>" . $row['non_ac_price'] . "</td>";
              echo "<td>" . $row['ac_price_per_day'] . "</td>";
              echo "<td>" . $row['non_ac_price_per_day'] . "</td>";
              echo "<td>" . $row['available'] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='8'>No Cars Found</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

  </body>
</html>
