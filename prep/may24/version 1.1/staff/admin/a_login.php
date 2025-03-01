<?php

    //page to get information to login an admin

    session_start(); // start session to include session variables across pages it is used

    include("a_functions.php");

    if(admin_sesh_started()){
        header("location: a_index.php");
    }

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <link rel="stylesheet" href="admin_styles.css">
        <title>Admin Login</title>

    </head>

    <body>

        <div id="container">

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
        </div>

    </body>

</html>
