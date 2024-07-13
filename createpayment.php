<?php
include_once 'connection.php';

// prepare and bind
$stmt = $conn->prepare("INSERT INTO Payment (paymentID, amount, paymentDate) VALUES (?, ?, NOW())");
$stmt->bind_param("id", $paymentID, $amount);

// set parameters
$paymentID = $_POST['paymentID'];
$amount = $_POST['amount'];

try {
    $stmt->execute();
    header("Location: payment.php");
    exit;
} catch (mysqli_sql_exception $e) {
    $error = "Error creating payment: " . $e->getMessage();
    header("Location: trycreatepayment.html?error=$error");
    exit;
}

$stmt->close();
$conn->close();
?>