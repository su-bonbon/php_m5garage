<?php
include_once 'connection.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO Car (vinNum, make, model, year) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $vinNum, $make, $model, $year );

// set parameters
$vinNum = $_POST['vinNum'];
$make = $_POST['make'];
$model = $_POST['model'];
$year = $_POST['year'];

try {
    $stmt->execute();
    header("Location: inventory.php");
    exit;
} catch (mysqli_sql_exception $e) {
    $error = "Error creating car: " . $e->getMessage();
    header("Location: trycreatecar.html?error=$error");
    exit;
}

$stmt->close();
$conn->close();
?>