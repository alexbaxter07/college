<?php

    session_start(); // started session to used pre-saved admin session variables

    //check for admin privs
    if ($_SESSION['level'] == 'EDITOR'){

        header('refresh:4; location:../a_index.php');
        echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
        echo "Not high enough admin rights";

    }else{

        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";

            echo "<head>";

                echo "<link rel='stylesheet' type='text/css' href='../../../../styles.css'>";
                echo "<title>Add Hotel Room</title>";

            echo "</head>";

            echo "<body>";

                include "../../a_navbar.php";

                echo "<h2>Add Hotel Room</h2>"; // Heading for the registration form

                echo "<form action='add_hotelroom_reg.php' method='post'>"; // Form for hotel room registration

                    echo "<table>"; // Table to organize form fields

                        echo "<tr>";

                            echo "<td><label for='hr_type'>Hotel Room Type: </label></td>";
                            echo "<td><input type='text' id='hr_type' name='hr_type' placeholder='Enter Hotel Room Type' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='occ'>Occupancy: </label></td>";
                            echo "<td><input type='text' id='occ' name='occ' placeholder='Enter Occupancy' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='available'>Number of Rooms Available:</label></td>";
                            echo "<td><input type='text' id='available' name='available' placeholder='Enter Occupancy' required></td>";

                        echo "</tr>";

                        echo "<tr>";

                            echo "<td><label for='ppn'>Price Per Night:</label></td>";
                            echo "<td><input type='number' id='ppn' name='ppn' placeholder='Enter Price Per Night' required></td>";

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