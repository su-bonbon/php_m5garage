<?php
// Include database connection file
include_once 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Assuming $conn is already initialized and connected in connection.php

// Main script logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs (vulnerable to SQL injection)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Construct SQL query with user inputs directly concatenated (vulnerable)
    $query = "SELECT * FROM Employee WHERE email = '$email' AND employeeID = '$password'";
    
    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if any rows were returned to determine success
    if ($result && mysqli_num_rows($result) > 0) {
        // Output success message
        header("Location: main.php");
    } else {
        // Output failure message
        header("Location: edituser1.html");
    }

    // Close the MySQLi result and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    exit; // Terminate script execution after echoing result
}
?>
