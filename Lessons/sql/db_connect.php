<?php

    $servername = "localhost";
    $username = "membs";
    $password = "Password";
    $dname = "membs";

    //create connection
    $conn = new mysqli($servername, $username, $password, $dname);

    //check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>