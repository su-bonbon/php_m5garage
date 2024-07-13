<?php
include "connection.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['vinNum'])) {
    $vinNum = $_GET['vinNum'];

    $stmt = $conn->prepare("DELETE FROM Car WHERE vinNum = ?");
    $stmt->bind_param("s", $vinNum);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $success = "Car deleted successfully.";
    } else {
        $error = "Error deleting car.";
    }
    $stmt->close();
}
$conn->close();
header('Location: inventory.php');
exit;
?>