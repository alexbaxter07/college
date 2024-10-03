<?php

    session_start();

    include "db_connect.php";

    $usnm = $_SESSION['Username'];

    echo "<h1>Welcome, ".$usnm."</h4>";

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

        echo "<meta charset='UTF-8'>";
        echo "<title>Activity log</title>";
        echo "<link href='styles.css' rel='stylesheet'>";

        echo "</head>";

    echo "</html>";

?>