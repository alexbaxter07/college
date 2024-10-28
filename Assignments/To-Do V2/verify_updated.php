<?php

    session_start(); // Start the session to access session variables

    include "db_connect.php"; // Include the database connection file

    // Retrieve user input from POST request
    $fname = $_POST['fname']; // First name
    $sname = $_POST['sname']; // Surname
    $email = $_POST['email']; // Email address

    // Get user ID from session
    $userid = $_SESSION['Userid'];

    try {

        // Prepare SQL statement to update user details
        $sql = "UPDATE Users SET Username = ?, Firstname = ?, Lastname = ?, Email = ? WHERE UserID = ?";
        $query1 = $conn->prepare($sql);

        // Bind parameters to the SQL query
        $query1->bindParam(1, $_SESSION["Username"]); // Current username (assuming it's not changed)
        $query1->bindParam(2, $fname); // First name
        $query1->bindParam(3, $sname); // Surname
        $query1->bindParam(4, $email); // Email
        $query1->bindParam(5, $userid); // User ID
        $query1->execute(); // Execute the update query

        // Prepare action logging
        $act = "upd"; // Action type
        $logtime = date("Y-m-d"); // Current date for the log
        $info = "Updated core details"; // Log message

        // Prepare SQL statement to insert audit log
        $sql = "INSERT INTO Audit (Userid, Action, Informaiton, Date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters for audit log
        $stmt->bindParam(1, $userid); // User ID
        $stmt->bindParam(2, $act); // Action type
        $stmt->bindParam(3, $info); // Log message
        $stmt->bindParam(4, $logtime); // Date of action

        $stmt->execute(); // Execute the audit log query

        // Redirect to profile page after 1 second
        header("refresh:1; url=profile.php");
        echo "Successfully Updated"; // Success message

    } catch (PDOException $e) {
        // Handle any errors during the process
        echo "Error: " . $e->getMessage();
    }

    // Start HTML output
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

        echo "<head>";

            echo "<meta charset='UTF-8'>"; // Character encoding
            echo "<title>Update Details</title>"; // Page title
            echo "<link href='styles.css' rel='stylesheet'>"; // Link to external CSS for styling

        echo "</head>";

    echo "</html>"; // Close HTML document
?>