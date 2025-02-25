<?php
// page for highest level admins to add other admins of different levels

    include "../../a_functions.php";

    session_start(); //session start for usage of admin session variables

    //check priv level
    if($_SESSION["level"]!='SUPER'){

        header("refresh:4; location: a_index.php");
        echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
        echo "Admin already exists. login or ask to be registered.";

    }else{

        echo "<DOCTYPE html>";

            echo "<head>";

                echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
                echo"<title>Add Admin</title>";

            echo "</head>";

            echo "<body>";

                include "../../a_navbar.php";

                echo "<h2>Add Admin Form</h2>"; // Heading for the registration form

                echo "<form action='add_admin_reg.php' method='post'>"; // Form for admin registration

                    echo "<table>"; // Table to organize form fields

                        echo "<tr>";

                            echo "<td><label for='uname'>Username:</label></td>";
                            echo "<td><input type='text' id='uname' name='uname' placeholder='Enter a username' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='fname'>First Name:</label></td>";
                            echo "<td><input type='text' id='fname' name='fname' placeholder='Enter your first name' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='sname'>Surname:</label></td>";
                            echo "<td><input type='text' id='sname' name='sname' placeholder='Enter your surname' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='email'>Email:</label></td>";
                            echo "<td><input type='email' id='email' name='email' placeholder='Enter your email' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='password'>Password:</label></td>";
                            echo "<td><input type='password' id='password' name='password' placeholder='Enter your password' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='cpassword'>Confirm Password:</label></td>";
                            echo "<td><input type='password' id='cpassword' name='cpassword' placeholder='Confirm your password' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='admin_type'>Select type of admin:</label></td>";

                            echo "<td>";
                                echo "<select id='admin_type' name='Aadmin_type'>";
                                    echo "<option value='CREATOR'>Creator</option>";
                                    echo "<option value='EDITOR'>Editor</option>";
                                    echo "<option value='SUPER'>Super</option>";
                                    echo "</select>";
                            echo "</td>";
                        echo"</tr>";

                        echo "<tr>"; // Submit button for the form, spans two columns

                            echo "<td colspan='2'><input type='submit' value='Register'></td>";

                        echo "</tr>";

                    echo "</table>"; // End of table for form fields

                echo "</form>";

            echo "</body>";

        echo "</html>";

    }

?>