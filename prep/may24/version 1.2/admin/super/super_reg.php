<?php

    session_start();  // connects with or starts a session if not already existing

    require_once '../../db_connect.php';  // include once the db connect functions

    require_once '../a_functions.php';  // include once the admin functions

    require_once '../../functions.php'; // include once functions needed by everyone

    if (super_checker(dbconnect())) {  // calls function in a_functions to check if superuser exists.

        $_SESSION['ERROR'] = "ADMIN ALREADY EXISTS, LOGIN or ASK FOR to be registered";  // sets the error session variable to be read out by the next page
        header('location: a_login.php');  // redirects to the needed new page.
        exit;

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){  // if superuser doesn't exist and posted to this page

        try {
            if(reg_admin(dbconnect(),$_POST) && auditor(dbconnect(), $_POST['username'], "SUPERREG", "SUPER USER REGISTERED")) { // Assuming $conn is your database connection

                $_SESSION['SUCCESS'] = "ADMIN REGISTERED";
                header("Location: a_login.php");
                exit; // Stop further execution

            } else {

                $_SESSION['ERROR'] = "SUPER FAIL, UNKNOWN ERROR";
                header("Location: super_reg.php");
                exit; // Stop further execution

            }
        }
        catch(Exception $e) {

            // Handle database error within reg_admin or here.
            $_SESSION['ERROR'] = "SUPER REG ERROR: ". $e->getMessage();
            header("Location: super_reg.php");
            exit; // Stop further execution

        }
    }

    echo "<!DOCTYPE html>";

    echo "<html lang='en'>";

        echo "<head>";

            echo "<link rel='stylesheet' href='../admin_styles.css'>";

            echo "<title>One Time Super Admin Registration</title>";

        echo "</head>";

        echo "<body>";

        echo "<div id='container'>";

            echo "<div id='title'>";

                echo "<h3 id='banner'>Super Admin one time registration</h3>";

            echo "</div>";


            echo "<div id='content'>";

                echo "<h4> This is a one time registration for RZL system</h4>";

                    echo "<form method='post' action='super_reg.php'>";

                        echo "<input type='text' name='username' placeholder='Username' required><br>";

                        echo "<input type='password' name='password' placeholder='Password' required><br>";

                        echo "<input type='password' name='cpassword' placeholder='Confirm Password' required><br>";

                        echo "<input type='text' name='fname' placeholder='First Name' required><br>";

                        echo "<input type='text' name='sname' placeholder='Surname' required><br>";

                        echo "<input type='text' name='email' placeholder='Email' required><br>";

                        echo "<input type='hidden' name='priv' value='SUPER'><br>";

                        echo "<input type='submit' name='submit' value='Register'>";

                    echo "</form>";

                echo "</div>";

            echo "</div>";

        echo "</body>";

    echo "</html>";