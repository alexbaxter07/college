//connecting to database

<?php

    //server credentials
    $servername = "localhost";
    $username = "to-do";
    $password = "Password";
    $dname = "to-do";

    try {
        $conn = new PDO("mysql:host=$servername;port =3306;dbname=$dname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        //if connection fails output message
        echo "conection failed". $e->getMessage();
    }
?>