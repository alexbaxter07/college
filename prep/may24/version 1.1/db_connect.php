<?php

    $servername = "localhost";
    $dbusername = "zoo";
    $dbpassword = "Password";
    $dbname = "zoo";

    try {  //attempt this block of code, catching an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);  // creates a PDO connection to the database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //sets error modes
        return $conn;
    } catch(PDOException $e) {  //catch statement if it fails
        error_log("Database error in super_checker: " . $e->getMessage());
    // Throw the exception
        throw $e; // Re-throw the exception  // outputs the error
    }

?>