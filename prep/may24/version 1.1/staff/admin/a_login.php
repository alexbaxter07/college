<?php

    //page to get information to login an admin

    session_start(); // start session to include session variables across pages it is used

    if ($_SESSION["admin_login"]==true) {
        header("location: a_index.php");
        exit(); // Always exit after header redirection
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

            <form id="admin_log_form" method="post" action="a_login_reg.php">  <!-- admin login form that will send the results to a validate form -->

                <table id="admin_login"> <!-- table to organise form -->

                    <tr>
                        <td><label for="uname">Username:</label></td>
                        <td><input type="text" id="uname" name="uname" placeholder="Enter a username" required></td>
                    </tr>

                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" placeholder="Enter your password" required></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <button type="submit">Login</button>
                        </td>
                    </tr>

                </table>

            </form>
        </div>

    </body>

</html>