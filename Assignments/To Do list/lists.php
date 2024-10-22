<?php

    session_start();

    include "db_connect.php";

?>

<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Lists</title>
        <link href="styles.css" rel="stylesheet">

    </head>

    <body>

        <div id="container">

            <div id="titlebar">
                <h1>To-Do</h1>
            </div>

            <div id = "navbar">

                <ul id="nav">

                    <li><a href="changed.html">Update core details</a></li>
                    <li><a href="changep.html">Update Password</a></li>
                    <li><a href="activity_log.php">Activity Log</a></li>
                    <li><a href="lists.php">Lists</a> </li>
                    <li><a href="logout.html">Logout</a></li>

                </ul>

            </div>

            <h3>Here are your lists: </h3>

            <?

            $sql = "SELECT Listname, Date FROM lists where Userid = ?";
            $stmt = $conn->prepare($sql);
            $stmt ->bindParam(1,$_SESSION['Userid']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach($result as $row=>$value){
                echo $result."<br>";
            }

            ?>

        </div>

    </body>