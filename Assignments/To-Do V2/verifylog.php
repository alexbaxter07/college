<?php

    include 'db_connect.php'; // Include database connection

    session_set_cookie_params(3600); // Set session cookie parameters for 1 hour
    session_start(); // Start new or resume existing session

    // Retrieve username and password from POST request
    $usern = $_POST['usname']; // Username
    $pswd = $_POST['pasword']; // Password

    // Prepare SQL statement to fetch user data based on username
    $sql = "SELECT * FROM Users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $usern); // Bind username
    $stmt->execute(); // Execute the query
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

    if ($result) { // Check if a user was found

        // Set session variables for logged-in user
        $_SESSION["ssnlogin"] = true; // Login status
        $_SESSION["Username"] = $usern; // Store username in session
        $_SESSION["Userid"] = $result["Userid"]; // Store user ID in session
        $rpswd = $result["Password"]; // Retrieve stored password
        $_SESSION['Listid'] = -1; // Initialize List ID

        // Verify the provided password against the stored hashed password
        if (password_verify($pswd, $rpswd)) {

            // Log the login action
            $act = "log"; // Action type
            $logtime = date("Y-m-d H:i:s"); // Current timestamp
            $info = "logged into account"; // Log information

            // Prepare SQL statement to insert audit log
            $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $_SESSION["Userid"]); // Bind user ID
            $stmt->bindParam(2, $act); // Bind action
            $stmt->bindParam(3, $info); // Bind information
            $stmt->bindParam(4, $logtime); // Bind timestamp

            $stmt->execute(); // Execute the audit log insertion

            header("refresh:1; url=profile.php"); // Redirect to profile page
            echo "You are now logged in! Heading to your profile"; // Success message
        } else {
            header("refresh:1; url=log.html"); // Redirect back to login on failure
            echo "Password is incorrect"; // Error message
        }
    }

    // Start HTML output
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

        echo "<meta charset='UTF-8'>"; // Character encoding
        echo "<title>Verify Login</title>"; // Page title
        echo "<link href='styles.css' rel='stylesheet'>"; // Link to external CSS

    echo "</head>";

    echo "</html>"; // Close HTML document
?>