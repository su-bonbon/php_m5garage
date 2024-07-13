<?php
include_once 'connection.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO Employee (fName, lName, email, phoneNum, employeeID) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssd", $fName, $lName, $email, $phoneNum, $employeeID);

// set parameters and execute
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$phoneNum = $_POST['phoneNum'];
$employeeID = $_POST['employeeID'];


try {
    $stmt->execute();
    header("Location: trylogin.php");
    exit;
} catch (mysqli_sql_exception $e) {
    $error = "Error creating car: " . $e->getMessage();
    header("Location: trysignin.html?error=$error");
    exit;
}

$stmt->close();
$conn->close();
?>