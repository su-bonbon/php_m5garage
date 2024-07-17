<?php
    session_start(); // Start the session
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'cs4347');
    if($conn->connect_error) {
        echo "<h2>Connection failed</h2>";  // Added semicolon and corrected message
        die('Connection Failed : '.$conn->connect_error);
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM Employee WHERE email = ?");
        $stmt->bind_param("s", $email);  // Bind the parameter $email to the placeholder

        // Execute the prepared statement
        $stmt->execute();

        // Get the result set from the prepared statement
        $stmt_result = $stmt->get_result();

        // Check if there is at least one row returned
        if($stmt_result->num_rows > 0) {
            // Fetch the data from the result set
            $data = $stmt_result->fetch_assoc();

            // Verify the password - You should use a secure way to store and compare passwords
            // For simplicity here, assuming plaintext comparison (not recommended for production)
            if($data['employeeID'] === (int)$password) {
                //echo "<h2>Login successful</h2>";  // Corrected message
                // Redirect to another page or perform other actions
                $_SESSION['fname'] = $data['fname'];
                $_SESSION['employeeID'] = $data['employeeID'];
                header("Location: main.php");
            } else {                
                header("Location: relogin.html");
            }
        } else {
            header("Location: relogin.html");
            //echo "<h2>Incorrect id or failed to login</h2>";  // Corrected message
        }
    }
?>    
