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
                            <td><label for="uname">Username:</label></td>
                            <td><input type="text" id="uname" name="uname" placeholder="Enter a username" required></td>
                        </tr>

                        <tr>
                            <td><label for="fname">First Name:</label></td>
                            <td><input type="text" id="fname" name="fname" placeholder="Enter your first name" required></td>
                        </tr>

                        <tr>
                            <td><label for="sname">Surname:</label></td>
                            <td><input type="text" id="sname" name="sname" placeholder="Enter your surname" required></td>
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
                            <td><label for="user_type">Select type of customer:</label></td>
                            <td>
                                <select id="user_type" name="user_type">
                                    <option value="public">Public</option>
                                    <option value="school">School</option>
                                    <option value="business">Business</option>
                                </select>
                            </td>
                        </tr>

                        <tr> <!-- Submit button for the form, spans two columns -->
                            <td colspan="2"><input type="submit" value="Register"></td>
                        </tr>

                    </table> <!-- End of table for form fields -->

                </form>


            </div> <!-- End of content area -->

        </div> <!-- End of main container -->

    </body>

</html>
