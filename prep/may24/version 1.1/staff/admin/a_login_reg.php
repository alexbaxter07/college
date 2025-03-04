<?php
// page to validate the information from admin login and will grant privledges

    try{ // try except to catch any errors

        session_start(); //session start so that the page can connect to session data

        include("../../db_connect.php");
        include("a_functions.php");
        include("../../functions.php");

        $username = $_POST['uname'];

        $sql = "SELECT password, privilege FROM admin_user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){ // if user existes with given details

            if(password_verify($_POST['password'], $result['password'])){ // if password match database

                //creation of session variables
                $_SESSION["admin_login"] = true;
                $_SESSION["username"] = $_POST['uname'];
                $_SESSION["level"] = $result['privilege'];

                // send to admin index
                header("location: a_index.php");

                exit();

            }else{

                session_destroy(); // if failed kills session

                header("refresh:4; location: a_login.php"); //send back to login

                echo "<link rel='stylesheet' href='admin_styles.css' type='css'>"; // link sylesheet

                echo "Wrong password"; //error message

            }

        }else{

            header("refresh:4; location: a_login.php"); // send back to login

            echo "<link rel='stylesheet' href='admin_styles.css' type='css'>"; //link to stylesheet

            echo "User not found"; // error message

        }

    }catch(Exception $e){ //gets error

        echo $e; // ouputs error message

    }

?>