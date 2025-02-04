<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dname = "zoo";

    //trys connecting to database if it cant then gives an error message for robustness
    try {
        $conn = new PDO("mysql:host=$servername;port =3306;dbname=$dname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "conection failed" . $e->getMessage();
    }

?>