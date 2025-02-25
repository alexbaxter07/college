<?php
// page to validate details of new admin and put the details into the database

    // gets both of the functions files for use
    include("../../a_functions.php");
    include("../../a_functions.php");

    if($_POST['level']== "SUPER"and super_checker()){

        header("refresh:4; location: a_login.php");
        echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
        echo "Super Admin exists go login";

    }elseif (password_check($_POST['password'], $_POST['cpassword'])!=true){

        header("refresh:4; location: a_login.php");
        echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
        echo "password related issue";

    }else{

        include("../../../../db_connect.php");

        try{

            //try this code

            $sql = "INSERT INTO admin_user (username, first_name,last_name, email, password, signup_date, privliledge) VALUES (?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1,$_POST['uname']);  //bind parameters for security
            $hpswd = password_hash($_POST['password'], PASSWORD_DEFAULT);  //hash the password
            $stmt->bindParam(2,$hpswd);
            $stmt->bindParam(3,$_POST['email']);
            $stmt->bindParam(4,$_POST['fname']);
            $stmt->bindParam(5,$_POST['sname']);
            $signup_date = time();
            $stmt->bindParam(6,$signup_date);
            $stmt->bindParam(7,$_POST['admin_type']);

            $stmt->execute();  //run the query to insert
            $admin_reg_type = strtolower($_POST['admin_type']) . "reg";
            $admin_reg_task = "Registration of a " . strtolower($_POST['admin_type']) . " admin user";
            auditor($_POST['username'], $admin_reg_type, $admin_reg_task);

            header("refresh:5; url=admin_login.php"); //confirm and redirect
            echo "<link rel='stylesheet' href='../../../../styles.css'>";
            echo "Successfully registered";

        } catch (PDOException $e) {

            header("refresh:4; location: a_login.php");
            echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
            echo "password related issue";

        }

    }

?>