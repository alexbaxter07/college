<?php
// page to add tickets to system that only highest level of admin can do

    include "../../a_functions.php";

    session_start(); //session start for usage of admin session variables

    //check priv level
    if($_SESSION["level"]=='EDITOR'){

        header("refresh:4; location: a_index.php");
        echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
        echo "Admin already exists. login or ask to be registered.";

    }else{

        echo "<DOCTYPE html>";

            echo "<head>";

            echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
            echo"<title>Add Ticket Type</title>";

            echo "</head>";

            echo "<body>";

                include "../../a_navbar.php";

                // Heading for the registration form
                echo "<h2>Add Ticket Type</h2>";

                echo "<form action='add_ticket_reg.php' method='post'>";

                    echo "<table>";

                        echo "<tr>";

                            echo"<td><label for='type'>ticket type:</label></td>";
                            echo "<td><input type='text' id='type' name='type' placeholder='Enter ticket type' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='ppt'>price per ticket:</label></td>";
                            echo "<td><input type='text' id='ppt' name='ppt' placeholder='Enter ticket price'></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='ammount'>ammount of tickets:</label></td>";
                            echo "<td><input type='number' id='ammount' name='ammount' placeholder='Enter ammount'></td>";

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