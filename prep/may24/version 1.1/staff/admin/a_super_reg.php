<?php
// validates the super user info

    session_start();

    include("../../db_connect.php");
    include("../../functions.php");
    include("a_functions.php");

    if (super_checker($conn)) {  // calls function in a_functions to check if superuser exists.
        $_SESSION['ERROR'] = "ADMIN ALREADY EXISTS, LOGIN or ASK FOR to be registered";  // sets the error session variable to be read out by the next page
        header('location: admin_login.php');  // redirects to the needed new page.
        exit;
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){  // if superuser doesn't exist and posted to this page
        try {
            if(reg_admin($conn, $_POST) && auditor($conn, $_POST['username'], "SUPERREG", "SUPER USER REGISTERED")) { // Assuming $conn is your database connection
                $_SESSION['SUCCESS'] = "ADMIN REGISTERED";
                header("Location: admin_login.php");
                exit; // Stop further execution
            } else {
                $_SESSION['ERROR'] = "SUPER FAIL, UNKNOWN ERROR";
                header("Location: a_index.php");
                exit; // Stop further execution
            }
        }
        catch(Exception $e) {
            // Handle database error within reg_admin or here.
            $_SESSION['ERROR'] = "SUPER REG ERROR: ". $e->getMessage();
            header("Location: a_index.php");
            exit; // Stop further execution
        }
    }
