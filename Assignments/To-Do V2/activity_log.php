<?php

    // Start the session to use session variables (e.g., user ID)
    session_start();

?>

<!DOCTYPE html>

    <head>

        <!-- Set the language of the page to English -->
        <html lang='en'>

        <!-- Define the character encoding of the document -->
        <meta charset='UTF-8'>

        <!-- Title of the web page -->
        <title>Activity log</title>

        <!-- Link to the external CSS stylesheet -->
        <link href='styles.css' rel='stylesheet'>

    </head>

    <body>

        <div id="container">

            <!-- Title bar section -->
            <div id="titlebar">
                <h1>To-Do</h1>
            </div>

            <!-- Navigation bar section -->
            <div id="navbar">

                <ul id="nav">

                    <!-- Links to other pages of the user's profile -->
                    <li><a href="changed.html">Update core details</a></li>
                    <li><a href="changep.html">Update Password</a></li>
                    <li><a href="logout.html">Logout</a></li>
                    <li><a href="activity_log.php">Activity Log</a></li>

                </ul>

            </div>

        </div>

    </body>

</html>

<?php
    // Include the database connection file
    include "db_connect.php";

    echo "<body>";

            // Start of container div for displaying activity log data
            echo "<div id='container'>";

            // Array containing possible user actions
                $actions = array("log", "spc", "apc");

                // Retrieve the user's ID from session data
                $uid = $_SESSION['Userid'];

                // Create the activity log table
                echo "<table id='active_table'>";

                    // Table headers for the activity log
                    echo "<th>Activity</th>";
                    echo "<th>Number of times</th>";

                    // Loop through the defined user actions
                    foreach ($actions as $action) {

                        // SQL query to count how many times a specific action was performed by the user
                        $sql = "SELECT COUNT(*) AS count FROM Audit WHERE Userid = ? AND action = ?";

                        // Prepare the SQL statement and bind parameters (user ID and action type)
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $uid);
                        $stmt->bindParam(2, $action);
                        $stmt->execute();

                        // Fetch the result as an associative array
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Map the action code to a user-friendly name
                        $act = "";
                        if ($action == "log") {
                            $act = "Login";
                        } elseif ($action == "spc") {
                            $act = "Successful Password Change";
                        } else {
                            $act = "Unsuccessful Password Change";
                        }

                        // Display the action and the count of how many times it occurred in a table row
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($act) . "</td>";  // Display action name
                        echo "<td>" . htmlspecialchars($result["count"]) . "</td>";  // Display count of the action
                        echo "</tr>";
                    }

                // End of the table
                echo "</table>";

            // End of the container div
            echo "</div>";

        echo "</body>";
    echo "</html>";
?>
