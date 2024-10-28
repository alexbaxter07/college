<?php

    // Start a new session or resume the existing session
    session_start();

    // Include the database connection file
    include "db_connect.php";

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8"> <!-- Set character encoding to UTF-8 -->
        <title>Lists</title> <!-- Title of the webpage -->
        <link href="styles.css" rel="stylesheet"> <!-- Link to the external CSS file -->
    </head>

    <body>

        <div id="container">

            <div id="titlebar">

                <!-- Main title of the page -->
                <h1>To-Do</h1>

            </div>

            <!-- Navigation bar with links -->
            <div id="navbar">

                <ul id="nav">

                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="lists.php">Lists</a></li>
                    <li><a href="edit_lists.html">Edit Lists</a></li>
                    <li><a href="logout.html">Logout</a></li>

                </ul>

            </div>

            <?php

                // Prepare SQL query to fetch lists for the logged-in user
                $sql = "SELECT Listid, Listname, Date FROM Lists WHERE Userid = ?";
                $stmt = $conn->prepare($sql); // Prepare the statement
                $stmt->bindParam(1, $_SESSION['Userid']); // Bind the user ID to the query
                $stmt->execute(); // Execute the prepared statement
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array

                // Check if there are no results from the query
                if (!$result) {
                    echo "No lists found"; // Display message if no lists exist
                } else {
                    echo "<h3>Select List</h3>"; // Display heading for the lists

                    echo "<table id='edit_list'>"; // Start a table to display the lists

                    // Iterate through each list row returned from the database
                    foreach ($result as $row) {
                        // Create a form for each list item
                        echo "<form action='edit_lists.php' method='post' name='form_".$row['Listid']."'>";
                        echo "<input type='hidden' name='Listid' value='".$row['Listid']."'>"; // Hidden input to hold the List ID
                        echo "<tr>"; // Start a new row in the table
                        echo "<td>List Name: ".$row['Listname']."</td>"; // Display the list name
                        echo "<td>Date: ".$row['Date']."</td>"; // Display the date of the list
                        echo "<td><input type='submit' name='edit' value='Edit'></td>"; // Button to edit the list
                        echo "<td><input type='submit' name='delete' value='Delete'></td>"; // Button to delete the list
                        echo "</tr>"; // End the table row
                        echo "</form>"; // End the form
                    }

                    echo "</table><br>"; // End the table
                }

            ?>

        </div>

    </body>

</html>
