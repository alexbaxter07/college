<?php

    include '../db_connect.php';

    $position = $_POST['position'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql= 'SELECT * FROM ? WHERE email = ? AND password = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$position);
    $stmt->bind_param(2, $email);
    $stmt->bind_param(3, $pass);
    $stmt->execute();
    $row = $stmt->fetch();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $rpswd = $result["Password"];

    if (password_verify($pass, $rpswd)) {

        header("refresh:1; url=../student/stu_homepage.php");
        echo "you are now logged in! Heading to your homepage";

    } else {

        header("refresh:1; url=../login/login.html");
        echo "Password is incorrect";

    }
?>