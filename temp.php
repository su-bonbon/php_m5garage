<?php
include "connection.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['paymentID'])) {
    $paymentID = $_GET['paymentID'];

    $stmt = $conn->prepare("DELETE FROM Payment WHERE paymentID = ?");
    $stmt->bind_param("i", $paymentID);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $success = "Payment deleted successfully.";
    } else {
        $error = "Error deleting Payment.";
    }
    $stmt->close();
}
$conn->close();
header('Location: payment.php');
exit;
?>
