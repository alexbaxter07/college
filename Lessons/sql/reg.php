<?php

    include "db_connect.php";

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $email = $_POST['email'];

    $sql = "INSERT INTO mem(Username, Password, Fname, Sname, Email)VAlUES(?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssss', $Usern, $pswd, $fname, $sname, $email);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_error($stmt)){
        echo"Error: " . mysqli_stmt_error($stmt);
    }else{
        echo"Records created successfully";
    }

?>