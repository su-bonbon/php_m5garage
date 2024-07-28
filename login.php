<?php
    session_start(); // Start the session
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'cs4347');
    if($conn->connect_error) {
        echo "<h2>Connection failed</h2>";  // added semicolon and corrected message
        die('Connection Failed : '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM Employee WHERE email = ?");
        $stmt->bind_param("s", $email);  // Bind the parameter $email to the placeholder
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();

            if($data['employeeID'] === (int)$password) {
                //echo "<h2>Login successful</h2>";  // Corrected message
                $_SESSION['fname'] = $data['fname'];
                $_SESSION['employeeID'] = $data['employeeID'];
                header("Location: main.php");
            } else {                
                header("Location: relogin.html");
            }
        } else {
            header("Location: relogin.html");
        }
    }
?>    
