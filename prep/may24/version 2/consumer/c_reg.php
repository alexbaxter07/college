<?php

    // Start session to use session variables across pages
    session_start();

    //includes the database connection so that we can get information into the database
    include("../db_connect.php");

    $username = $_POST['uname'];
    $password = $_POST['password'];
    $c_password = $_POST['cpassword'];
    $email = $_POST['email'];
    $f_name = $_POST['fname'];
    $l_name = $_POST['sname'];

    //check if inputted passwords by user match
    if ($password != $c_password) {

        //redirects to signup as passwords do not mach
        header("Location: c_signup.php");
        echo "Passwords do not match";

    }else{




        $sql = "Insert into user(user_name, first_name, last_name, password, user_type_id, signup_date) values (?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $f_name);
        $stmt->bindParam(3, $l_name);
        $stmt->bindParam(4, $password);
        $stmt->bindParam(5, $email);
        

    }

?>