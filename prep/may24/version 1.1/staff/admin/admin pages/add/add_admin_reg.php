<?php
// page to validate details of new admin and put the details into the database

    // gets both of the functions files for use
    include("../../a_functions.php");
    include("../../../../functions.php");
    include("../../../../db_connect.php");

    if($_POST['level']== "SUPER"and super_checker(dbconnect())){

        header("Refresh:4; URL=a_login.php");
        echo "<link rel='stylesheet' type='text/css' href='../../admin_styles.css'>";
        echo "Super Admin exists go login";

    }elseif ($_POST['password']!= $_POST['cpassword']){

        header("Refresh:4; URL=a_login.php");
        echo "<link rel='stylesheet' type='text/css' href='../../admin_styles.css'>";
        echo "password related issue";

    }else{

        try{

            //try this code
            $conn= dbconnect();
            $sql = "INSERT INTO admin_user (username, first_name,last_name, email, password, signup_date, priv) VALUES (?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1,$_POST['uname']);  //bind parameters for security
            $stmt->bindParam(2,$_POST['fname']);
            $stmt->bindParam(3,$_POST['sname']);
            $stmt->bindParam(4,$_POST['email']);
            $hpswd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(5,$hpswd); //hash the password
            $signup_date = time();
            $stmt->bindParam(6,$signup_date);
            $stmt->bindParam(7,$_POST['admin_type']);

            $stmt->execute();  //run the query to insert
            $admin_reg_type = strtolower($_POST['admin_type']) . "reg";
            $admin_reg_task = "Registration of a " . strtolower($_POST['admin_type']) . " admin user";
            auditor(dbconnect(),$_POST['username'], $admin_reg_type, $admin_reg_task);

            header("Refresh:5; URL=a_index.php"); //confirm and redirect
            echo "<link rel='stylesheet' href='../../admin_styles.css'>";
            echo "Successfully registered";

        } catch (PDOException $e) {

            header("Refresh:4; URL=a_login.php");
            echo "<link rel='stylesheet' type='text/css' href='../../admin_styles.css'>";
            echo $e -> getMessage();

        }

    }