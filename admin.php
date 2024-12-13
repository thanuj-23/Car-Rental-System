<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "carrental"; 

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <style>
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
        </style>
</head>
<body>
        
        <nav>
        <div>
            <a href="index.php">&it;Back to Home</a>
            <a href="logout.php">Logout</a>
       
        </div>
    </nav>
    <div class="container">

        <section class="form-section">
            <div class="form-container">
                <h2>Enter Client's Details</h2>

                <form action="insert_client.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="client_username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="client_name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="client_phone" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="client_email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="client_address" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="client_password" placeholder="Password" required>
                    </div>
                    <button type="submit">Create Account</button>
                </form>
            </div>
        </section>

        <section class="cars-section">
            <h2>Registered Clients</h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
    
                    $sql = "SELECT client_username, client_name, client_phone, client_email, client_address FROM client";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['client_username'] . "</td>
                                    <td>" . $row['client_name'] . "</td>
                                    <td>" . $row['client_phone'] . "</td>
                                    <td>" . $row['client_email'] . "</td>
                                    <td>" . $row['client_address'] . "</td>
                                    <td>
                                        <button class='edit' onclick=\"openModal('".$row['client_username']."', '".$row['client_name']."', '".$row['client_phone']."', '".$row['client_email']."', '".$row['client_address']."')\">EDIT</button>
                                        <button class='delete' onclick=\"deleteClient('".$row['client_username']."')\">DELETE</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No clients found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

    </div>


    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Client Details</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">


                <form id="editForm" action="update_client.php" method="POST">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="clientId" name="client_username" required readonly>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="editFirstName" name="client_name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" id="editContactNumber" name="client_phone" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="editEmail" name="client_email" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="editAddress" name="client_address" required>
                    </div>
                    <button type="submit">Update Account</button>
                </form>
            </div>
        </div>
    </div>

    <script>
  
        function openModal(username, name, phone, email, address) {
            document.getElementById('clientId').value = username;
            document.getElementById('editFirstName').value = name;
            document.getElementById('editContactNumber').value = phone;
            document.getElementById('editEmail').value = email;
            document.getElementById('editAddress').value = address;
            document.getElementById('editModal').style.display = 'block';
        }


        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }


        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                closeModal();
            }
        }

        function deleteClient(client_id) {
           
            if (confirm("Are you sure you want to delete this client?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_client.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload(); 
                    }
                };
                xhr.send("client_id=" + client_id);
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
