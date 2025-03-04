<?php

//page to get information to get info for super admin user

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
        <title>Super Admin Information</title>

    </head>

    <body>

        <div id="container">

            <h2>This is for a one time super admin user</h2>

            <form id="super_info_form" method="post" action="a_super_reg.php">  <!-- admin login form that will send the results to a validate form -->

                <table id="super_form"> <!-- table to organise form -->

                    <tr>
                        <td><label for="uname">Username:</label></td>
                        <td><input type="text" id="uname" name="uname" placeholder="Enter a username" required></td>
                    </tr>

                    <tr>
                        <td><label for="first_name">First Name:</label></td>
                        <td><input type="text" id="first_name" name="first_name" placeholder="Enter your First Name" required></td>
                    </tr>

                    <tr>
                        <td><label for="last_name">Last Name:</label></td>
                        <td><input type="text" id="last_name" name="last_name" placeholder="Enter your Last Name" required></td>
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

                    <tr>
                        <td><input type="hidden" id="priviledge" name="priviledge" value="SUPER"></td>
                    </tr>

                    <tr> <!-- Submit button for the form, spans two columns -->
                        <td colspan='2'><input type='submit' value='Register'></td>
                    </tr>

                </table>

            </form>
        </div>

    </body>

</html>