<?php
include "connection.php";
session_start();
$employeeID = $_SESSION['employeeID'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['employeeID'])) {
        header("location:main.php");
        exit;
    }
    
    $employeeID = $_GET['employeeID'];
    
    // Use prepared statements
    $stmt = $conn->prepare("SELECT * FROM Employee WHERE employeeID = ?");
    $stmt->bind_param("i", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        header("location:main.php");
        exit;
    }
    
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phoneNum = $row["phoneNum"];
    
    $stmt->close();
} else {
    // Process the form submission
    $employeeID = $_POST["employeeID"];
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phoneNum = $_POST["phoneNum"];
    
    // Use prepared statements for updates as well
    $stmt = $conn->prepare("UPDATE Employee SET email = ?, fname = ?, lname = ?, phoneNum = ? WHERE employeeID = ?");
    $stmt->bind_param("ssssi", $email, $fname, $lname, $phoneNum, $employeeID);
    $stmt->execute();
    
    // Check for success
    if ($stmt->affected_rows > 0) {
        $success = "User updated successfully.";
    } else {
        $error = "Error updating User.";
    }
    
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
 <title>M5Garage</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <!-- Logo on the left -->
      <a class="navbar-brand" href="main.php">
          <img src="img/logo.png" class="img-fluid logo-image" alt="Logo" style="max-width: 200px; height: auto;">
      </a>

      <!-- Navbar toggler button for responsive -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar after log-in links aligned to the right -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link"  href="inventory.php">Inventory</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="createcar.html">Create</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="payment.php">Payment</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="home.html">Sign Out</a>
              </li>
          </ul>
      </div>
  </div>
</nav>




<div class="edituser w-100 h-100">
    <br>
    <div class="btn-group assiddl">
        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Assignment #6 (SQL Injection)
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo 'edituser1.php?employeeID=' . $_SESSION['employeeID']; ?>">1. Vulnerable (POST)</a></li>
            <li><a class="dropdown-item" href="<?php echo 'edituser2.php?employeeID=' . $_SESSION['employeeID']; ?>">2. Vulnerable (UPDATE)</a></li>
            <li><a class="dropdown-item" href="<?php echo 'edituser.php?employeeID=' . $_SESSION['employeeID']; ?>">3. Prevent SQL Injection</a></li>
        </ul>
    </div>
<div class="col-lg-6 m-auto updatecarcard">

<form method="post">
    <br>
    <div class="card carcard">
        <div class="card-header">
            <h1 class="text-black text-center">Update User - Vulnerable (POST)</h1>
        </div>

        <input type="hidden" name="employeeID" value="<?php echo $employeeID; ?>" class="form-control"> <br>

        <label>E-mail:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" class="form-control"> <br>

        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control"> <br>

        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control"> <br>

        <label>Phone Number:</label>
        <input type="text" name="phoneNum" value="<?php echo $phoneNum; ?>" class="form-control"> <br>

        <button class="btn btn-black" type="submit" name="submit">Submit</button><br>
        <a class="btn btn-black" href="main.php">Cancel</a><br>

        <?php if ($success) { ?>
            <p class="text-success"><?php echo $success; ?></p>
        <?php } ?>
    </div>
</form>




</div>
</div>






</body>
</html>