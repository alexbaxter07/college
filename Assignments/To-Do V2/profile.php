<?php

    session_start(); // Start session to use session variables across pages
    include "db_connect.php"; // Include the database connection file

    if (!isset($_SESSION["ssnlogin"])) {

        header("refresh:1;url=log.html");
        echo "You are not currently logged in, redirecting to log page";

    } else {

        $usnm = $_SESSION['Username'];
        echo "<title>" . htmlspecialchars($usnm) . "'s profile page</title>";

        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";

            echo "<head>";

                echo "<meta charset='utf-8'>";
                echo "<link href='styles.css' rel='stylesheet'>";

            echo "</head>";

            echo "<body>";

            echo "<div id='container'>";

                echo "<div id='titlebar'>";

                    echo"<h1>To-Do</h1>";

                echo "</div>";

                echo "<div id='navbar'>";

                    echo "<ul id='nav'>";

                        echo "<li><a href='changed.html'>Update core details</a></li>";
                        echo "<li><a href='changep.html'>Update Password</a></li>";
                        echo "<li><a href='activity_log.php'>Activity Log</a></li>";
                        echo "<li><a href='lists.php'>Lists</a></li>";
                        echo "<li><a href='logout.html'>Logout</a></li>";

                    echo "</ul>";

                echo "</div>";

                echo "<div id='content'>";

                    echo "<h2>Welcome, " . htmlspecialchars($usnm) . "</h2>";

                    echo "<h3>Here is your information:</h3>";

                    // Fetch user details
                    $sql = "SELECT Username, Firstname, Lastname, Email FROM Users WHERE Username = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $usnm);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    foreach ($result as $key => $value) {
                        echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . "<br>";
                    }

                    echo "<h3>Key dates:</h3>";

                    // Date they signed up to the system
                    $sql = "SELECT Date FROM Users WHERE Username = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $usnm);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $date = $result['Date'];

                    echo "<h4>Date of signup</h4>";
                    echo date('g:i A, l - d M Y', strtotime($date));

                    // Date and time of last log
                    $act = 'log';
                    $uid = $_SESSION['Userid'];

                    $sql = "SELECT Date FROM Audit WHERE Userid = ? AND Action = ? ORDER BY Date DESC LIMIT 1 OFFSET 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $uid);
                    $stmt->bindParam(2, $act);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $time = $result['Date'];

                    echo "<h4>Date</h4>";
                    echo htmlspecialchars($time);

                    // Last activity
                    $sql = "SELECT Action FROM Audit WHERE Userid = ? ORDER BY Date DESC LIMIT 1 OFFSET 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $uid);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo "<h4>Last Activity</h4>";

                    // Translate action name to meaningful label
                    $action = $result['Action'];
                    $act = "";
                    if ($action == "log") {
                        $act = "Login";
                    } elseif ($action == "spc") {
                        $act = "Successful Password Change";
                    } else {
                        $act = "Unsuccessful Password Change";
                    }

                    echo "Your last activity was " . htmlspecialchars($act);

                    // Number of times each activity was done
                    echo "<h4>Activity log</h4>";
                    $actions = array("log", "spc", "apc");

                    foreach ($actions as $action) {

                        $sql = "SELECT COUNT(*) AS count FROM Audit WHERE Userid = ? AND Action = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $uid);
                        $stmt->bindParam(2, $action);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        $act = "";
                        if ($action == "log") {
                            $act = "Login";
                        } elseif ($action == "spc") {
                            $act = "Successful Password Change";
                        } else {
                            $act = "Unsuccessful Password Change";
                        }

                        echo "The action: " . htmlspecialchars($act) . " has been done " . htmlspecialchars($result['count']) . " times<br>";
                    }

                    echo "</div>";

                echo "</div>";

            echo "</body>";

        echo "</html>";
    }
?>
