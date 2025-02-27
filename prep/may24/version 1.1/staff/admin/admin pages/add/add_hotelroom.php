<?php
// page for highest level admins to add hotel rooms to the db

    include "../../a_functions.php";

    session_start(); //session start for usage of admin session variables

    // checked user is logged in
    if (!isset($_SESSION['level'])) {

        header("refresh:4; url=../a_login.php");  // if they are only an editor, then send them elsewhere
        echo "<link rel='stylesheet' href='../../admin_styles.css'>";  //
        echo "Not logged in, please log in";

    } elseif(isset($_SESSION['level']) && $_SESSION['level']=='EDITOR'){//check logged in and admin level

        header("refresh:4; location: a_index.php"); //if they are only editor go back to home
        echo "<link rel='stylesheet' type='text/css' href='../../admin_styles.css'>";
        echo "Admin already exists. login or ask to be registered.";

    }else{

        echo "<DOCTYPE html>";

            echo "<head>";

                echo "<link rel='stylesheet' type='text/css' href='../../admin_styles.css'>";
                echo"<title>Add Hotel Rooms</title>";

            echo "</head>";

            echo "<body>";

                include "../../a_navbar.php";

                // Heading for the registration form
                echo "<h2>Add Hotel Room</h2>";

                echo "<form action='add_hotelroom_reg.php' method='post'>";

                    echo "<table>";

                        echo "<tr>";

                            echo"<td><label for='type'>hotel room type:</label></td>";
                            echo "<td><input type='text' id='type' name='type' placeholder='Enter hotel room type' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='occ'>hotel room occupancy:</label></td>";
                            echo "<td><input type='number' id='occ' name='occ' placeholder='Enter occupancy'></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='ammount'>ammount of hotel rooms:</label></td>";
                            echo "<td><input type='number' id='ammount' name='ammount' placeholder='Enter ammount'></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='ppn'>hotel room price per night:</label></td>";
                            echo "<td><input type='text' id='ppn' name='ppn' placeholder='Enter price per night'></td>";

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