<?php
// page for highest level admins to add user types

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
                echo"<title>Add User</title>";

            echo "</head>";

            echo "<body>";

                include "../../a_navbar.php";

                echo "<h2>Add User Type</h2>"; // Heading for the registration form

                echo "<form action='add_usertype_reg.php' method='post'>"; // Form for admin registration

                    echo "<table>"; // Table to organize form fields

                        echo "<tr>";

                        echo"<td><label for='type'>ticket type:</label></td>";
                        echo "<td><input type='text' id='type' name='type' placeholder='Enter ticket type' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                        echo "<td><label for='discout'>discount as decimal:</label></td>";
                        echo "<td><input type='text' id='discount' name='discount' placeholder='Enter discount as decimal'></td>";

                        echo "</tr>";

                        echo "<tr>"; // Submit button for the form, spans two columns

                        echo "<td colspan='2'><input type='submit' value='Register'></td>";

                        echo "</tr>";

                    echo "</table>"; // End of table for form fields

                echo "</form>";

            echo "</body>";

        echo "</html>";

    }
?>