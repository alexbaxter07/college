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
                            <td><input type="text" name="Email" placeholder="Enter your Email"></td>
                        </tr>

                        <tr>
                            <td><label for="Pass">Password:</label></td>
                            <td><input type="text" name="Pass" placeholder="Enter your Password"></td>
                        </tr>

                        <tr>
                            <td><label for="CPass">Confirm Password:</label></td>
                            <td><input type="text" name="CPass" placeholder="Confirm your Password"></td>
                        </tr>
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

            </div>

        </div>

    </body>

</html>
