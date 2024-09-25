<?php

    include 'db_connect.php';

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];

    $stmt = $conn->prepare("SELECT Password FROM mem WHERE UserName = 'Uname'");
    $stmt->bind_param("s", $Usern);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt == false) {
        header("refresh:5; url=index.html");
        echo "User not found. Please Sign Up";
    }elseif (password_verify($pswd, $stmt)) {
        echo "you are now logged in";
    }else{
        header("refresh:5; url=login.html");
        echo "Passwords do not match. please try again";
    }
?>