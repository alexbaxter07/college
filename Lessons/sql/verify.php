<?php

    include 'db_connect.php';

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];
    $cpaswd = $_POST['CPassword'];

    $sql = "SELECT * FROM `membs` WHERE UserName = '$Usern'";

    if ($sql == false) {
        header("refresh:5; url=index.html");
        echo "User not found. Please Sign Up";
    }elseif ($pswd <> $cpaswd ){
        header("refresh:5; url=login.html");
        echo "Passwords do not match. please try again";
    }else{
        echo "You are now logged in";
    }
?>