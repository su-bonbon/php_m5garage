<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
session_start();
phpinfo();
// Get employeeID from session
$employeeID = $_SESSION['employeeID'];

// Get data from POST request
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phoneNum = $_POST['phoneNum'];

$conn->set_charset("utf8mb4"); // Add this line to set the charset

$query = "UPDATE Employee SET email='$email', fname='$fname', lname='$lname', phoneNum='$phoneNum' WHERE employeeID='$employeeID'";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    // Output success message and redirect
    echo("Injection Success.");
} else {
    // Output failure message and redirect
    echo("Injection Failed.");
}

$conn->close();
?>