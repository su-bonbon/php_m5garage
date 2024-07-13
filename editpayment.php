<?php
include "connection.php";



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['paymentID'])) {
        header("location:payment.php");
        exit;
    }
    
    $paymentID = $_GET['paymentID'];
    
    // Use prepared statements
    $stmt = $conn->prepare("SELECT * FROM Payment WHERE paymentID = ?");
    $stmt->bind_param("s", $paymentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        header("location:inventory.php");
        exit;
    }
    
    $row = $result->fetch_assoc();
    $paymentDate = $row["paymentDate"];
    $amount = $row["amount"];
    
    $stmt->close();
} else {
    // Process the form submission
    $paymentID = $_POST["paymentID"];
    $paymentDate = $_POST["paymentDate"];
    $amount = $_POST["amount"];
    
    // Use prepared statements for updates as well
    $stmt = $conn->prepare("UPDATE Payment SET paymentDate = ?, amount = ? WHERE paymentID = ?");
    $stmt->bind_param("sdi", $paymentDate, $amount, $paymentID);
    $stmt->execute();
    
    // Check for success
    if ($stmt->affected_rows > 0) {
        $success = "Payment updated successfully.";
    } else {
        $error = "Error updating Payment.";
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


<div class="updatepayment w-100 h-100">
<div class="col-lg-6 m-auto updatecarcard">
 



<form method="post">
    <br><br>
    <div class="card carcard">
        <div class="card-header">
            <h1 class="text-black text-center">Update Payment</h1>
        </div><br>

        <input type="hidden" name="paymentID" value="<?php echo $paymentID; ?>" class="form-control"> <br>

        <label>Payment Date:</label>
        <input type="text" name="paymentDate" value="<?php echo $paymentDate; ?>" class="form-control"> <br>

        <label>Amount($):</label>
        <input type="text" name="amount" value="<?php echo $amount; ?>" class="form-control"> <br>


        
        <button class="btn btn-black" type="submit" name="submit">Submit</button><br>
        <a class="btn btn-black" href="payment.php">Cancel</a><br>

        <?php if ($success) { ?>
            <p class="text-success"><?php echo $success; ?></p>
        <?php } ?>
    </div>
</form>




</div>
</div>






</body>
</html>