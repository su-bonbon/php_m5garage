<?php
include_once 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Employee WHERE email = '$email' AND employeeID = '$password'";
    
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        header("Location: main.php");
    } else {
        header("Location: edituser1.html");
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    exit; 
}
?>
