<?php
//page to get information to login an admin

session_start(); // start session to include session variables across pages it is used

include("../db_connect.php");

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <link rel="stylesheet" href="../../styles.css">
        <title>Admin Login</title>

    </head>

    <body>

        <form id="admin_log_form" method="post" action="a_validate.php">  <!-- admin login form that will send the results to a validate form -->

            <table id="admin_login"> <!-- table to organise form -->

                <tr>
                    <td><label for="uname">Username:</label></td>
                    <td><input type="text" id="uname" name="uname" placeholder="Enter a username" required></td>
                </tr>

                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="Enter your email" required></td>
                </tr>

                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Enter your password" required></td>
                </tr>

                <tr>
                    <td><label for="cpassword">Confirm Password:</label></td>
                    <td><input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required></td>
                </tr>

            </table>

        </form>

    </body>

</html>
