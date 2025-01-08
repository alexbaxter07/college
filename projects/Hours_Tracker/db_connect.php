<?php

    $servername = "localhost";
    $username = "tltracker";
    $password = "tlevel25!";
    $dname = "tltracker";

    try {
        $conn = new PDO("mysql:host=$servername;port =3306;dbname=$dname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "conection failed" . $e->getMessage();
    }

?>