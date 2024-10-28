<?php

    session_start(); // Start the session to access session variables

    include "db_connect.php"; // Include the database connection file

    // Retrieve user input from POST request
    $opswd = $_POST['opassword']; // Old password
    $npswd = $_POST['npassword']; // New password
    $cpswd = $_POST['cpassword']; // Confirm new password
    $userid = $_SESSION['Userid']; // User ID from session

    // Prepare SQL statement to fetch the current password
    $sql = "SELECT Password FROM Users WHERE Userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $userid); // Bind user ID
    $stmt->execute(); // Execute the query
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

    if ($result) { // Check if result is found

        $spswd = $result['Password']; // Get the stored password

        // Verify if the old password matches the stored password
        if (password_verify($opswd, $spswd)) {

            // Check if new password and confirm password match
            if ($npswd <> $cpswd) {

                // Log the attempted password change
                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]); // Bind user ID
                $stmt->bindParam(2, $act); // Action
                $stmt->bindParam(3, $info); // Info
                $stmt->bindParam(4, $logtime); // Date
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "The passwords did not match, you will be redirected in 5 seconds.";

                // Check for various password strength conditions
            } elseif (preg_match("/[a-z]/", $npswd) == false) {

                // Log the attempted password change
                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no lowercase letters";

            } elseif (preg_match("/[A-Z]/", $npswd) == false) {

                // Log the attempted password change
                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no uppercase letters";

            } elseif (preg_match("/[0-9]/", $npswd) == false) {

                // Log the attempted password change
                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no numbers";

            } elseif (preg_match("/[^A-Za-z0-9]/", $npswd) == false) {

                // Log the attempted password change
                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no special characters";

            } elseif (strlen($npswd) < 8) {

                // Log the attempted password change
                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "Password is less than 8 characters";

            } else {

                // Hash the new password before updating
                $hashed_pswd = password_hash($npswd, PASSWORD_DEFAULT);

                // Prepare SQL statement to update the password
                $sql = "UPDATE Users SET Password = ? WHERE Userid = ?";
                $query1 = $conn->prepare($sql);
                $query1->bindParam(1, $hashed_pswd); // New hashed password
                $query1->bindParam(2, $userid); // User ID
                $query1->execute(); // Execute the update query

                // Log the successful password change
                $act = "spc";
                $logtime = date("Y-m-d");
                $info = "Successful Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["Userid"]); // User ID
                $stmt->bindParam(2, $act); // Action
                $stmt->bindParam(3, $info); // Info
                $stmt->bindParam(4, $logtime); // Date
                $stmt->execute(); // Execute the audit log

                // Remove all session variables
                session_unset();
                // Destroy the session
                session_destroy();

                header("refresh:1; url=../log.html");
                echo "Password updated"; // Success message
            }

        } else { // If old password does not match

            // Log the attempted password change
            $act = "apc";
            $logtime = date("Y-m-d");
            $info = "Attempted Password Change";

            $sql = "INSERT INTO audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_SESSION["Userid"]); // User ID
            $stmt->bindParam(2, $act); // Action
            $stmt->bindParam(3, $info); // Info
            $stmt->bindParam(4, $logtime); // Date
            $stmt->execute(); // Execute the audit log

            // Remove all session variables
            session_unset();
            // Destroy the session
            session_destroy();

            header("refresh:5; url=../log.html");
            echo "Old Password does not match! Please log again."; // Error message
        }
    }

    // Start HTML output
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

        echo "<head>";

            echo "<meta charset='UTF-8'>"; // Character encoding
            echo "<title>Password Verify</title>"; // Page title
            echo "<link href='styles.css' rel='stylesheet'>"; // Link to external CSS

        echo "</head>";

    echo "</html>"; // Close HTML document
?>