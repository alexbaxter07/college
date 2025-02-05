<?php
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link href="../styles.css" rel="stylesheet"> <!-- Link to external CSS for styling -->

    </head>

    <body>

        <div id="container"> <!-- Main container for the entire page -->

            <div id="titlebar"> <!-- Title bar section -->

                <h1>Zoo</h1> <!-- Main title of the application -->

            </div>

            <div id="navbar"> <!-- Navigation bar section -->

                <ul id="nav"> <!-- Start navigation list -->

                    <li><a href="c_login.php">Login</a></li> <!-- Link to login page -->
                    <li><a href="c_signup.php">Register</a></li> <!-- Link to Sign Up page -->

                </ul> <!-- End navigation list -->

            </div>

            <div id="content"> <!-- Content area for the registration form -->

                <h2>Sign Up Form</h2> <!-- Heading for the registration form -->

                <form action="c_reg.php" method="post"> <!-- Form for user registration that is sending the information to a different page-->

                    <table> <!-- Table to organize form fields -->

                        <tr>
                            <td><label for="uname">Username:</label></td> <!-- Label for username input -->
                            <td><input type="text" id="uname" name="uname" placeholder="Enter a username" required></td> <!-- Input for username -->
                        </tr>

                        <tr>
                            <td><label for="fname">First Name:</label></td> <!-- Label for first name input -->
                            <td><input type="text" id="fname" name="fname" placeholder="Enter your first name" required></td> <!-- Input for first name -->
                        </tr>

                        <tr>
                            <td><label for="sname">Surname:</label></td> <!-- Label for surname input -->
                            <td><input type="text" id="sname" name="sname" placeholder="Enter your surname" required></td> <!-- Input for surname -->
                        </tr>

                        <tr>
                            <td><label for="email">Email:</label></td> <!-- Label for email input -->
                            <td><input type="email" id="email" name="email" placeholder="Enter your email" required></td> <!-- Input for email -->
                        </tr>

                        <tr>
                            <td><label for="password">Password:</label></td> <!-- Label for password input -->
                            <td><input type="password" id="password" name="password" placeholder="Enter your password" required></td> <!-- Input for password -->
                        </tr>

                        <tr>
                            <td><label for="cpassword">Confirm Password:</label></td> <!-- Label for confirm password input -->
                            <td><input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required></td> <!-- Input for confirming password -->
                        </tr>

                        <tr><!-- Submit button for the form, spans two columns -->
                            <td colspan="2"><input type="submit" value="Register""></td>
                        </tr>

                    </table> <!-- End of table for form fields -->

                </form>

            </div> <!-- End of content area -->

        </div> <!-- End of main container -->

    </body>

</html>
