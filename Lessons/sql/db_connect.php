<?php

    $servername = "localhost";
    $username = "membs";
    $password = "Password";
    $dname = "membs";

    try {
        $conn = new PDO("mysql:host=$servername;port =3306;dbname=$dname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "conection failed". $e->getMessage();
    }

?>