<?php

    session_start(); // Start session to use session variables across pages
    include "db_connect.php"; // Include the database connection file

    // Check if the user is not logged in
    if (!isset($_SESSION["ssnlogin"])) {

        header("refresh:1;url=log.html"); // Redirect to the login page after 1 second
        echo "You are not currently logged in, redirecting to log page"; // Message to inform the user

    } else {

        $usnm = $_SESSION['Username']; // Get the username from session

        echo "<title>" . htmlspecialchars($usnm) . "'s profile page</title>"; // Set the title of the page safely

        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";

            echo "<head>";
            echo "<meta charset='utf-8'>"; // Set character encoding to UTF-8
            echo "<link href='styles.css' rel='stylesheet'>"; // Link to the external CSS file
            echo "</head>";

            echo "<body>";
                echo "<div id='container'>"; // Main container for the content

                    echo "<div id='titlebar'>"; // Title bar section

                        echo "<h1>To-Do</h1>"; // Main title of the application

                    echo "</div>";

                    echo "<div id='navbar'>"; // Navigation bar section

                        echo "<ul id='nav'>"; // Start navigation list

                            echo "<li><a href='changed.html'>Update core details</a></li>"; // Link to update user details
                            echo "<li><a href='changep.html'>Update Password</a></li>"; // Link to update user password
                            echo "<li><a href='activity_log.php'>Activity Log</a></li>"; // Link to activity log
                            echo "<li><a href='lists.php'>Lists</a></li>"; // Link to the lists page
                            echo "<li><a href='logout.html'>Logout</a></li>"; // Link to logout page

                        echo "</ul>"; // End navigation list

                    echo "</div>";

                    echo "<div id='content'>"; // Content area for the profile information

                        echo "<h2>Welcome, " . htmlspecialchars($usnm) . "</h2>"; // Welcome message for the user
                        echo "<h3>Here is your information:</h3>"; // Heading for user information

                        // Fetch user details from the database
                        $sql = "SELECT Username, Firstname, Lastname, Email FROM Users WHERE Username = ?";
                        $stmt = $conn->prepare($sql); // Prepare SQL statement
                        $stmt->bindParam(1, $usnm); // Bind the username parameter
                        $stmt->execute(); // Execute the statement
                        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

                        // Display user details
                        foreach ($result as $key => $value) {
                            echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>"; // Output each detail safely
                        }

                        echo "<h3>Key dates:</h3>"; // Heading for key dates

                        // Fetch the date the user signed up
                        $sql = "SELECT Date FROM Users WHERE Username = ?";
                        $stmt = $conn->prepare($sql); // Prepare SQL statement
                        $stmt->bindParam(1, $usnm); // Bind the username parameter
                        $stmt->execute(); // Execute the statement
                        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
                        $date = $result['Date']; // Get the signup date

                        echo "<h4>Date of signup</h4>"; // Heading for signup date
                        echo date('g:i A, l - d M Y', strtotime($date)); // Format and display the signup date

                        // Fetch date and time of last log
                        $act = 'log'; // Define the action to check
                        $uid = $_SESSION['Userid']; // Get the user ID from session

                        $sql = "SELECT Date FROM Audit WHERE Userid = ? AND Action = ? ORDER BY Date DESC LIMIT 1 OFFSET 1"; // Query to get the last log date
                        $stmt = $conn->prepare($sql); // Prepare SQL statement
                        $stmt->bindParam(1, $uid); // Bind the user ID parameter
                        $stmt->bindParam(2, $act); // Bind the action parameter
                        $stmt->execute(); // Execute the statement
                        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
                        $time = $result['Date']; // Get the last log time

                        echo "<h4>Date</h4>"; // Heading for the last log date
                        echo htmlspecialchars($time); // Display the last log time safely

                        // Fetch the last activity
                        $sql = "SELECT Action FROM Audit WHERE Userid = ? ORDER BY Date DESC LIMIT 1 OFFSET 1"; // Query to get last action
                        $stmt = $conn->prepare($sql); // Prepare SQL statement
                        $stmt->bindParam(1, $uid); // Bind the user ID parameter
                        $stmt->execute(); // Execute the statement
                        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

                        echo "<h4>Last Activity</h4>"; // Heading for last activity

                        // Translate action name to meaningful label
                        $action = $result['Action']; // Get the last action
                        $act = ""; // Initialize the activity description
                        if ($action == "log") {
                            $act = "Login"; // Translate action to "Login"
                        } elseif ($action == "spc") {
                            $act = "Successful Password Change"; // Translate action to successful password change
                        } else {
                            $act = "Unsuccessful Password Change"; // Translate action to unsuccessful password change
                        }

                        echo "Your last activity was " . htmlspecialchars($act); // Display last activity

                        // Number of times each activity was done
                        echo "<h4>Activity log</h4>"; // Heading for activity log
                        $actions = array("log", "spc", "apc"); // Define activities to check

                        foreach ($actions as $action) {
                            $sql = "SELECT COUNT(*) AS count FROM Audit WHERE Userid = ? AND Action = ?"; // Prepare SQL to count actions
                            $stmt = $conn->prepare($sql); // Prepare the statement
                            $stmt->bindParam(1, $uid); // Bind the user ID parameter
                            $stmt->bindParam(2, $action); // Bind the action parameter
                            $stmt->execute(); // Execute the statement
                            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

                            $act = ""; // Initialize the activity description
                            if ($action == "log") {
                                $act = "Login"; // Translate action to "Login"
                            } elseif ($action == "spc") {
                                $act = "Successful Password Change"; // Translate action to successful password change
                            } else {
                                $act = "Unsuccessful Password Change"; // Translate action to unsuccessful password change
                            }

                            echo "The action: " . htmlspecialchars($act) . " has been done " . htmlspecialchars($result['count']) . " times<br>"; // Display count of actions
                        }

                    echo "</div>"; // End content area

                echo "</div>"; // End container

            echo "</body>";

        echo "</html>";
    }
?>
