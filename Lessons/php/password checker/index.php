<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Index</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <div id="container">
            
            <h1>Sign Up Form</h1>

            <div id="content">

                <p>Please enter all details correctly</p>

                <form method="post" action="">

                    <table>

                        <tr><td><legend>Personal details:</legend></td></tr>

                        <tr>
                            <td><label for="fname">First Name:</label></td>
                            <td><input type="text" name="fname" placeholder="Enter your First Name" required></td>
                        </tr>

                        <tr>
                            <td><label for="lname">Last Name:</label></td>
                            <td><input type="text" name="lname" placeholder="Enter your Last Name" required></td>
                        </tr>

                        <tr>
                            <td><label for="Email">Email:</label></td>
                            <td><input type="email" name="Email" placeholder="Enter your Email" required></td>
                        </tr>

                        <tr>
                            <td><label for="Pass">Password:</label></td>
                            <td><input type="password" name="Pass" placeholder="Enter your Password" required></td>
                        </tr>

                        <tr>
                            <td><label for="CPass">Confirm Password:</label></td>
                            <td><input type="password" name="CPass" placeholder="Confirm your Password" required></td>
                        </tr>

                        <tr><td><input type="submit" value="Submit"></td></tr>

                    </table>

                </form>

                <div id="Rules">

                    <p>An entered password must meet each of these rules:</p>

                    <ol>
                        <li>Must be a minimum of 8 characters in length</li>
                        <li>The password must contain a minimum of 1 capital letter </li>
                        <li>The password must contain a minimum of 1 lower case letter </li>
                        <li>The password must contain a minimum of 1 number </li>
                        <li>The password must contain at least 1 special character</li>
                    </ol>

                </div>

                <div id="password_check">

                    <?php

                        $pass = $_POST['Pass'];
                        $cpass = $_POST['CPass'];
                        $output = "";

                        if ($pass <> $cpass) {
                            $output .= nl2br("Passwords do not match!\n");
                        }

                        if (preg_match("/[a-z]/", $pass) == false) {
                            $output .= nl2br("No Lowercase letters!\n");
                        }

                        if (preg_match("/[A-Z]/", $pass) == false) {
                            $output .= nl2br("No Capital letters!\n");
                        }

                        if (preg_match("/[0-9]/", $pass) == false) {
                            $output .= nl2br("No Numbers letters!\n");
                        }

                        if (preg_match('/[^A-Za-z0-9]/', $pass) == false) {
                            $output .= nl2br("No Special Characters!\n");
                        }

                        if (strlen($pass) < 8) {
                            $output .= nl2br("Passwords must be at least 8 characters long!\n");
                        }

                        if ($output == ""){
                            echo "Password meets requirements!";
                        }else{
                            echo "Please fix these issues:";
                            echo $output;
                        }

                    ?>

                </div>

            </div>

        </div>

    </body>

</html>