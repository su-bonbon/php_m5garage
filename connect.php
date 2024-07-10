<?php
    $id = $_POST['id'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $conn = new mysqli('localhost', 'root','','test');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into signup(id, password, fname, lname, mobile, address) values(?,?,?,?,?,?)");
        $stmt->bind-param("ssssss", $id, $password, $fname, $lname, $mobile, $address);
        $stmt->execute();
        echo "sign-up completed"
        $stmt->close();
        $conn->close();
    }
?>