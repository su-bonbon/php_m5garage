<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
session_start();

// Get employeeID from session
$employeeID = $_SESSION['employeeID'];

// Get data from POST request
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phoneNum = $_POST['phoneNum'];

// Vulnerable query (directly interpolates user inputs)
$query = "UPDATE Employee SET email=$email, fname=$fname, lname=$lname, phoneNum=$phoneNum WHERE employeeID=$employeeID";
$result = mysqli_query($conn, $query);

// Check if query was successful
if ($result) {
    // Output success message and redirect
    header("Location: edituser.php?success=1");
} else {
    // Output failure message and redirect
    header("Location: edituser2.html?error=1");
}

$conn->close();
?>