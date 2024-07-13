<?php
include "connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['vinNum'])) {
        header("location:main.php");
        exit;
    }
    
    $vinNum = $_GET['vinNum'];
    
    // Use prepared statements
    $stmt = $conn->prepare("SELECT * FROM Car WHERE vinNum = ?");
    $stmt->bind_param("s", $vinNum);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        header("location:inventory.php");
        exit;
    }
    
    $row = $result->fetch_assoc();
    $make = $row["make"];
    $model = $row["model"];
    $year = $row["year"];
    
    $stmt->close();
} else {
    // Process the form submission
    $vinNum = $_POST["vinNum"];
    $make = $_POST["make"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    
    // Use prepared statements for updates as well
    $stmt = $conn->prepare("UPDATE Car SET make = ?, model = ?, year = ? WHERE vinNum = ?");
    $stmt->bind_param("ssds", $make, $model, $year, $vinNum);
    $stmt->execute();
    
    // Check for success
    if ($stmt->affected_rows > 0) {
        $success = "Car updated successfully.";
    } else {
        $error = "Error updating car.";
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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


<div class="updatecar w-100 h-100">
<div class="col-lg-6 m-auto updatecarcard">
 



<form method="post">
    <br><br>
    <div class="card carcard">
        <div class="card-header">
            <h1 class="text-black text-center">Update Car</h1>
        </div><br>

        <input type="hidden" name="vinNum" value="<?php echo $vinNum; ?>" class="form-control"> <br>

        <label>Make:</label>
        <input type="text" name="make" value="<?php echo $make; ?>" class="form-control"> <br>

        <label>Model:</label>
        <input type="text" name="model" value="<?php echo $model; ?>" class="form-control"> <br>

        <label>Year:</label>
        <input type="text" name="year" value="<?php echo $year; ?>" class="form-control"> <br>

        <button class="btn btn-black" type="submit" name="submit">Submit</button><br>
        <a class="btn btn-black" href="inventory.php">Cancel</a><br>

        <?php if ($success) { ?>
            <p class="text-success"><?php echo $success; ?></p>
        <?php } ?>
    </div>
</form>




</div>
</div>






</body>
</html>