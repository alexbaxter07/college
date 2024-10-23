<?php

    session_start();

    include "../db_connect.php";

    $uid = $_SESSION['Userid'];
    $lname = $_POST['lname'];


    try {

       echo "Unfinished";

    }catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }

    include "../db_connect.php";

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Delete List</title>";
    echo "<link href='../styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"

?>