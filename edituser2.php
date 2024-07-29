<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
session_start();
phpinfo();
$employeeID = $_SESSION['employeeID'];

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phoneNum = $_POST['phoneNum'];

$conn->set_charset("utf8mb4"); // Add this line to set the charset

$query = "UPDATE Employee SET email='$email', fname='$fname', lname='$lname', phoneNum='$phoneNum' WHERE employeeID='$employeeID'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo("Injection Success.");
} else {
    echo("Injection Failed.");
}

$conn->close();
?>