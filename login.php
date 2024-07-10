<?php
    $id = $_POST['id'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root','','test');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("select * from Employee where id = ?");
        $stmt->bind-param("s", $id);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if(get_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password) {
                echo "<h2>incorrect password</h2>"  // localhost/connection.php will direct you to diff page
            } else {
                echo "<h2>incorrect id or password</h2>"
            }
        } else {
            echo "<h2>failed to login</h2>"
        }
    }
?>