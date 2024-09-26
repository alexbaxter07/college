<?php

    include 'db_connect.php';

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];

    $sql = "SELECT Password FROM mem WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$Usern);
    $stmt->execute();

    $result = $stmt ->fetch(PDO::FETCH_ASSOC);
    $password = $result["Password"];

    if ($result) {
        header("refresh:5; url=index.html");
        echo "User not found. Please Sign Up";
    }elseif (password_verify($pswd, $password)) {
        echo "you are now logged in";
    }else{
        header("refresh:5; url=login.html");
        echo "Passwords do not match. please try again";
    }
?>