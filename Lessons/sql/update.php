<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Login</title>
        <link href="styles.css" rel="stylesheet">

    </head>

    <body>
        <div id="container">

            <form action="update.php" method="post">

                <table>

                    <tr>
                        <td><label for="Uname" >Username: </label></td>
                        <td><input type="text" id="Uname" name="Uname" placeholder="Enter a username" required></td>
                    </tr>

                    <tr>
                        <td><label for="Password">Password: </label></td>
                        <td><input type="password" id="Password" name="Password" placeholder="Enter your Password" required></td>
                    </tr>

                    <tr>
                        <td><label for="CPassword">Confirm Password: </label></td>
                        <td><input type="password" id="CPassword" name="CPassword" placeholder="Confirm your Password" required></td>
                    </tr>

                    <tr>
                        <td><label for="Fname">First Name: </label></td>
                        <td><input type="text" id="Fname" name="Fname" placeholder="Enter your first name" required></td>
                    </tr>

                    <tr>
                        <td><label for="Sname">Surname: </label></td>
                        <td><input type="text" id="Sname" name="Sname" placeholder="Enter your surname" required></td>
                    </tr>

                    <tr>
                        <td><label for="email">Email: </label> </td>
                        <td><input type="email" id="email" name="email" placeholder="Enter your email" required></td>
                    </tr>

                    <tr><td><input type="submit" value="register"></td></tr>

                </table>

            </form>

        </div>
    </body>
</html>