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


        } catch (PDOException $e) {

            header("refresh:4; location: a_login.php");
            echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
            echo "password related issue";

        }

    }

?>